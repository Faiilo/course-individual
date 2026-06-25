<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Media;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'news_count' => Post::where('post_type', 'news')->count(),
            'editorial_count' => Post::where('post_type', 'editorial')->count(),
            'users_count' => User::count(),
            'subscribers_count' => User::whereNotNull('id_subscription')->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
    
    // НОВОСТИ
    public function news()
    {
        $news = Post::where('post_type', 'news')->latest()->paginate(10);
        return view('admin.news', compact('news'));
    }
    
    public function newsCreate()
    {
        return view('admin.news_form');
    }
    
    public function newsStore(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'text' => 'required|string',
        'is_paid' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);
    
    $mediaId = null;
    
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Сохраняем MIME-тип ДО перемещения
        $mimeType = $file->getMimeType();
        
        // Перемещаем файл
        $file->move(storage_path('app/public/news'), $filename);
        
        // Проверяем, что файл сохранился
        if (file_exists(storage_path('app/public/news/' . $filename))) {
            $media = Media::create([
                'filename' => 'news/' . $filename,
                'file_type' => $mimeType,
                'description' => $request->title,
            ]);
            $mediaId = $media->id;
        } else {
            return back()->with('error', 'Не удалось сохранить изображение');
        }
    }
    
    $post = Post::create([
        'title' => $request->title,
        'text' => $request->text,
        'media_id' => $mediaId,
        'post_type' => 'news',
        'is_paid' => $request->has('is_paid'),
        'created_at' => now(),
    ]);
    
    return redirect()->route('admin.news')->with('success', 'Новость добавлена');
}
    
    public function newsEdit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.news_form', compact('post'));
    }
    
    public function newsUpdate(Request $request, $id)
{
    $post = Post::findOrFail($id);
    
    $request->validate([
        'title' => 'required|string|max:255',
        'text' => 'required|string',
        'is_paid' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);
    
    // Удаление старого изображения
    if ($request->has('delete_image') && $post->media_id) {
        $oldMedia = Media::find($post->media_id);
        if ($oldMedia) {
            $oldPath = storage_path('app/public/' . $oldMedia->filename);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            $oldMedia->delete();
        }
        $post->media_id = null;
    }
    
    // Загрузка нового изображения
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Сохраняем MIME-тип ДО перемещения
        $mimeType = $file->getMimeType();
        
        // Удаляем старое, если было
        if ($post->media_id) {
            $oldMedia = Media::find($post->media_id);
            if ($oldMedia) {
                $oldPath = storage_path('app/public/' . $oldMedia->filename);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
                $oldMedia->delete();
            }
        }
        
        // Перемещаем новый файл
        $file->move(storage_path('app/public/news'), $filename);
        
        if (file_exists(storage_path('app/public/news/' . $filename))) {
            $media = Media::create([
                'filename' => 'news/' . $filename,
                'file_type' => $mimeType,
                'description' => $request->title,
            ]);
            $post->media_id = $media->id;
        } else {
            return back()->with('error', 'Не удалось сохранить изображение');
        }
    }
    
    $post->title = $request->title;
    $post->text = $request->text;
    $post->is_paid = $request->has('is_paid');
    $post->save();
    
    return redirect()->route('admin.news')->with('success', 'Новость обновлена');
}
    
    public function newsDelete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return redirect()->route('admin.news')->with('success', 'Новость удалена');
    }
    
    // РЕДАКЦИИ (АРХИВ)
    public function editorials()
    {
        $editorials = Post::where('post_type', 'editorial')
            ->with('media')
            ->latest()
            ->paginate(10);
        
        return view('admin.editorials', compact('editorials'));
    }
    
    // ПОЛЬЗОВАТЕЛИ
    public function users()
    {
        $users = User::with('subscription')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }
    
    public function userToggleSubscription($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id_subscription) {
            // Отключаем подписку
            $user->id_subscription = null;
            $user->save();
            $message = 'Подписка отключена';
        } else {
            // Включаем подписку
            $sub = Subscription::firstOrCreate(['id' => 1], ['status' => 'Активна']);
            $user->id_subscription = $sub->id;
            $user->save();
            $message = 'Подписка включена';
        }
        
        return redirect()->route('admin.users')->with('success', $message);
    }
    
    public function userToggleAdmin($id)
{
    $user = User::findOrFail($id);
    
    // Защита: нельзя снять админку с пользователя ID = 1 (главный админ)
    if ($user->id == 1) {
        return redirect()->route('admin.users')->with('error', '❌ Нельзя снять права администратора с главного администратора (ID=1)');
    }
    
    // Не даём снять админку с самого себя
    if ($user->id == auth()->id()) {
        return redirect()->route('admin.users')->with('error', '❌ Нельзя снять права администратора с самого себя');
    }
    
    $user->is_admin = !$user->is_admin;
    $user->save();
    
    $message = $user->is_admin ? '✅ Права администратора выданы' : '❌ Права администратора сняты';
    
    return redirect()->route('admin.users')->with('success', $message);
}

