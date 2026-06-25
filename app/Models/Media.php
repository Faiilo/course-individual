<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['filename', 'file_type', 'description'];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}