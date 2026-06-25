<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все новости | Агентство "Фокус"</title>
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
            <a href="/">Главная</a>
            <a href="/about">О нас</a>
            <a href="/archive/server1">Архив редакций</a>
            <a href="/subscription">Подписка</a>
            <a href="/news" class="active">Новости</a>
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

    <div class="news-header">
        <h1>Все новости</h1>
        <p>Актуальные события и аналитика</p>
    </div>

    <div class="news-list">
        @forelse($news as $item)
        <div class="news-item">
            <div class="news-item-inner">
                @if($item->media)
<div class="news-image">
    @if($item->isAccessible())
        <img src="{{ asset('storage/' . $item->media->filename) }}" alt="{{ $item->title }}">
    @else
        <div class="blurred-image" style="width:100%; height:200px; background: url('{{ asset('storage/' . $item->media->filename) }}') center/cover no-repeat; filter: blur(8px); border-radius: 10px; pointer-events: none;"></div>
    @endif
</div>
@endif
                <div class="news-content">
                    <h2 class="news-title"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></h2>
                    <div class="news-meta">
                        <span>{{ $item->created_at->format('d.m.Y') }}</span>
                        @if($item->is_paid)
                            <span class="paid-badge">🔒 Только для подписчиков</span>
                        @endif
                    </div>
                    @if($item->isAccessible())
                        <p class="news-excerpt">{{ Str::limit($item->text, 200) }}</p>
                        <a href="{{ route('news.show', $item->id) }}" class="read-more">Читать далее →</a>
                    @else
                        <div class="premium-teaser">
                            <span>⭐</span>
                            <span>Только для подписчиков</span>
                            <a href="/subscription">Оформить</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
            <p style="text-align: center; padding: 60px;">Новостей пока нет</p>
        @endforelse
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