<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Агентство "Фокус" — О проекте</title>
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
            <a href="/about" class="active">О нас</a>
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

    <div class="about-section">
        <div class="about-title">О проекте</div>
        <div class="about-description">
            Агентство «Фокус» — ваш проводник по Малиновке.<br>
            Мы организовываем фотосессии, публикуем лучшие кадры от наших фотографов, игровые новости.<br>
            Но главный фокус — на списке Forbes Малиновки. В этом списке собраны самые богатые игроки со всех 4 серверов.
        </div>
    </div>

    <div class="history-wrapper">
        <div class="history-header">Краткая история агентства</div>
        <div class="timeline-cards">
            @foreach($history as $item)
            <div class="card-year">
                <div class="year-big">{{ $item['year'] }}</div>
                <div class="year-day-month">{{ $item['date'] }}</div>
                <div class="year-title">{{ $item['title'] }}</div>
                <div class="year-desc">{{ $item['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="team-section">
        <div class="team-header">Команда агентства</div>
        <div class="team-grid">
            @foreach($team as $member)
            <div class="team-card">
                <div class="avatar">
                    <img src="{{ asset('images/' . $member['image']) }}" alt="{{ $member['name'] }}">
                </div>
                <div class="team-nick">{{ $member['name'] }}</div>
                <div class="team-role">{{ $member['role'] }}</div>
            </div>
            @endforeach
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