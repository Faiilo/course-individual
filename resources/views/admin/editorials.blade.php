<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление редакциями | Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
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

    <div class="admin-tabs">
        <a href="{{ route('admin.editorials.server1') }}" class="admin-tab {{ request()->routeIs('admin.editorials.server1') ? 'active' : '' }}">📁 Сервер 1</a>
        <a href="{{ route('admin.editorials.servers234') }}" class="admin-tab {{ request()->routeIs('admin.editorials.servers234') ? 'active' : '' }}">📁 Серверы 2-4</a>
    </div>

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #e74c3c;">Управление редакциями</h2>
            <a href="{{ route('admin.editorials.create') }}" class="admin-btn">+ Добавить редакцию</a>
        </div>

        <p style="color: #888; margin-bottom: 15px;">💡 Перетаскивайте строки за значок ⋮⋮ для изменения порядка</p>

        <table class="admin-table" id="sortable-table">
            <thead>
                <tr>
                    <th style="width: 40px"></th>
                    <th>ID</th>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Сервер</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($editorials as $item)
                <tr data-id="{{ $item->id }}">
                    <td class="sort-handle">⋮⋮</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        @if($item->media)
                            <img src="{{ asset('storage/' . $item->media->filename) }}" class="admin-preview-img">
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>
                        @if($item->server == '01')
                            <span style="background: #e74c3c; padding: 3px 10px; border-radius: 20px; font-size: 11px;">Сервер 1</span>
                        @else
                            <span style="background: #2a2a2a; padding: 3px 10px; border-radius: 20px; font-size: 11px;">Сервер {{ $item->server }}</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.editorials.edit', $item->id) }}" class="admin-btn admin-btn-sm">✏️</a>
                        <a href="{{ route('admin.editorials.make-current', $item->id) }}" class="admin-btn admin-btn-sm admin-btn-green" onclick="return confirm('Сделать текущей?')">⭐</a>
                        <a href="{{ route('admin.editorials.delete', $item->id) }}" class="admin-btn admin-btn-sm admin-btn-red" onclick="return confirm('Удалить?')">🗑️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    const tbody = document.querySelector('#sortable-table tbody');
    if (tbody) {
        new Sortable(tbody, {
            animation: 150,
            handle: '.sort-handle',
            onEnd: function() {
                let order = [];
                document.querySelectorAll('#sortable-table tbody tr').forEach((row) => {
                    order.push(row.dataset.id);
                });
                fetch('{{ route("admin.editorials.update-order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                }).then(response => response.json()).then(data => {
                    if (data.success) console.log('Порядок сохранён');
                });
            }
        });
    }
</script>
</body>
</html>