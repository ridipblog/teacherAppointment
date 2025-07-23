<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>403 - Unauthorized Access</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ff4e50, #f9d423);
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
        }

        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #ff4e50;
        }

        .error-message {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .btn-home {
            background-color: #ff4e50;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #e83e3e;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <div class="error-code">403</div>
        <div class="error-message">Unauthorized Access</div>
        <p>{{ session('message') ?? config('buglocks.middleware.error.unauthorized') }}</p>
        <a href="{{ Route('auth.login') }}" class="btn btn-home mt-3">Go to Home</a>
    </div>

</body>

</html>
