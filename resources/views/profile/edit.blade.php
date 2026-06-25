<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля | Агентство "Фокус"</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .profile-card {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 30px;
        }
        .profile-card h2 {
            color: #e74c3c;
            margin-bottom: 25px;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #888;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            background: #2a2a2a;
            border: 1px solid #333;
            border-radius: 8px;
            color: white;
            font-size: 16px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #e74c3c;
        }
        .form-group small {
            color: #888;
            font-size: 12px;
        }
        .btn-save {
            background: #e74c3c;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-save:hover {
            background: #c0392b;
        }
        .btn-cancel {
            display: inline-block;
            margin-left: 15px;
            color: #888;
            text-decoration: none;
        }
        .btn-cancel:hover {
            color: #e74c3c;
        }
        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }
        .success-message {
            background: #27ae60;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <div class="menu-bar">
        <div class="logo-block">
            <div class="logo-icon">
                <img src="{{ asset('images/focus white.png') }}" alt="Логотип">
            </div>
            <div class="logo-text">Агентство "Фокус"</div>
        </div>
        <div class="menu-links">
            <a href="/">Главная</a>
            <a href="/about">О нас</a>
            <a href="/archive/server1">Архив редакций</a>
            <a href="/subscription">Подписка</a>
            <a href="/news">Новости</a>
        </div>
        <div class="auth-buttons">
            @auth
                @if(auth()->user()->is_admin == 1)
                    <a href="/admin" class="btn-admin">👑</a>
                @endif
                <a href="/profile" class="btn-login">Профиль</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-register" style="cursor: pointer;">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-login">Вход</a>
                <a href="{{ route('register') }}" class="btn-register">Регистрация</a>
            @endauth
        </div>
    </div>

    <div class="profile-container">
        <div class="profile-card">
            <h2>Редактирование профиля</h2>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Новый пароль (оставьте пустым, если не хотите менять)</label>
                    <input type="password" name="password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Подтверждение пароля</label>
                    <input type="password" name="password_confirmation">
                </div>

                <button type="submit" class="btn-save">Сохранить изменения</button>
                <a href="{{ route('profile.index') }}" class="btn-cancel">Отмена</a>
            </form>
        </div>
    </div>

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-copyright">
                <span>© 2026 Агентство "Фокус"</span>
                <span>Платформа поддержки Малиновка РП</span>
            </div>
            <div class="footer-links">
                <a href="/about">О проекте</a>
                <a href="#">Политика конфиденциальности</a>
                <a href="https://vk.com/focusmalinovka" target="_blank">VK Сообщество</a>
                <a href="#">Контакты</a>
            </div>
        </div>
        <hr>
        <div style="text-align: center; font-size: 0.7rem; opacity: 0.7;">
            Агентство "Фокус" | vk.com/focusmalinovka — ваш источник актуальных новостей и аналитики на Малиновке.
        </div>
    </div>
</div>
</body>
</html>