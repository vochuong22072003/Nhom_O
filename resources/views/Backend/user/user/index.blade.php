
@include('Backend.dashboard.component.breadcrumb',['title' =>$config['seo']['title']])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row mt20">

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['table'] }} </h5>
                @include('Backend.dashboard.component.toolbox')
            </div>
            <div class="ibox-content">
                @include('Backend.user.user.component.filter')
                @include('Backend.user.user.component.table')
            </div>
        </div>
    </div>
</div>
