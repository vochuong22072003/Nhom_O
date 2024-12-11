<!DOCTYPE html>
<html>
<head>
    <title>Thông báo</title>
</head>
<body>
    <h1>{{ $data['name'] }}</h1>
    <h3>{{ $data['message'] }}</h3>
    <p>{{ $data['token'] }}</p>
    <p>{{ $data['abilities'] }}</p>
    <p>{{ $data['expires_at'] }}</p>
    <p>Click <a href="{{ route('api.user.login') }}">Vào đây</a> để sử dụng Token API</p>
</body>
</html>
