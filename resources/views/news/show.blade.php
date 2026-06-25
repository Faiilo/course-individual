<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} | Агентство "Фокус"</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .news-detail-header {
            text-align: center;
            margin: 40px 0 30px;
        }
        .news-detail-title {
            font-size: 36px;
            font-weight: 800;
            color: #e74c3c;
            margin-bottom: 10px;
        }
        .news-detail-meta {
            color: #aaa;
            font-size: 14px;
        }
        .news-detail-content {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 30px;
            line-height: 1.7;
            font-size: 16px;
        }
        .news-detail-content p {
            margin-bottom: 20px;
        }
        .news-detail-content img {
            max-width: 500px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .paywall-block {
            text-align: center;
            padding: 40px;
            background: #111;
            border-radius: 20px;
            border: 1px solid #e74c3c;
        }
        .paywall-block h2 {
            color: #e74c3c;
            margin-bottom: 15px;
        }
        .paywall-block p {
            margin-bottom: 25px;
        }
        .paywall-block .btn {
            background: #e74c3c;
            color: white;
            padding: 10px 25px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }
        .paywall-block .btn-outline {
            background: transparent;
            border: 1px solid #e74c3c;
            color: #e74c3c;
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

    <div class="news-detail-header">
        <h1 class="news-detail-title">{{ $post->title }}</h1>
        <div class="news-detail-meta">{{ $post->created_at->format('d.m.Y H:i') }}</div>
    </div>

    @if($post->is_paid && !$post->isAccessible())
        <div class="paywall-block">
            <h2>🔒 Доступ ограничен</h2>
            <p>Эта новость доступна только подписчикам агентства «Фокус»</p>
            <a href="/subscription" class="btn">Оформить подписку</a>
            <a href="/news" class="btn btn-outline">← Вернуться к новостям</a>
        </div>
    @else
        <div class="news-detail-content">
            @if($post->media)
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="{{ asset('storage/' . $post->media->filename) }}" alt="{{ $post->title }}">
                </div>
            @endif
            {!! nl2br(e($post->text)) !!}
        </div>
    @endif

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