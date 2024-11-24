@extends('client.layouts.account-settings')

@section('form-group')
    <!-- general beggin -->
    <div class="tab-pane fade active show" id="account-general">
        <div class="card-body">
            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form id="general-form" action="{{ route('setting.general-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control mb-1" name="cus_user"
                        value="{{ old('cus_user', $cus->cus_user) }}">
                    @error('cus_user')
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('cus_user') }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control mb-1" name="email" value="{{ old('email', $cus->email) }}">

                    @error('email')
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('email') }}
                        </div>
                    @enderror

                    {{--  Email verify  --}}
                    @if ($cus instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$cus->hasVerifiedEmail())
                        <div class="alert alert-warning mt-3">
                            <span class="mb-3">
                                Your email is not confirmed. Please confirm now.<br>
                            </span>
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 text-success">
                                A new verification link has been sent to the email address you provided during registration.
                            </div>
                        @endif

                        <button type="submit" form="send-verification" class="btn-sendemail">
                            Send Verification Email
                        </button>
                    @else
                    <div class="alert alert-success mt-3">
                        <span class="mb-3">
                            Your email is confirmed.<br>
                        </span>
                    </div>
                    @endif
                </div>
            </form>

        </div>

    </div>
    <!-- general end -->
@endsection

@section('form-id', 'general-form')
