<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход | Агентство "Фокус"</title>
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
        .auth-form-group input:focus {
            outline: none;
            border-color: #e74c3c;
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
            transition: 0.3s;
        }
        .auth-btn:hover {
            background: #c0392b;
        }
        .auth-links {
            margin-top: 20px;
            color: #888;
        }
        .auth-links a {
            color: #e74c3c;
            text-decoration: none;
        }
        .auth-links a:hover {
            text-decoration: underline;
        }
        .auth-error {
            background: #c0392b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="auth-container">
    <div class="auth-card">
        <img src="{{ asset('images/focus white.png') }}" alt="Логотип" class="auth-logo">
        <h1 class="auth-title">Вход в аккаунт</h1>

        @if($errors->any())
            <div class="auth-error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="auth-form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>

            <div class="auth-form-group" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="remember" id="remember" style="width: auto;">
                <label for="remember" style="margin: 0;">Запомнить меня</label>
            </div>

            <button type="submit" class="auth-btn">Войти</button>

            <div class="auth-links">
                <a href="{{ route('register') }}">Нет аккаунта? Зарегистрироваться</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>