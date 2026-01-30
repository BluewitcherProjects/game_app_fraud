<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = [
        'user_id',
        'content',
        'image',
        'status'
    ];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
}