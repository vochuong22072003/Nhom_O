<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\ApiCreateRequest;
use App\Http\Requests\API\ApiAuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\PersonalAccessTokenRepositoryInterface as PersonalAccessTokenRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\SendMailCreateToken;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $userRepository;
    protected $postRepository;
    protected $personalAccessTokenRepository;
    protected $customerRepository;

    public function __construct(UserRepository $userRepository, PostRepository $postRepository, PersonalAccessTokenRepository $personalAccessTokenRepository, CustomerRepository $customerRepository){
        $this->userRepository=$userRepository;
        $this->postRepository=$postRepository;
        $this->personalAccessTokenRepository=$personalAccessTokenRepository;
        $this->customerRepository=$customerRepository;
    }

    public function index(Request $request){
        $config=$this->configCreate();
        return view('Api.auth.create', compact('config'));
    }

    public function create(ApiCreateRequest $request)
    {
        $credentials=['email'=>$request->input('email'), 'password'=>$request->input('password')];
        
        $userIdToken = request('userIdToken');
        // dd($userIdToken);
        $modelToken = request('modelToken');

        if($modelToken == 1){
            $userGetToken = $this->userRepository->findById($userIdToken);

            $orderBy = ['expires_at', 'desc'];
            // dd($userIdToken);
            $exists_id = $this->personalAccessTokenRepository->findByConditionOrder([
                ['tokenable_id', '=', $userIdToken],
                ['tokenable_type', '=', 'App\Models\User'],
            ], $orderBy);
            // dd($exists_id);
        }else{
            $userGetToken = $this->customerRepository->findById($userIdToken);

            $orderBy = ['expires_at', 'desc'];
            $exists_id = $this->personalAccessTokenRepository->findByConditionOrder([
                ['tokenable_id', '=', $userIdToken],
                ['tokenable_type', '=', 'App\Models\Customer'],
            ], $orderBy);
            // dd($exists_id);
        }
        // dd($userGetToken);
        // Kiểm tra email và password
        $flag = false;
        $flag = Auth::guard('apiCreate')->attempt($credentials);
        
        if ($flag != false) {
            $owner = $this->userRepository->findById(Auth::guard('apiCreate')->id());
            // dd(Auth::guard('apiCreate')->id());
            // dd($owner);
            if($owner->user_catalogue_id == 1 && !is_null($userGetToken)){    
               
                if (is_null($exists_id) || ($exists_id->expires_at !== null && $exists_id->expires_at < now())) { 
                    // dd($exists_id->expires_at);
    
                    $expiresAt = request('expiresAt');
                    if (!empty($expiresAt)) {
                        $expiresAt = now()->addMinutes($expiresAt); // Cộng thêm thời gian hết hạn
                    } else {
                        $expiresAt = null; // Không có thời hạn
                    }
                    $abilities = request('abilities');
                    // Tạo token trực tiếp với tokenable_id được lấy từ $userGetToken
                    $token = $userGetToken->tokens()->create([
                        'name' => 'authToken',
                        'token' => hash('sha256', $plainTextToken = Str::random(40)),
                        'abilities' => json_encode($abilities),
                        'expires_at' => $expiresAt,
                    ]);
                    // Ghi đè updated_at thành null
                    $token->updated_at = null;
                    $token->save();
    
                    // Lấy thời gian hiện tại
                    $now = Carbon::now()->format('H:i:s d/m/Y');
                    // Giả sử $token->expires_at là một chuỗi ngày giờ
                    $expiresAt = Carbon::parse($token->expires_at)->format('H:i:s d/m/Y');
                    $data = [
                        'name' => 'Xin chào, '.($userGetToken->getTable() === 'users' ? 'User ' . $userGetToken->user_profile->name : 'Customer ' . $userGetToken->customerInfo->cus_name),
                        'message' => 'Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!',
                        'token' => 'Đây là token của bạn: '.$token->token,
                        'abilities' => 'Pham vị sử dụng của token: '.json_encode($abilities),
                        'expires_at' => 'Hiệu lực token của bạn có thời hạn là: '.$this->convertMinutesToTime(request('expiresAt')).'. Hạn sử dụng từ '.$now.' đến '.$expiresAt,
                    ];
                    // dd($data);
                    
                    Mail::to($userGetToken->email)->send(new SendMailCreateToken($data));
                    // Cookie::queue('is_logged_in', true, 1); 
                    return response()->json(['success' => $token]);
                }else{
                    return response()->json([
                        'message' => 'Tài khoản này đã có token trong hệ thống!'
                    ], 403);
                }
            }
            else{
                return response()->json([
                    'message' => 'Tài khoản này không có quyền tạo token!'
                ], 403);
            }
        }else{
            return response()->json([
                'message' => 'Thông tin đăng nhập không chính xác!'
            ], 403);
        }
    }

    public function getModelData(Request $request, $model){
        $userId = Auth::guard('apiAccessUser')->id() ?? Auth::guard('apiAccessCustomer')->id();
        $tokenableType = Auth::guard('apiAccessUser')->check() ? 'App\Models\User' : 'App\Models\Customer';
        // dd($userId);
        $orderBy = ['expires_at', 'desc'];
        $condition = [
            ['tokenable_id', '=', $userId],
            ['tokenable_type', '=', $tokenableType],
        ];
        // dd($condition);
        $personalAccessToken = $this->personalAccessTokenRepository->findByConditionOrder($condition, $orderBy);
        // dd($personalAccessToken);
        $abilities = $personalAccessToken->abilities;
        $abilities = json_decode($abilities, true);
        // dd($abilities);
        if (is_array($abilities) && in_array($model, $abilities) || in_array('all', $abilities)) {
            $modelRepository = $model.'Repository';
            $data = $this->$modelRepository->all(); // Lấy tất cả data model
            return response()->json(['data' => $data], 200);
        }else{
            return response()->json(['error' => 'API Token của tài khoản này không có quyền truy cập vào '.$model.' !'], 403);
        }
    }

    public function login(){
        $config=$this->configLogin();
        return view('Api.auth.login', compact('config'));
    }

    public function auth(ApiAuthRequest $request){
        $credentials=['email'=>$request->input('email'), 'password'=>$request->input('password')];
        
        $token = request('token');
        // dd($token);
        $roleAccount = request('roleAccount');
        // Kiểm tra email và password
        if($roleAccount == 1){
            if (Auth::guard('apiAccessUser')->attempt($credentials)) {
                $userId = Auth::guard('apiAccessUser')->id();
        
                $personalAccessToken = PersonalAccessToken::where('token', $token)
                    ->where('tokenable_id', $userId)
                    ->first();
        
                if (!$personalAccessToken) {
                    return response()->json([
                        'message' => 'Token không hợp lệ hoặc không thuộc về bạn.'
                    ], 403);
                }
    
                if (Carbon::parse($personalAccessToken->expires_at)->isPast()) {
                    return response()->json([
                        'message' => 'Token này đã hết hạn. Vui lòng yêu cầu token mới.'
                    ], 403);
                }
            }else{
                return response()->json([
                    'message' => 'Thông tin đăng nhập không chính xác!'
                ], 403);
            }
            $payload['last_used_at'] = now();
            $payload['updated_at'] = null;
            $condition = [
                ['token', '=', $token]
            ];
            $this->personalAccessTokenRepository->updateByWhere($condition, $payload);
            // return redirect()->route('api.user.profile', ['model' => 'user'])->with('success', 'Đăng nhập API Token thành công!');
            return response()->json(['model' => 'user']);
        }else{
            if (Auth::guard('apiAccessCustomer')->attempt($credentials)) {
                $userId = Auth::guard('apiAccessCustomer')->id();
        
                $personalAccessToken = PersonalAccessToken::where('token', $token)
                    ->where('tokenable_id', $userId)
                    ->first();
        
                if (!$personalAccessToken) {
                    return response()->json([
                        'message' => 'Token không hợp lệ hoặc không thuộc về bạn.'
                    ], 403);
                }
    
                if (Carbon::parse($personalAccessToken->expires_at)->isPast()) {
                    return response()->json([
                        'message' => 'Token này đã hết hạn. Vui lòng yêu cầu token mới.'
                    ], 403);
                }
                $payload['last_used_at'] = now();
                $payload['updated_at'] = null;
                $condition = [
                    ['token', '=', $token]
                ];
                $this->personalAccessTokenRepository->updateByWhere($condition, $payload);
                // return redirect()->route('api.user.profile', ['model' => 'customer'])->with('success', 'Đăng nhập API Token thành công!');
                return response()->json(['model' => 'customer']);
            }else{
                return response()->json([
                    'message' => 'Thông tin đăng nhập không chính xác!'
                ], 403);
            }
        }
    }

    public function profile($model){
        if($model == 'user'){
            $userId = Auth::guard('apiAccessUser')->id();
            // dd($userId);
            if($userId != null){
                $user_logged = $this->userRepository->findById($userId);
                // dd($user_logged);
            }else{
                $user_logged = null;
            }
        }
        else{
            $userId = Auth::guard('apiAccessCustomer')->id();
            // dd($userId);
            if($userId != null){
                $user_logged = $this->customerRepository->findById($userId);
                // dd($user_logged);
            }else{
                $user_logged = null;
            }
        }
        $config=$this->configProfile();
        return view('Api.auth.profile', compact('config', 'user_logged'));
    }

    public function protectedRoute(){
        if (!Auth::guard('apiAccessUser')->check() && !Auth::guard('apiAccessCustomer')->check() ) {
            return response()->json([
                'redirect_url' => route('api.user.login'),
                'error' => 'Vui lòng đăng nhập để sử dụng chức năng này.'
            ], 401);
        }
    
        // Xử lý logic nếu đã đăng nhập
        return response()->json([
            'success' => 'Bạn đã truy cập thành công!'
        ]);
    }

    public function logout(Request $request){
        Auth::guard('apiAccessUser')->logout();
        Auth::guard('apiAccessCustomer')->logout();
        // $request->session()->invalidate();
        $request->session()->forget('apiAccessUser');
        $request->session()->forget('apiAccessCustomer');
        $request->session()->regenerateToken();
        return redirect()->route('api.user.login');
    }

    private function configCreate(){
        return [
            'js'=>[
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'Backend/libary/API/create.js',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
            ],
            'css'=>[
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
                'Backend/css/customsize.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
        ];
    }

    private function configLogin(){
        return [
            'js'=>[
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'Backend/libary/API/auth.js',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
            ],
            'css'=>[
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
        ];
    }

    private function configProfile(){
        return [
            'js'=>[
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
                'Backend/libary/API/profile.js',
            ],
            'css'=>[
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
            ],
        ];
    }
}
