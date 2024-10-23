<div class="row mb30">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">Tiêu đề bài viết: <span
                    class="text-danger">(*)</span></label>
            <input type="text" name="post_name" value="{{ old('post_name', ($post->post_name)??'') }}" class="form-control"
                placeholder="" autocomplete="off">
        </div>
    </div>
</div>
<div class="row mb30">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">Mô tả ngắn: </label>
            <textarea 
                type="text" 
                placeholder="" 
                autocomplete="off"
                name="post_excerpt" 
                class="form-control ck-editor" 
                id="description" 
                data-height="150"
            >
            {{ old('post_excerpt', ($post->post_excerpt)??'') }}
            </textarea>
        </div>
    </div>
</div>
<div class="row mb-15">
    <div class="col-lg-12">
        <div class="form-row">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <label for="" class="control-label text-left">Nội dung: </label>
            </div>
            <textarea 
                type="text" 
                placeholder="" 
                autocomplete="off"
                name="post_content" 
                class="form-control ck-editor" 
                id="ckContent" 
                data-height="500"
            >
            {{ old('post_content', ($post->post_content)??'') }}
            </textarea>
        </div>
    </div>
</div>
