<div class="ibox-tools">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-wrench"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="#" class="changeStatusAll" data-field="publish" data-model="{{ $config['model'] }}" data-value="2">Publish</a>
        </li>
        <li><a href="#" class="changeStatusAll" data-field="publish" data-model="{{ $config['model'] }}" data-value="1">Unpublish</a>
        </li>
    </ul>
</div>
<script>
    var getChangeStatusAll = '{{ route('ajax.dashboard.changeStatusAll') }}';
</script>
