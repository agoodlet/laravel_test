<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::delete('/', function () {
    return view('welcome');
});

Route::get('/asdf', function () {
    return view('welcome');
});


Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts/create', [PostController::class, 'store']);
Route::delete('posts/{post}', [PostController::class, 'destroy']);

Route::get('/users/', [UserController::class, 'index']);
