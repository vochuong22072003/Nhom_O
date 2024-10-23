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
@php
$url=($config['method']=='create')?route('post.catalogue.children.create'):route('post.catalogue.children.update', $postCatalogueChildren->id)
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>- Nhập thông tin chung của danh mục bài viết con</p>
                        <p>- Lưu ý: những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
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
                                    <label for="" class="control-label text-left">Tên danh mục con: <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" name="post_catalogue_children_name" value="{{ old('post_catalogue_children_name', ($postCatalogueChildren->post_catalogue_children_name)??'') }}"
                                        class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú:</label>
                                    <input type="text" name="post_catalogue_children_description"
                                        value="{{ old('post_catalogue_children_description', ($postCatalogueChildren->post_catalogue_children_description)??'') }}"
                                        class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <select name="publish" class="form-control setupSelect2" id="">
                                        @foreach(config('apps.general.publish') as $key => $val)
                                        <option
                                            {{ $key == old('publish', (isset($postCatalogueChildren->publish)) ? $postCatalogueChildren->publish : '') ? 'selected' : '' }}
                                            value="{{ $key }}">
                                            {{ $val }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <select name="post_catalogue_parent_id" class="form-control setupSelect2" id="">
                                        @foreach($postCatalogueParents as $postCatalogueParent)
                                        <option
                                            {{ $postCatalogueParent->id == old('post_catalogue_parent_id', (isset($postCatalogueParent->post_catalogue_parent_name)) ? $postCatalogueParent->post_catalogue_parent_name : '') ? 'selected' : '' }}
                                            value="{{ $postCatalogueParent->id }}">
                                            {{ $postCatalogueParent->post_catalogue_parent_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt15">
            <button class="btn btn-primary" type="submit" name="send"
                value="send">{{ $config['seo']['btnTitle'] }}</button>
        </div>
    </div>
</form>