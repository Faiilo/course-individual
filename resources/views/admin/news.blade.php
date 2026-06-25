<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление новостями | Админ-панель</title>
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
    @if(session('success'))
        <div class="admin-alert">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #e74c3c;">Управление новостями</h2>
            <a href="{{ route('admin.news.create') }}" class="admin-btn">+ Добавить новость</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Дата</th>
                    <th>Тип</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                    <td>
                        @if($item->is_paid)
                            <span style="background: #c0392b; padding: 3px 10px; border-radius: 20px; font-size: 11px;">🔒 Платная</span>
                        @else
                            <span style="background: #27ae60; padding: 3px 10px; border-radius: 20px; font-size: 11px;">📰 Бесплатная</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.news.edit', $item->id) }}" class="admin-btn admin-btn-sm">✏️</a>
                        <a href="{{ route('admin.news.delete', $item->id) }}" class="admin-btn admin-btn-sm admin-btn-red" onclick="return confirm('Удалить новость?')">🗑️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-center gap-4 mt-8">
    @if ($news->onFirstPage())
        <span class="px-4 py-2 bg-gray-700 text-gray-500 rounded-lg cursor-not-allowed">← Назад</span>
    @else
        <a href="{{ $news->previousPageUrl() }}" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-purple-600 transition">← Назад</a>
    @endif

    <span class="px-4 py-2 bg-gray-800 text-gray-400 rounded-lg">
        Страница {{ $news->currentPage() }} из {{ $news->lastPage() }}
    </span>

    @if ($news->hasMorePages())
        <a href="{{ $news->nextPageUrl() }}" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-purple-600 transition">Вперёд →</a>
    @else
        <span class="px-4 py-2 bg-gray-700 text-gray-500 rounded-lg cursor-not-allowed">Вперёд →</span>
    @endif
</div>
    </div>
</div>
</body>
</html>