<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | Агентство "Фокус"</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="admin-header">
    <div class="admin-container">
        <div class="admin-logo">👑 Админ-панель</div>
        <div class="admin-nav">
            <a href="/">На сайт</a>
            <a href="{{ route('admin.dashboard') }}">Главная</a>
            <a href="{{ route('admin.news') }}">Новости</a>
            <a href="{{ route('admin.editorials.server1') }}">Редакции</a>
            <a href="{{ route('admin.users') }}">Пользователи</a>
        </div>
    </div>
</div>

<div class="admin-container">
    <div class="admin-stats">
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $stats['news_count'] }}</div>
            <div class="admin-stat-label">Новостей</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $stats['editorial_count'] }}</div>
            <div class="admin-stat-label">Редакций</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $stats['users_count'] }}</div>
            <div class="admin-stat-label">Пользователей</div>
        </div>
        <div class="admin-stat-card">
            <div class="admin-stat-number">{{ $stats['subscribers_count'] }}</div>
            <div class="admin-stat-label">Подписчиков</div>
        </div>
    </div>

    <div class="admin-card">
        <h2 style="color: #e74c3c; margin-bottom: 15px;">Добро пожаловать, {{ auth()->user()->name }}!</h2>
        <p>Здесь вы можете управлять контентом сайта.</p>
    </div>
</div>
</body>
</html>