// Редакции - список для сервера 01
public function editorialsServer1()
{
    $editorials = Post::where('post_type', 'editorial')
        ->where('server', '01')
        ->with('media')
        ->orderBy('sort_order', 'asc')
        ->get();
    
    return view('admin.editorials', compact('editorials'));
}

// Редакции - список для серверов 02, 03, 04
public function editorialsServers234()
{
    $editorials = Post::where('post_type', 'editorial')
        ->whereIn('server', ['02', '03', '04'])
        ->with('media')
        ->orderBy('sort_order', 'asc')
        ->get();
    
    return view('admin.editorials', compact('editorials'));
}

// Форма добавления редакции
public function editorialCreate()
{
    return view('admin.editorial_form');
}

// Сохранение новой редакции
public function editorialStore(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'server' => 'required|in:01,02',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);
    
    // Используем input() вместо прямого обращения
    $server = $request->input('server');
    
    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();
    $mimeType = $file->getMimeType();
    
    $file->move(storage_path('app/public/images'), $filename);
    
    $media = Media::create([
        'filename' => 'images/' . $filename,
        'file_type' => $mimeType,
        'description' => $request->input('title'),
    ]);
    
    $maxSortOrder = Post::where('post_type', 'editorial')
        ->where('server', $server)
        ->max('sort_order');
    
    Post::create([
        'title' => $request->input('title'),
        'text' => null,
        'media_id' => $media->id,
        'post_type' => 'editorial',
        'server' => $server,
        'is_paid' => false,
        'sort_order' => $maxSortOrder + 1,
        'created_at' => now(),
    ]);
    
    if ($server == '01') {
        return redirect()->route('admin.editorials.server1')->with('success', 'Редакция добавлена на Сервер 01');
    } else {
        return redirect()->route('admin.editorials.servers234')->with('success', 'Редакция добавлена на Серверы 02-04');
    }
}

// Форма редактирования редакции
public function editorialEdit($id)
{
    $post = Post::with('media')->findOrFail($id);
    return view('admin.editorial_form', compact('post'));
}

// Обновление редакции
public function editorialUpdate(Request $request, $id)
{
    $post = Post::findOrFail($id);
    
    $request->validate([
        'title' => 'required|string|max:255',
        'server' => 'required|in:01,02,03,04',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);
    
    $post->title = $request->input('title');
    $post->server = $request->input('server');
    
    if ($request->hasFile('image')) {
        if ($post->media_id) {
            $oldMedia = Media::find($post->media_id);
            if ($oldMedia) {
                $oldPath = storage_path('app/public/' . $oldMedia->filename);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
                $oldMedia->delete();
            }
        }
        
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        
        $file->move(storage_path('app/public/images'), $filename);
        
        $media = Media::create([
            'filename' => 'images/' . $filename,
            'file_type' => $mimeType,
            'description' => $request->input('title'),  // ИСПРАВЛЕНО
        ]);
        $post->media_id = $media->id;
    }
    
    $post->save();
    
    if ($post->server == '01') {
        return redirect()->route('admin.editorials.server1')->with('success', 'Редакция обновлена');
    } else {
        return redirect()->route('admin.editorials.servers234')->with('success', 'Редакция обновлена');
    }
}

// Сделать редакцию текущей (поднять вверх)
public function editorialMakeCurrent($id)
{
    $post = Post::findOrFail($id);
    
    // Обновляем sort_order для всех редакций того же сервера
    $posts = Post::where('post_type', 'editorial')
        ->where('server', $post->server)
        ->orderBy('sort_order', 'asc')
        ->get();
    
    $newOrder = 1;
    foreach ($posts as $p) {
        if ($p->id == $id) {
            continue;
        }
        $p->sort_order = ++$newOrder;
        $p->save();
    }
    
    $post->sort_order = 1;
    $post->save();
    
    return redirect()->back()->with('success', 'Редакция теперь первая');
}

// Удаление редакции
public function editorialDelete($id)
{
    $post = Post::findOrFail($id);
    
    if ($post->media_id) {
        $media = Media::find($post->media_id);
        if ($media) {
            $filePath = storage_path('app/public/' . $media->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $media->delete();
        }
    }
    
    $post->delete();
    
    return redirect()->back()->with('success', 'Редакция удалена');
}

// Обновление порядка (для перетаскивания)
public function editorialUpdateOrder(Request $request)
{
    foreach ($request->order as $index => $id) {
        Post::where('id', $id)->update(['sort_order' => $index + 1]);
    }
    
    return response()->json(['success' => true]);
}
}