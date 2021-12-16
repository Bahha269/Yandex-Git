<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get-messages', function () {
    $messages = \App\Models\Message::orderBy("created_at", "DESC")->get();
    
    return response()->json(collect($messages)->toArray());
    
})->middleware(['auth', 'verified'])->name('get-messages');

Route::post('/send', function () {
    $m = new \App\Models\Message();
    $m->user_id = auth()->user()->id;
    $m->user_name = auth()->user()->name;
    $m->message = request()->get("message");
    $m->save();
    return "OK";
})->middleware(['auth', 'verified'])->name('send');

require __DIR__.'/auth.php';
