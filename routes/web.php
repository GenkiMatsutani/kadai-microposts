<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController; // 8で追記
use App\Http\Controllers\MicropostsController; //9で追記 

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

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {                                    // 8追記
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);     // 8追記
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);   // 9で追記
});        