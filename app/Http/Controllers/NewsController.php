<?php

namespace App\Http\Controllers;

use App\Models\Post;

class NewsController extends Controller
{
   public function index()
{
    $news = Post::where('post_type', 'news')->latest()->get();
    return view('news.index', compact('news'));
}
    
    public function show($id)
{
    $post = Post::where('post_type', 'news')->findOrFail($id);
    
    // Не делаем редирект, просто показываем пост
    // В шаблоне уже есть логика блюра для не-подписчиков
    
    return view('news.show', compact('post'));
}
}