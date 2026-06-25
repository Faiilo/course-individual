<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ArchiveController extends Controller
{
    // Сервер 1
    public function server1()
    {
        $posts = Post::where('post_type', 'editorial')
            ->where('server', '01')
            ->whereNotNull('media_id')
            ->with('media')
            ->orderBy('sort_order', 'asc')
            ->get();
        
        $latest = $posts->first();
        $archives = $posts->skip(1);
        
        return view('archive.server1', compact('latest', 'archives'));
    }
    
    // Серверы 2-4
    public function servers234()
    {
        $posts = Post::where('post_type', 'editorial')
            ->whereIn('server', ['02', '03', '04'])
            ->whereNotNull('media_id')
            ->with('media')
            ->orderBy('sort_order', 'asc')
            ->get();
        
        $latest = $posts->first();
        $archives = $posts->skip(1);
        
        return view('archive.servers234', compact('latest', 'archives'));
    }

    public function server01()
{
    return $this->server1();
}
}