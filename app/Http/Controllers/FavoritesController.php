<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Micropost;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Dump;

class FavoritesController extends Controller
{
    public function store($micropostId)
    {
        // 認証済みのユーザー（閲覧者）が、投稿をお気に入りにする
        \Auth::user()->favorite($micropostId);
        
        // 前のページにリダイレクトさせる
        return back();
    }
    
        public function destroy($micropostId)
    {
        // 認証済みのユーザー（閲覧者）が、投稿からお気に入りを外す
        \Auth::user()->unfavorite($micropostId);
        
        // 前のページにリダイレクトさせる
        return back();
    }
    
}
