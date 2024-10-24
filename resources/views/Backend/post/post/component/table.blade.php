<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width: 50px"> 
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <th>Tên bài viết</th>
            <th>Danh mục cha</th>
            <th>Danh mục con</th>
            <th>Tác giả</th>
            <th>Trạng thái</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($posts) && is_object($posts))
        @foreach($posts as $post)
        <tr class="rowdel-{{ $post->id }}">
            <td>
                <input type="checkbox" value="{{ $post->id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            <td>
                <div class="info-item">{{ $post->post_name  }} </div>
            </td>
            <td>
                <div class="info-item">{{ $post->post_catalogue_parent_name }}</div>
            </td>
            <td>
                <div class="info-item">{{ $post->post_catalogue_children_name }}</div>
            </td>
            <td>
                <div class="info-item">{{ $post->user_info->name }}</div>
            </td>
            <td class="text-center js-switch-{{ $post->id }}">
                <input type="checkbox" class="js-switch status" value="{{ $post->publish }}" data-field="publish" data-model="{{ $config['model'] }}" data-modelId="{{ $post->id }}" {{ ($post->publish==2)?'checked':'' }} >
            </td>
            <td class="text-center">
                <a href="{{ route('post.edit', $post->encrypted_id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('post.destroy', $post->encrypted_id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $posts->links('pagination::bootstrap-4') }}
<script>
    var getStatusUrl = '{{ route("ajax.dashboard.changeStatus") }}';
</script>
