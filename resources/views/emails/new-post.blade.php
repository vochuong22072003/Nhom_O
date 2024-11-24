<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $post->post_name }}</h1>
        </div>
        <p></p>
        {!! $post->post_excerpt !!}
        <p class="center"><a href="{{ $url }}" class="button">View New Post</a></p>

        <div class="footer">
            <p>Read more at we website. Nhom O</p>
        </div>
    </div>
</body>
</html>
