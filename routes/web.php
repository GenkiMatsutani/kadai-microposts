<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController; // 8その他のユーザー機能で追記
use App\Http\Controllers\MicropostsController; //9投稿機能で追記 
use App\Http\Controllers\UserFollowController; // 11フォロー機能で追記
use App\Http\Controllers\FavoritesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {                                    // 8追記
    Route::group(['prefix' => 'users/{id}'], function () {                                          // 追記
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');         // 追記
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow'); // 追記
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings'); // 追記
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');    // 追記
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');    // 追加
    });                                                                                             // 追記
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);     // 8追記
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);   // 9で追記
    
    Route::group(['prefix' => 'microposts/{id}'], function () {                                              // 追加
        Route::post('favorite', [FavoritesController::class, 'store'])->name('favorites.favorite');        // 追加
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite'); // 追加
    });                                                                                                     // 追加
    
        // Route::post('/users/{user}/favorite/{micropost}', 'UsersController@favorite')->name('users.favorite');
});
    
    // Route::get('/users/{id}', 'UsersController@show');
    
    // // お気に入り機能
    // Route::get('users/{user}/favorite/{post}', [FavoritesController::class, 'favorite'])->name('favorite');
    // Route::get('users/{user}/unfavorite/{post}', [FavoritesController::class, 'unfavorite'])->name('unfavorite');
    // Route::get('users/{user}/favorite/{post}', [FavoritesController::class, 'favorite'])->name('favorite');
    // Route::get('users/{user}/unfavorite/{post}', [FavoritesController::class, 'unfavorite'])->name('unfavorite');
    

