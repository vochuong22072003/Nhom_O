@include('Backend.dashboard.component.breadcrumb', ['title' =>$config['seo']['title']])
<!-- từ khóa tìm kiếm/validation/Displaying the Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('post.catalogue.parent.delete',$postCatalogueParent->id) }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>- Bạn đang muốn xóa danh mục cha có tên danh mục là: <span style="color: red">{{ $postCatalogueParent->post_catalogue_parent_name }}</span></p>
                        <p>- Lưu ý <span class="text-danger">KHÔNG THỂ</span> khôi phục danh mục cha sau khi xóa. <br> Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên nhóm: <span class="text-danger">(*)</span></label>
                                    <input 
                                    type="text"
                                    name="name"
                                    value="{{ old('name', ($postCatalogueParent->post_catalogue_parent_name)??'') }}"
                                    class="form-control"
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú: <span class="text-danger">(*)</span></label>
                                    <input 
                                    type="text"
                                    name="description"
                                    value="{{ old('description', ($postCatalogueParent->post_catalogue_parent_description)??'') }}"
                                    class="form-control"
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                    >
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send">{{ $config['seo']['btnDelete'] }}</button>
        </div>
    </div>
</form>