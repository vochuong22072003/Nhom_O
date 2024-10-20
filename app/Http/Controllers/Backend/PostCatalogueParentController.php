<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostCatalogueParentRequest;
use App\Http\Requests\UpdatePostCatalogueParentRequest;
use App\Http\Requests\DeletePostCatalogueParentRequest;
use App\Services\Interfaces\PostCatalogueParentServiceInterface as PostCatalogueParentService;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;

class PostCatalogueParentController extends Controller
{
    protected $postCatalogueParentService;
    protected $postCatalogueParentRepository;

    public function __construct(PostCatalogueParentService $postCatalogueParentService, PostCatalogueParentRepository $postCatalogueParentRepository)
    {
        $this->postCatalogueParentService = $postCatalogueParentService;
        $this->postCatalogueParentRepository = $postCatalogueParentRepository;
    }

    //đổ giao diện
    public function store()
    {
        $template = 'Backend.post.CatalogueParent.store';

        $config = $this->configCUD();

        $config['seo'] = config('apps.postCatalogueParent.create');

        $config['method'] = 'create';

        $this->authorize('modules', 'post.catalogue.parent.store');

        return view('Backend.dashboard.layout', compact('template', 'config'));
    }
    public function index(Request $request)
    {
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

        $template = 'Backend.post.CatalogueParent.index';

        $config['seo'] = config('apps.postCatalogueParent.index');

        $postCatalogueParents = $this->postCatalogueParentService->paginate($request);
        // dd($postCatalogueParents);
        // die();

        foreach ($postCatalogueParents as $parentCatalogue) {
            $parentCatalogue->encrypted_id = $this->encryptId($parentCatalogue->id);
        }

        $this->authorize('modules', 'post.catalogue.parent.index');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueParents'));
    }
    public function create(StorePostCatalogueParentRequest $request)
    {
        if ($this->postCatalogueParentService->createPostCatalogueParent($request)) {
            return redirect()->route('post.catalogue.parent.index')->with('success', 'Thêm mới danh mục cha thành công');
        }
        return redirect()->route('post.catalogue.parent.index')->with('error', 'Thêm mới danh mục cha thất bại. Hãy thử lại');
    }
    public function edit($id)
    {
        $template = 'Backend.post.CatalogueParent.store';

        $config = $this->configCUD();

        $config['seo'] = config('apps.postCatalogueParent.edit');

        $config['method'] = 'edit';

        $id = $this->decryptId($id);

        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('post.catalogue.parent.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $postCatalogueParent = $this->postCatalogueParentRepository->findById($id);

        $this->authorize('modules', 'post.catalogue.parent.edit');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueParent'));
    }
    public function update($id, UpdatePostCatalogueParentRequest $request)
    {

        if ($this->postCatalogueParentService->updatePostCatalogueParent($id, $request)) {
            return redirect()->route('post.catalogue.parent.index')->with('success', 'Cập nhật danh mục cha thành công');
        }
        return redirect()->route('post.catalogue.parent.index')->with('error', 'Cập nhật danh mục cha thất bại. Hãy thử lại');
    }

    public function destroy($id)
    {
        $template = 'Backend.post.CatalogueParent.destroy';

        $config = $this->configCUD();

        $config['seo'] = config('apps.postCatalogueParent.delete');

        $id = $this->decryptId($id);

        if (!preg_match('/^[0-9A-Za-z=]+$/', $id)) {
            return redirect()->route('post.catalogue.parent.index')->withErrors('ID không hợp lệ. Vui lòng sử dụng ID đã mã hóa.');
        }

        $postCatalogueParent = $this->postCatalogueParentRepository->findById($id);

        $this->authorize('modules', 'post.catalogue.parent.destroy');

        return view('Backend.dashboard.layout', compact('template', 'config', 'postCatalogueParent'));
    }


    public function delete(DeletePostCatalogueParentRequest $request, $id)
    {
        // dd($id);
        if ($request->hadPostCatelogueChildren()) {
            return redirect()->route('post.catalogue.parent.index')->with('error', 'Không thể xóa danh mục cha vì còn danh mục con trong danh mục cha.');
        }
        if ($this->postCatalogueParentService->deletePostCatalogueParent($id)) {
            return redirect()->route('post.catalogue.parent.index')->with('success', 'Xóa danh mục cha thành công');
        }
        return redirect()->route('post.catalogue.parent.index')->with('error', 'Xóa danh mục cha thất bại. Hãy thử lại');
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
            'model' => 'PostCatalogueparent'
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
