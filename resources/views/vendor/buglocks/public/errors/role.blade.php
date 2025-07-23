<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Unauthorized Role</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .unauth-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
      text-align: center;
      max-width: 550px;
    }

    .unauth-icon {
      font-size: 60px;
      color: #764ba2;
    }

    .unauth-message {
      font-size: 1.5rem;
      color: #333;
      margin-bottom: 10px;
    }

    .unauth-desc {
      color: #666;
      margin-bottom: 20px;
    }

    .btn-contact {
      background-color: #764ba2;
      color: white;
      padding: 12px 30px;
      border-radius: 50px;
      transition: background-color 0.3s ease;
    }

    .btn-contact:hover {
      background-color: #5d3e8a;
    }
  </style>
</head>
<body>

  <div class="unauth-container">
    <div class="unauth-icon">
      🚫
    </div>
    <div class="unauth-message">Access Denied</div>
    <p class="unauth-desc">{{ session('message') ?? config('buglocks.middleware.error.unauthorized-role') }}</p>
    <a href="{{Route('auth.login')}}" class="btn btn-contact">Return to Home</a>
  </div>

</body>
</html>
