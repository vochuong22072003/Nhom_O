<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nhom O</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('client/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/util.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/fonts/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

    <style type="text/css">
        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .btn-default {
            border-color: rgba(24, 28, 33, 0.1);
            background: rgba(0, 0, 0, 0);
            color: #4E5155;
        }

        label.btn {
            margin-bottom: 0;
        }

        .btn-outline-primary {
            border-color: #26B4FF;
            background: transparent;
            color: #26B4FF;
        }

        .btn {
            cursor: pointer;
        }

        .text-light {
            color: #babbbc !important;
        }

        .btn-facebook {
            border-color: rgba(0, 0, 0, 0);
            background: #3B5998;
            color: #fff;
        }

        .btn-instagram {
            border-color: rgba(0, 0, 0, 0);
            background: #000;
            color: #fff;
        }

        .card {
            background-clip: padding-box;
            box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
        }

        .row-bordered {
            overflow: hidden;
        }

        .account-settings-fileinput {
            position: absolute;
            visibility: hidden;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .account-settings-links .list-group-item.active {
            font-weight: bold !important;
        }

        html:not(.dark-style) .account-settings-links .list-group-item.active {
            background: transparent !important;
        }

        .account-settings-multiselect~.select2-container {
            width: 100% !important;
        }

        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }

        .light-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }

        .material-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }

        .material-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }

        .dark-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(255, 255, 255, 0.03) !important;
        }

        .dark-style .account-settings-links .list-group-item.active {
            color: #fff !important;
        }

        .light-style .account-settings-links .list-group-item.active {
            color: #4E5155 !important;
        }

        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
    </style>
</head>

<body>
    <!-- Topbar -->
    @include('client.layouts.topbar')
    <!-- Header -->
    <div class="container light-style flex-grow-1 container-p-y">

        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>

        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        {{-- general --}}
                        <a class="list-group-item list-group-item-action {{ request()->is('account_general') ? 'active' : '' }}"
                            href="{{ route('setting.general') }} ">General</a>
                        {{-- change-password --}}
                        <a class="list-group-item list-group-item-action {{ request()->is('account_change_password') ? 'active' : '' }}"
                            href="{{ route('setting.change-password') }} ">Change
                            password</a>
                        {{-- Info --}}
                        <a class="list-group-item list-group-item-action {{ request()->is('account_account_info') ? 'active' : '' }}"
                            href="{{ route('setting.account-info') }} ">Info</a>
                        
                        {{-- Notifications --}}
                        <a class="list-group-item list-group-item-action {{ request()->is('account_notifications') ? 'active' : '' }}"
                            href="{{ route('setting.notifications') }} ">Notifications</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">

                        {{-- @include('client.account-setting-partials.general')
            @include('client.account-setting-partials.change-password')
            @include('client.account-setting-partials.account-info')
            @include('client.account-setting-partials.social-links')
            @include('client.account-setting-partials.connnections')
            @include('client.account-setting-partials.notifications') --}}

                        @yield('form-group')

                    </div>
                </div>
            </div>
        </div>

        {{-- Button submit --}}

        <div class="text-right my-3">
            <button type="submit" form="@yield('form-id')" class="btn btn-primary">Save changes</button>&nbsp;
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('client/vendor/jquery/jquery-3.2.1.min.js') }}">;/script>
    <script src="{{ asset('client/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
