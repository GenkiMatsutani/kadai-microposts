<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    
    // public function favorites()
    // {
    //     return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')
    //         ->withTimestamps();
    // }
    
    // public function favoriteCount()
    // {
    //     return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')
    //         ->selectRaw('count(*) as aggregate')
    //         ->withTimestamps()
    //         ->groupBy('micropost_id');
    // }
    
    public function user()
    {
        return $this->belongTo(User::class);
    }
    
    public function microposts()
    {
        return $this->belongTo(Micropost::class);
    }
}
