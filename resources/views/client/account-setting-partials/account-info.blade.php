@extends('client.layouts.account-settings')

@section('form-group')
    <!-- account info beggin -->
    <div class="tab-pane fade active show" id="account-info">
        <form id="info-form" action="{{ route('setting.account-info-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body pb-2">
                <div class="form-group">
                    <div class="card-body media align-items-center">
                        <img id="previewImage" src="{{ $cusInfo->getAvtUrl() }}" class="d-block ui-w-80">
                        <div class="media-body ml-4">
                            <label class="btn btn-outline-primary">
                                Upload new photo
                                <input id="image" name="cus_avt" type="file" class="account-settings-fileinput"
                                    accept="image/*">
                            </label> &nbsp;
                            <button type="button" class="btn btn-default md-btn-flat">Reset</button>

                            <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 5Mb</div>
                        </div>
                    </div>
                    @error('cus_avt')
                        <div class="alert alert-danger mt-3 mb-0">
                            {{ $errors->first('cus_avt') }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="cus_name" value="{{ old('cus_name', $cusInfo->cus_name) }}"
                        class="form-control">
                    @error('cus_name')
                        <div class="alert alert-danger mt-3 mb-0">
                            {{ $errors->first('cus_name') }}
                        </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label class="form-label">Birthday</label>
                    <input id="birth_date" name="birth_date" type="text" maxlength="10" class="form-control"
                        value="{{ old('birth_date', optional($cusInfo->birth_date)->format('d-m-Y')) }}" oninput="checkDate(this);">
                    @error('birth_date')
                        <div class="alert alert-danger mt-3 mb-0">
                            {{ $errors->first('birth_date') }}
                        </div>
                    @enderror
                </div>
                <div class="card-body pb-2 row" style="margin-left: -16px">
                    <div class="form-group col-6 px-0">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="custom-select">
                            @foreach ($genders as $gender)
                                <option {{ $gender == $cusInfo->gender ? 'selected' : '' }} value="{{ $gender }}">
                                    {{ $gender }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                            <div class="alert alert-danger mt-3 mb-0">
                                {{ $errors->first('gender') }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-6 px-0">
                        <label class="form-label">Phone</label>
                        <input id="cus_phone" name="cus_phone" type="text" class="form-control"
                            value="{{ old('cus_phone', $cusInfo->cus_phone) }}" minlength="10" maxlength="15"
                            oninput="reformatPhone(this);">
                        @error('cus_phone')
                            <div class="alert alert-danger mt-3 mb-0">
                                {{ $errors->first('cus_phone') }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input name="address" type="text" class="form-control"
                        value="{{ old('address', $cusInfo->address) }}">
                </div>
            </div>
        </form>
    </div>
    <!-- account info end -->

@endsection

@push('scripts')
<script defer src="{{ asset('client/js/account-setting.js') }}"></script>
@endpush

@section('form-id', 'info-form')
