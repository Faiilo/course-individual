<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Агентство "Фокус" — Главная</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <a href="/" class="active">Главная</a>
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

    <section class="news-section">
        <div class="container">
            <h2 class="section-title">Последние новости</h2>
            <div class="news-grid">
                @forelse($latestNews as $item)
                <div class="news-card">
                    <div class="news-content">
                        <h3 class="news-title">
                            <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="news-description">{{ Str::limit($item->text, 100) }}</p>
                        <span class="news-date">{{ $item->created_at->format('d.m.Y') }}</span>
                        @if($item->is_paid)
                            <div class="paid-badge">🔒 Только для подписчиков</div>
                        @endif
                    </div>
                </div>
                @empty
                    <p>Новостей пока нет</p>
                @endforelse
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="/news" class="btn-all-news">Все новости →</a>
            </div>
        </div>
    </section>

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