<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Backend\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/", [PageController::class, 'posts']);
Route::get('blog/{post}', [PageController::class, 'post'])->name('post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)
    ->middleware('auth')
    ->except('show');