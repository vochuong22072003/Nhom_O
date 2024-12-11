<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Create User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($config['css'])&& is_array($config['css']))
        @foreach($config['css'] as $key => $val)
            <link href="{{ asset($val) }}" rel="stylesheet">
        @endforeach
    @endif
    <style>
        #create-form {
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
        <!-- <h1 class="my-4 text-center">Danh sách người dùng</h1> -->
        <div id="user-data"></div>
        <div id="loading-spinner" style="display: none;">
            <img src="{{ asset('Backend/img/spinner.gif') }}" alt="Loading..." style="width: 50px; height: 50px;">
            <p>Đang tiến hành tạo API Token...</p>
        </div>

        <!-- Form tạo API Token -->
        <div id="create-form" class="card mx-auto shadow p-4 mt-4" style="max-width: 400px;">
            <h2 class="card-title text-center mb-4">Tạo API Token</h2>
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
                    <label for="modelToken" class="form-label">Model nhận token:</label>
                    <select id="modelToken" class="form-control setupSelect2" required>
                        <option value="0">Chọn model</option>
                        <option value="1">User</option>
                        <option value="2">Customer</option>
                    </select>
                    <div id="modelToken-error" class="error-api" style="color: red;"></div>
                </div>
                <div class="mb-3">
                    <label for="userIdToken" class="form-label">ID Nhận Token:</label>
                    <input type="number" id="userIdToken" class="form-control" placeholder="Nhập user id..." required>
                    <div id="userIdToken-error" class="error-api" style="color: red;"></div>
                </div>
                <div class="mb-3">
                    <label for="expires-at" class="form-label">Thời hạn token:</label>
                    <select id="expires-at" class="form-control setupSelect2" required>
                        <option value="0">Chọn option</option>
                        <option value="1">1 phút</option>
                        <option value="5">5 phút</option>
                        <option value="15">15 phút</option>
                        <option value="30">30 phút</option>
                        <option value="60">1 giờ</option>
                        <option value="1440">1 ngày</option>
                        <option value="">Không giới hạn</option>
                    </select>
                    <div id="expiresAt-error" class="error-api" style="color: red;"></div>
                </div>
                <div class="mb-3">
                    <label for="abilities" class="form-label">Khả năng token:</label>
                    <select id="abilities" class="form-control setupSelect2" required multiple>
                        <option value="0">Chọn option</option>
                        <option value="user">Users</option>
                        <option value="post">Posts</option>
                        <option value="all">All</option>
                    </select>
                    <div id="abilities-error" class="error-api" style="color: red;"></div>
                </div>
                <button type="button" id="create-button" class="btn btn-primary w-100">Tạo API Token</button>
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

