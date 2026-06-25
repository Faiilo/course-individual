<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($post) ? 'Редактировать' : 'Добавить' }} редакцию | Админ-панель</title>
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
    <div class="admin-card">
        <h2 style="color: #e74c3c; margin-bottom: 20px;">{{ isset($post) ? 'Редактировать' : 'Добавить' }} редакцию</h2>

        <form method="POST" action="{{ isset($post) ? route('admin.editorials.update', $post->id) : route('admin.editorials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form-group">
                <label>Название редакции</label>
                <input type="text" name="title" value="{{ isset($post) ? $post->title : '' }}" required>
            </div>

            <div class="admin-form-group">
                <label>Раздел архива</label>
                <select name="server" required>
                    <option value="01" {{ isset($post) && $post->server == '01' ? 'selected' : '' }}>Сервер 1</option>
                    <option value="02" {{ isset($post) && in_array($post->server, ['02', '03', '04']) ? 'selected' : '' }}>Серверы 2-4</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label>Изображение</label>
                @if(isset($post) && $post->media)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $post->media->filename) }}" style="max-width: 150px; border-radius: 5px;">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" {{ isset($post) ? '' : 'required' }}>
                <small style="color: #888;">JPG, PNG, GIF, WEBP. Максимум 5МБ.</small>
            </div>

            <button type="submit" class="admin-btn">Сохранить</button>
            <a href="{{ route('admin.editorials.server1') }}" style="color: #888; margin-left: 15px;">Отмена</a>
        </form>
    </div>
</div>
</body>
</html>