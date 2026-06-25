<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Агентство "Фокус" — Подписка Focus Premium</title>
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
            <a href="/subscription" class="active">Подписка</a>
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

    <div class="subscription-section">
        <h1>Подписка Focus Premium</h1>
        <div class="description-text">
            Focus Premium — максимальный уровень вовлечённости в жизнь Малиновка РП. Получайте ранний доступ к редакциям, эксклюзивные медиаматериалы, участвуйте в закрытых трансляциях и голосованиях.
        </div>
    </div>

    <div class="benefits-grid">
        <div class="benefit-card">
            <div class="benefit-icon">📰</div>
            <div class="benefit-title">Реестр скинов</div>
            <div class="benefit-desc">Доступ к закрытому реестру скинов с гос. стоимостью, видами и названиями</div>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon">🎥</div>
            <div class="benefit-title">Медиатека</div>
            <div class="benefit-desc">Видео, фоторепортажи и подкасты, которые недоступны обычным пользователям.</div>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon">💬</div>
            <div class="benefit-title">Закрытый чат</div>
            <div class="benefit-desc">Общение с командой агентства, ранние анонсы и эксклюзивные розыгрыши.</div>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon">✨</div>
            <div class="benefit-title">Без рекламы</div>
            <div class="benefit-desc">Просмотр контента без баннеров и ограничений, приоритетная поддержка.</div>
        </div>
    </div>

    <div class="action-block">
        <button class="btn-subscribe" id="subscribeBtn">Оформить подписку Premium за 490₽/месяц</button>
        <div class="fine-print">Оплата банковской картой, автопродление можно отключить в любой момент. Первые 7 дней бесплатно при пробном периоде.</div>
        <div class="fine-print">Уже есть подписка? <a href="#">Управлять подпиской →</a></div>
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
            Агентство "Фокус" | vk.com/focusmalinovka — премиум-доступ к самому важному контенту.
        </div>
    </div>
</div>
</body>
</html>