<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Permission Denied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .permission-container {
            text-align: center;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .permission-icon {
            font-size: 70px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .permission-title {
            font-size: 2rem;
            color: #333333;
            margin-bottom: 10px;
        }

        .permission-desc {
            font-size: 1rem;
            color: #777777;
            margin-bottom: 30px;
        }

        .btn-request {
            background-color: #dc3545;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-request:hover {
            background-color: #b02a37;
        }
    </style>
</head>

<body>

    <div class="permission-container">
        <div class="permission-icon">🔐</div>
        <div class="permission-title">Permission Denied</div>
        <p class="permission-desc">
            {{ session('message') ?? config('buglocks.middleware.error.unauthorized-permission') }}</p>
        <a href="{{ Route('auth.login') }}" class="btn btn-request">Request Access</a>
    </div>

</body>

</html>
