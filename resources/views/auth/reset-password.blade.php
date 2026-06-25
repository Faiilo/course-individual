<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля | Агентство "Фокус"</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .auth-container {
            max-width: 500px;
            margin: 80px auto;
            padding: 20px;
        }
        .auth-card {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }
        .auth-logo {
            width: 80px;
            margin-bottom: 20px;
        }
        .auth-title {
            font-size: 28px;
            color: #e74c3c;
            margin-bottom: 30px;
        }
        .auth-form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .auth-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #888;
        }
        .auth-form-group input {
            width: 100%;
            padding: 12px;
            background: #2a2a2a;
            border: 1px solid #333;
            border-radius: 8px;
            color: white;
            font-size: 16px;
        }
        .auth-btn {
            width: 100%;
            background: #e74c3c;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .auth-links {
            margin-top: 20px;
        }
        .auth-links a {
            color: #e74c3c;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="auth-container">
    <div class="auth-card">
        <img src="{{ asset('images/focus white.png') }}" alt="Логотип" class="auth-logo">
        <h1 class="auth-title">Сброс пароля</h1>

        @if(session('status'))
            <div style="background: #27ae60; padding: 10px; border-radius: 8px; margin-bottom: 20px;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="auth-form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <button type="submit" class="auth-btn">Отправить ссылку для сброса</button>

            <div class="auth-links">
                <a href="{{ route('login') }}">Вернуться ко входу</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>