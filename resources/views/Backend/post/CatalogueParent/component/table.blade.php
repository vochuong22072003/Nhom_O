<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <th>Tên danh mục cha</th>
            <th>Mô tả</th>
            <th>Số lượng bài viết</th>
            <th>Trạng thái</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($postCatalogueParents) && is_object($postCatalogueParents))
        @foreach($postCatalogueParents as $postCatalogueParent)
        <tr class="rowdel-{{ $postCatalogueParent->id }}">
            <td>
                <input type="checkbox" value="{{ $postCatalogueParent->id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            
            <td>
                <div class="info-item name">{{ $postCatalogueParent->post_catalogue_parent_name }}</div>
            </td>
            <td>
                <div class="info-item email">{{ $postCatalogueParent->post_catalogue_parent_description }}</div>
            </td>
            <td>
                <div class="info-item email">{{ $postCatalogueParent->posts_count ?? '' }}</div>
            </td>
            <td class="text-center js-switch-{{ $postCatalogueParent->id }}">
                <input type="checkbox" class="js-switch status" value="{{ $postCatalogueParent->publish }}" data-field="publish" data-model="{{ $config['model'] }}" data-modelId="{{ $postCatalogueParent->id }}" {{ ($postCatalogueParent->publish==2)?'checked':'' }} >
            </td>
            <td class="text-center">
                <a href="{{ route('post.catalogue.parent.edit', $postCatalogueParent->encrypted_id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('post.catalogue.parent.destroy', $postCatalogueParent->encrypted_id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $postCatalogueParents->links('pagination::bootstrap-4') }}
<script>
    var getStatusUrl = '{{ route("ajax.dashboard.changeStatus") }}';
</script>