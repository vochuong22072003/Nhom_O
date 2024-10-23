<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeletePostCatalogueChildrenRequest;
use App\Http\Requests\StorePostCatalogueChildrenRequest;
use App\Http\Requests\UpdatePostCatalogueChildrenRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueChildrenServiceInterface as PostCatalogueChildrenService;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;


class PostCatalogueChildrenController extends Controller
{
    protected $postCatalogueChildrenService;
    protected $postCatalogueChildrenRepository;


    public function __construct(PostCatalogueChildrenService $postCatalogueChildrenService, PostCatalogueChildrenRepository $postCatalogueChildrenRepository)
    {
        $this->postCatalogueChildrenService = $postCatalogueChildrenService;
        $this->postCatalogueChildrenRepository = $postCatalogueChildrenRepository;
    }
    public function edit($id)
    {
        $postCatalogueParents = DB::table('post_catalogue_parent')
        ->select('id', 'post_catalogue_parent_name')
        ->orderBy('id', 'asc')
        ->get();

        $template = 'Backend.post.CatalogueChildren.store';

        $config = $this->configCUD();

        $config['seo'] = config('apps.postCatalogueChildren.edit');

        $config['method'] = 'edit';

        $id = $this->decryptId($id);

        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('post.catalogue.children.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $postCatalogueChildren = $this->postCatalogueChildrenRepository->findById($id);

        $this->authorize('modules', 'post.catalogue.children.edit');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueChildren','postCatalogueParents'));
    }
    public function update($id, UpdatePostCatalogueChildrenRequest $request)
    {

        if ($this->postCatalogueChildrenService->updatePostCatalogueChildren($id, $request)) {
            return redirect()->route('post.catalogue.children.index')->with('success', 'Cập nhật danh mục con thành công');
        }
        return redirect()->route('post.catalogue.children.index')->with('error', 'Cập nhật danh mục con thất bại. Hãy thử lại');
    }

    public function destroy($id)
    {
        $template = 'Backend.post.CatalogueChildren.destroy';

        $config = $this->configCUD();

        $config['seo'] = config('apps.postCatalogueChildren.delete');

        $id = $this->decryptId($id);

        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('post.catalogue.children.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $postCatalogueChildren = $this->postCatalogueChildrenRepository->findById($id);

        $this->authorize('modules', 'post.catalogue.children.destroy');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueChildren'));
    }


    public function delete(DeletePostCatalogueChildrenRequest $request, $id)
    {
        // dd($id);
        if ($request->hasPost()) {
            return redirect()->route('post.catalogue.children.index')->with('error', 'Không thể xóa danh mục con vì còn bài viết trong danh mục con.');
        }
        if ($this->postCatalogueChildrenService->deletePostCatalogueChildren($id)) {
            return redirect()->route('post.catalogue.children.index')->with('success', 'Xóa danh mục con thành công');
        }
        return redirect()->route('post.catalogue.children.index')->with('error', 'Xóa danh mục con thất bại. Hãy thử lại');
    }


    public function create(StorePostCatalogueChildrenRequest $request)
    {
        if ($this->postCatalogueChildrenService->createPostCatalogueChildren($request)) {
            return redirect()->route('post.catalogue.children.index')->with('success', 'Thêm mới danh mục con thành công');
        }
        return redirect()->route('post.catalogue.children.index')->with('error', 'Thêm mới danh mục con thất bại. Hãy thử lại');
    }

    public function store()
    {
        $postCatalogueParents = DB::table('post_catalogue_parent')
            ->select('id', 'post_catalogue_parent_name')
            ->orderBy('id', 'asc')
            ->get();

        $template = 'Backend.post.CatalogueChildren.store';

        $config = $this->configCUD();

        $config['seo'] = config('apps.postCatalogueChildren.create');

        $config['method'] = 'create';

        $this->authorize('modules', 'post.catalogue.children.store');
        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueParents'));
    }

    public function index(Request $request)
    {
        // echo 123;
        // die();

        $rules = [
            'keyword' => [
                'nullable',
                'regex:/^[^<>&]*$/'
            ],
        ];
        $messages = [
            'keyword.regex' => 'Trường này không được chứa các ký tự đặc biệt như <, >, &.'
        ];
        $request->validate($rules, $messages);
        $config = $this->configIndex();

        $template = 'Backend.post.CatalogueChildren.index';

        $config['seo'] = config('apps.postCatalogueChildren.index');

        $postCatalogueChildrens = $this->postCatalogueChildrenService->paginate($request);
        // dd($postCatalogueChildrens);
        // die();

        foreach ($postCatalogueChildrens as $childrenCatalogue) {
            $childrenCatalogue->encrypted_id = $this->encryptId($childrenCatalogue->id);
        }

        $this->authorize('modules', 'post.catalogue.children.index');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueChildrens'));
    }


    private function configIndex()
    {
        return [
            'js' => [
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'Backend/js/sb-admin-2.min.js',
                'Backend/vendor/chart.js/Chart.min.js',
                'Backend/js/demo/chart-area-demo.js',
                'Backend/js/demo/chart-pie-demo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                'Backend/libary/location.js',
                'Backend/plugins/ckfinder/ckfinder.js',
                'Backend/libary/finder.js',
                'Backend/plugins/datetimepicker-master/build/jquery.datetimepicker.full.js',
                'Backend/js/plugins/switchery/switchery.js',
            ],
            'css' => [
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                'Backend/plugins/datetimepicker-master/build/jquery.datetimepicker.min.css',
                'Backend/css/plugins/switchery/switchery.css',
            ],
            'model' => 'PostCataloguechildren'
        ];
    }
    private function configCUD()
    {
        return [
            'js' => [
                'Backend/vendor/jquery/jquery.min.js',
                'Backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'Backend/vendor/jquery-easing/jquery.easing.min.js',
                'Backend/js/sb-admin-2.min.js',
                'Backend/vendor/chart.js/Chart.min.js',
                'Backend/js/demo/chart-area-demo.js',
                'Backend/js/demo/chart-pie-demo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
            ],
            'css' => [
                'Backend/vendor/fontawesome-free/css/all.min.css',
                'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
                'Backend/css/sb-admin-2.min.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }
}
