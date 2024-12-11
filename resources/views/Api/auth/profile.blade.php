<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Profile User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($config['css'])&& is_array($config['css']))
        @foreach($config['css'] as $key => $val)
            <link href="{{ asset($val) }}" rel="stylesheet">
        @endforeach
    @endif
    <style>
        .error-api{
            font-size: 0.75rem;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Form đăng nhập API Token -->
        <div class="card mx-auto shadow p-4 mt-4" style="max-width: 400px;">
            <h2 class="card-title text-center mb-4">Profile API Token</h2>
            <p class="card-title text-left mt-1 mb-4">Xin chào: {{ ($user_logged->getTable() == 'users' ? $user_logged->user_profile->name :  $user_logged->customerInfo->cus_name) ?? null }}</p>
            <p class="card-title text-left mb-4">Loại tài khoản: {{ ($user_logged->getTable() == 'users' ? 'User' : 'Customer') ?? null }}</p>
            <div class="mb-3">
                <a href="{{ route('api.data', ['model' => 'user']) }}">Xem dữ liệu users</a>
            </div>
            <div class="mb-3">
                <a href="{{ route('api.data', ['model' => 'post']) }}">Xem dữ liệu posts</a>
            </div>
            <div class="mb-3">
                <a href="">Tạo mới Token</a>
            </div>
            <div class="mb-3">
                <a href="">Xóa Token</a>
            </div>
            <div class="mb-3">
                <a href="{{ route('api.user.logout') }}">Đăng xuất</a>
            </div>
        </div>
    </div>

    @if(isset($config['js'])&& is_array($config['js']))
        @foreach($config['js'] as $key => $val)
            <script src=" {{ asset($val) }} "></script>
        @endforeach
    @endif
</body>
</html>

