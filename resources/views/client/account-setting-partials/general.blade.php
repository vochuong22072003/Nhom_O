@extends('client.layouts.account-settings')

@section('form-group')
    <!-- general beggin -->
    <div class="tab-pane fade active show" id="account-general">

        <div class="card-body media align-items-center">
            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="d-block ui-w-80">
            <div class="media-body ml-4">
                <label class="btn btn-outline-primary">
                    Upload new photo
                    <input type="file" class="account-settings-fileinput">
                </label> &nbsp;
                <button type="button" class="btn btn-default md-btn-flat">Reset</button>

                <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
            </div>
        </div>
        <hr class="border-light m-0">

        <div class="card-body">
            <form id="general-form" action="">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control mb-1" value="nmaxwell">
                </div>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="Nelle Maxwell">
                </div>
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="text" class="form-control mb-1" value="nmaxwell@mail.com">
                    <div class="alert alert-warning mt-3">
                        Your email is not confirmed. Please check your inbox.<br>
                        <a href="javascript:void(0)">Resend confirmation</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Company</label>
                    <input type="text" class="form-control" value="Company Ltd.">
                </div>
            </form>
        </div>

    </div>
    <!-- general end -->
@endsection

@section('form-id', 'general-form')
