<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    protected $fillable = ['title', 'text', 'media_id', 'post_type', 'server', 'is_paid', 'created_at'];
    
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    
    public function isAccessible()
    {
        if (!$this->is_paid) {
            return true;
        }
        
        if (!auth()->check()) {
            return false;
        }
        
        $user = auth()->user();
        
        if (!$user->id_subscription) {
            return false;
        }
        
        $subscription = \App\Models\Subscription::find($user->id_subscription);
        
        return $subscription && $subscription->status === 'Активна';
    }
    
    public function delete()
    {
        if ($this->media_id) {
            $media = Media::find($this->media_id);
            if ($media) {
                $filePath = storage_path('app/public/' . $media->filename);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $media->delete();
            }
        }
        
        return parent::delete();
    }
}