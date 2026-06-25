<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($post) ? 'Редактировать' : 'Добавить' }} новость | Админ-панель</title>
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
        <h2 style="color: #e74c3c; margin-bottom: 20px;">{{ isset($post) ? 'Редактировать' : 'Добавить' }} новость</h2>

        <form method="POST" action="{{ isset($post) ? route('admin.news.update', $post->id) : route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form-group">
                <label>Заголовок</label>
                <input type="text" name="title" value="{{ isset($post) ? $post->title : '' }}" required>
            </div>

            <div class="admin-form-group">
                <label>Текст</label>
                <textarea name="text" required>{{ isset($post) ? $post->text : '' }}</textarea>
            </div>

            <div class="admin-form-group">
                <label>Изображение</label>
                @if(isset($post) && $post->media)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $post->media->filename) }}" style="max-width: 150px; border-radius: 5px;">
                        <label style="display: block; margin-top: 5px;">
                            <input type="checkbox" name="delete_image" value="1"> Удалить текущее изображение
                        </label>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*">
                <small style="color: #888;">JPG, PNG, GIF, WEBP. Максимум 5МБ.</small>
            </div>

            <div class="admin-form-group admin-checkbox">
                <input type="checkbox" name="is_paid" id="is_paid" value="1" {{ isset($post) && $post->is_paid ? 'checked' : '' }}>
                <label for="is_paid" style="margin: 0;">🔒 Платная новость (только для подписчиков)</label>
            </div>

            <button type="submit" class="admin-btn">Сохранить</button>
            <a href="{{ route('admin.news') }}" style="color: #888; margin-left: 15px;">Отмена</a>
        </form>
    </div>
</div>
</body>
</html>