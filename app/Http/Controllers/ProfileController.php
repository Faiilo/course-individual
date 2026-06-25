<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Комментарии пользователя (позже)
        $comments = [];
        
        // Подписка пользователя
        $subscription = $user->subscription;
        $hasSubscription = $user->id_subscription && $subscription && $subscription->status === 'Активна';
        
        return view('profile.index', compact('user', 'comments', 'hasSubscription', 'subscription'));
    }
    
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect()->route('profile.index')->with('success', 'Профиль обновлён');
    }
}