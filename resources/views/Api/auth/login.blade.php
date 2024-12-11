<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Login User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($config['css'])&& is_array($config['css']))
        @foreach($config['css'] as $key => $val)
            <link href="{{ asset($val) }}" rel="stylesheet">
        @endforeach
    @endif
    <style>
        #login-form {
            display: none;
        }
        .error-api{
            font-size: 0.75rem;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Form đăng nhập API Token -->
        <div id="login-form" class="card mx-auto shadow p-4 mt-4" style="max-width: 400px;">
            <h2 class="card-title text-center mb-4">Đăng nhập API Token</h2>
            <div id="general-error" class="error-api" style="color: red;"></div>
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" class="form-control" placeholder="Nhập email" required>
                    <div id="email-error" class="error-api" style="color: red;"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
                    <div id="password-error" class="error-api" style="color: red;"></div>
                </div>
                <div class="mb-3">
                    <label for="token" class="form-label">Token:</label>
                    <input type="text" id="token" class="form-control" placeholder="Nhập token" required>
                    <div id="token-error" class="error-api" style="color: red;"></div>
                </div>
                <div class="mb-3">
                    <label for="roleAccount" class="form-label">Loại tài khoản:</label>
                    <select id="roleAccount" class="form-control setupSelect2" required>
                        <option value="0">Chọn loại tài khoản</option>
                        <option value="1">User</option>
                        <option value="2">Customer</option>
                    </select>
                    <div id="roleAccount-error" class="error-api" style="color: red;"></div>
                </div>
                <button type="button" id="login-button" class="btn btn-primary w-100">Đăng nhập</button>
            </form>
        </div>
    </div>

    @if(isset($config['js'])&& is_array($config['js']))
        @foreach($config['js'] as $key => $val)
            <script src=" {{ asset($val) }} "></script>
        @endforeach
    @endif
</body>
</html>

