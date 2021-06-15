<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/posts/{post}/comment', [App\Http\Controllers\PostController::class, 'comment'])->name('posts.comment');
Route::resource('/posts', App\Http\Controllers\PostController::class)->except(['index']);
Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update')->middleware('auth');