<form action="{{ route('user.catalogue.index') }}">
<div class="filter-wrapper">
    <div class="uk-flex uk-flex-middle uk-flex-space-between">
        <div class="perpage">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <select name="perpage" class="form-control input-sm perpage filter mr10" @php $perpage=request('perpage') ?: old('perpage') @endphp>
                    @for($i=20;$i<=200;$i+=20) 
                        <option {{ ($perpage == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                    @endfor
                </select>

            </div>
        </div>
        <div class="action">
            <div class="uk-flex uk-flex-middle">
                @php
                    $publish = request('publish') ?: old('publish');
                @endphp
                <select name="publish" class="form-control">
                    @foreach(config('apps.general.publish') as $key => $val)
                        <option {{ ($publish == $key) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
               
                <div class="uk-search uk-flex uk-flex-middle">
                    <div class="input-group input-my-search">
                        <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khóa bạn muốn tìm kiếm..."
                            class="form-control">
                        <span class="input-group-btn ">
                            <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm
                                kiếm</button>
                        </span>
                    </div>
                </div>
                <div class="uk-flex uk-flex-middle">
                    <a href="{{ route('user.catalogue.permission') }}" class="btn btn-warning btn-authorize"><i class="fa fa-key mr5"></i>Phân quyền</a>
                    <a href="{{ route('user.catalogue.store') }}" class="btn btn-danger btn-addUserCatalogue"><i class="fa fa-plus mr5"></i>Thêm mới nhóm thành viên</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>