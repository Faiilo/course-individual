<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
   public function index()
{
    // Получаем все новости, фильтруем доступные
    $allNews = Post::where('post_type', 'news')
        ->latest()
        ->get()
        ->filter(fn($post) => $post->isAccessible());
    
    $latestNews = $allNews->take(3);
    
    $history = [
        ['year' => 2021, 'event' => 'Основание агентства "Фокус"'],
        ['year' => 2022, 'event' => 'Запуск первой онлайн-платформы'],
        ['year' => 2023, 'event' => 'Премия "Лучшее агентство года"'],
    ];

    return view('home', compact('latestNews', 'history'));
}
}