<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступ ограничен | Агентство "Фокус"</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .paywall-card {
            max-width: 500px;
            margin: 80px auto;
            background: #1a1a1a;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            border: 1px solid #c0392b;
        }
        .paywall-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        .paywall-title {
            font-size: 28px;
            font-weight: 800;
            color: #e74c3c;
            margin-bottom: 15px;
        }
        .paywall-text {
            color: #aaa;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        .paywall-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .paywall-btn {
            background: #e74c3c;
            color: white;
            padding: 10px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .paywall-btn-outline {
            background: transparent;
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }
        .paywall-btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
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

    <div class="paywall-card">
        <div class="paywall-icon">🔒</div>
        <div class="paywall-title">Доступ ограничен</div>
        <div class="paywall-text">
            Эта новость доступна только подписчикам агентства «Фокус».<br>
            Оформите подписку, чтобы читать все материалы без ограничений.
        </div>
        <div class="paywall-buttons">
            <a href="/subscription" class="paywall-btn">Оформить подписку</a>
            <a href="/" class="paywall-btn paywall-btn-outline">На главную</a>
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