<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <th>Tên danh mục con</th>
            <th>Mô tả</th>
            <th>Tên danh mục cha</th>
            <th>Số lượng bài viết</th>
            <th>Trạng thái</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($postCatalogueChildrens) && is_object($postCatalogueChildrens))
        @foreach($postCatalogueChildrens as $postCatalogueChildren)
        <tr class="rowdel-{{ $postCatalogueChildren->id }}">
            <td>
                <input type="checkbox" value="{{ $postCatalogueChildren->post_catalogue_children_id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            
            <td>
                <div class="info-item name">{{ $postCatalogueChildren->post_catalogue_children_name }}</div>
            </td>
            <td>
                <div class="info-item email">{{ $postCatalogueChildren->post_catalogue_children_description }}</div>
            </td>
            <td>
                <div class="info-item email">{{$postCatalogueChildren->post_catalogue_parent->post_catalogue_parent_name}}</div>
            </td>
            <td>
                <div class="info-item email">{{ $postCatalogueChildren->posts_count ?? '' }}</div>
            </td>
            <td class="text-center js-switch-{{ $postCatalogueChildren->id }}">
                <input type="checkbox" class="js-switch status" value="{{ $postCatalogueChildren->publish }}" data-field="publish" data-model="{{ $config['model'] }}" data-modelId="{{ $postCatalogueChildren->id }}" {{ ($postCatalogueChildren->publish==2)?'checked':'' }} >
            </td>
            <td class="text-center">
                <a href="{{ route('post.catalogue.children.edit', $postCatalogueChildren->encrypted_id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('post.catalogue.children.destroy', $postCatalogueChildren->encrypted_id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $postCatalogueChildrens->links('pagination::bootstrap-4') }}
<script>
    var getStatusUrl = '{{ route("ajax.dashboard.changeStatus") }}';
</script>