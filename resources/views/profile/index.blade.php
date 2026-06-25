<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль | Агентство "Фокус"</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .profile-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .profile-header {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            background: #2a2a2a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 48px;
            border: 3px solid #e74c3c;
        }
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .profile-email {
            color: #888;
            margin-bottom: 15px;
        }
        .profile-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-admin {
            background: #e74c3c;
            color: white;
        }
        .badge-subscriber {
            background: #27ae60;
            color: white;
        }
        .badge-user {
            background: #2a2a2a;
            color: #888;
        }
        .profile-card {
            background: #1a1a1a;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }
        .profile-card h3 {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #333;
        }
        .info-label {
            color: #888;
        }
        .info-value {
            color: white;
            font-weight: 500;
        }
        .btn-edit {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
            margin-top: 15px;
        }
        .btn-edit:hover {
            background: #c0392b;
        }
        .subscription-status {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .subscription-active {
            background: #27ae60;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 14px;
        }
        .subscription-inactive {
            background: #2a2a2a;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 14px;
        }
        .subscription-btn {
            background: #e74c3c;
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
        }
        .comments-list {
            list-style: none;
        }
        .comment-item {
            padding: 15px;
            background: #2a2a2a;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .comment-text {
            color: #ccc;
            margin-bottom: 5px;
        }
        .comment-meta {
            font-size: 12px;
            color: #888;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #888;
        }
        @media (max-width: 768px) {
            .profile-container {
                margin: 20px auto;
            }
            .info-row {
                flex-direction: column;
                gap: 5px;
            }
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
        <div class="profile-header">
            <div class="profile-avatar">👤</div>
            <div class="profile-name">{{ $user->name }}</div>
            <div class="profile-email">{{ $user->email }}</div>
            <div>
                @if($user->is_admin)
                    <span class="profile-badge badge-admin">👑 Администратор</span>
                @elseif($hasSubscription)
                    <span class="profile-badge badge-subscriber">⭐ Подписчик Focus Premium</span>
                @else
                    <span class="profile-badge badge-user">👤 Пользователь</span>
                @endif
            </div>
        </div>

        <div class="profile-card">
            <h3>Информация об аккаунте</h3>
            <div class="info-row">
                <span class="info-label">Дата регистрации</span>
                <span class="info-value">{{ $user->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">ID пользователя</span>
                <span class="info-value">{{ $user->id }}</span>
            </div>
            <a href="{{ route('profile.edit') }}" class="btn-edit">✏️ Редактировать профиль</a>
        </div>

        <div class="profile-card">
            <h3>Подписка Focus Premium</h3>
            <div class="subscription-status">
                @if($hasSubscription)
                    <span class="subscription-active">✅ Активна</span>
                    <span style="color: #888;">Действует до: бессрочно (тестовый период)</span>
                @else
                    <span class="subscription-inactive">❌ Не активна</span>
                    <a href="/subscription" class="subscription-btn">Оформить подписку</a>
                @endif
            </div>
        </div>

        <div class="profile-card">
            <h3>Мои комментарии</h3>
            @if(count($comments) > 0)
                <ul class="comments-list">
                    @foreach($comments as $comment)
                        <li class="comment-item">
                            <div class="comment-text">{{ $comment->text }}</div>
                            <div class="comment-meta">К новости: {{ $comment->post->title ?? '—' }}</div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="empty-state">
                    <p>У вас пока нет функции писать комментариев</p>
                    <p style="font-size: 14px; margin-top: 10px;">Пните разраба под любой новостью под любой новостью!</p>
                </div>
            @endif
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