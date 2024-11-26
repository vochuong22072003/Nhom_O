@extends('client.layouts.account-settings')

@section('form-group')
    <!-- account change password beggin -->
    <div class="tab-pane fade active show" id="account-change-password">
        <div class="card-body pb-2">
            <form id="change-password-form" action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="form-label">Current password</label>
                    <input id="current_password" name="current_password" type="password" class="form-control" value="{{ old('current_password') }}">
                    @error('current_password')
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('current_password') }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New password</label>
                    <input id="password" name="password" type="password" class="form-control" value="{{ old('password') }}">
                    @error('password')
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('password') }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Repeat new password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                </div>
            </form>
        </div>
    </div>
    <!-- account change password end -->

@endsection

@section('form-id', 'change-password-form')
