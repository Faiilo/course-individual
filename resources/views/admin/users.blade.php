<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями | Админ-панель</title>
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
    @if(session('error'))
        <div class="admin-alert admin-alert-error">{{ session('error') }}</div>
    @endif

    <div class="admin-card">
        <h2 style="color: #e74c3c; margin-bottom: 20px;">Управление пользователями</h2>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Подписка</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span style="background: #e74c3c; padding: 3px 10px; border-radius: 20px; font-size: 11px;">👑 Админ</span>
                        @else
                            <span style="background: #2a2a2a; padding: 3px 10px; border-radius: 20px; font-size: 11px;">👤 Пользователь</span>
                        @endif
                    </td>
                    <td>
                        @if($user->id_subscription)
                            <span style="background: #27ae60; padding: 3px 10px; border-radius: 20px; font-size: 11px;">⭐ Подписчик</span>
                        @else
                            <span style="background: #2a2a2a; padding: 3px 10px; border-radius: 20px; font-size: 11px;">❌ Нет</span>
                        @endif
                    </td>
                    <td>
                        @if(!$user->is_admin || $user->id != auth()->id())
                            <a href="{{ route('admin.users.toggle-admin', $user->id) }}" class="admin-btn admin-btn-sm {{ $user->is_admin ? 'admin-btn-yellow' : 'admin-btn-green' }}">
                                {{ $user->is_admin ? 'Снять админа' : 'Назначить админом' }}
                            </a>
                        @endif
                        <a href="{{ route('admin.users.toggle-subscription', $user->id) }}" class="admin-btn admin-btn-sm {{ $user->id_subscription ? 'admin-btn-yellow' : 'admin-btn-green' }}">
                            {{ $user->id_subscription ? 'Отключить подписку' : 'Включить подписку' }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
</div>
</body>
</html>