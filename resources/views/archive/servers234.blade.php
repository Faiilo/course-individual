<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Архив редакций | Сервер 1 | Агентство "Фокус"</title>
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
            <a href="/archive/server1" class="active">Архив редакций</a>
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

    <div class="archive-tabs">
    <a href="{{ route('archive.server1') }}">Сервер 01</a>
    <a href="{{ route('archive.servers234') }}" class="active">Серверы 02, 03, 04</a>
</div>

    @if($latest && $latest->media)
    <div class="featured-section">
        <h2 class="featured-title">Актуальная редакция</h2>
        <img src="{{ asset('storage/' . $latest->media->filename) }}" class="featured-image" onclick="openModal(0)">
    </div>
    @endif

    @if($archives && $archives->count() > 0)
    <div class="gallery-section">
        <h2 class="gallery-title">Архив редакций</h2>
        <div class="gallery-grid">
            @foreach($archives as $index => $item)
                @if($item->media)
                <div class="gallery-item" onclick="openModal({{ $index + 1 }})">
                    <img src="{{ asset('storage/' . $item->media->filename) }}" class="gallery-image">
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @else
        <div class="empty-state">Архив редакций пуст</div>
    @endif

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

<div id="imageModal" class="modal" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <button class="modal-nav modal-prev" onclick="prevImage(event)">‹</button>
        <button class="modal-nav modal-next" onclick="nextImage(event)">›</button>
        <img id="modalImage" src="">
        <div id="modalCounter" class="modal-counter"></div>
    </div>
</div>

<script>
    let galleryImages = [];
    @if($latest && $latest->media)
        galleryImages.push("{{ asset('storage/' . $latest->media->filename) }}");
    @endif
    @foreach($archives as $item)
        @if($item->media)
            galleryImages.push("{{ asset('storage/' . $item->media->filename) }}");
        @endif
    @endforeach
    let currentIndex = 0;
    function openModal(index) { currentIndex = index; updateModal(); document.getElementById('imageModal').classList.add('active'); document.body.style.overflow = 'hidden'; }
    function updateModal() { document.getElementById('modalImage').src = galleryImages[currentIndex]; document.getElementById('modalCounter').innerText = (currentIndex + 1) + ' / ' + galleryImages.length; }
    function nextImage(e) { e.stopPropagation(); if (currentIndex < galleryImages.length - 1) { currentIndex++; updateModal(); } }
    function prevImage(e) { e.stopPropagation(); if (currentIndex > 0) { currentIndex--; updateModal(); } }
    function closeModal() { document.getElementById('imageModal').classList.remove('active'); document.body.style.overflow = 'auto'; }
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('imageModal').classList.contains('active')) {
            if (e.key === 'Escape') closeModal();
            else if (e.key === 'ArrowLeft') prevImage(e);
            else if (e.key === 'ArrowRight') nextImage(e);
        }
    });
</script>
</body>
</html>