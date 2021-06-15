<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin'])->except(['show', 'comment']);
        $this->middleware('auth')->only('comment');
    }
    public function create(){
        return view('posts.create');
    }
    public function edit(Post $post){
        return view('posts.update', compact('post'));
    }
    public function show(Post $post){
        $post->load('comments');
        return view('posts.show', compact('post'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required'
        ]);
        Post::create($request->only([
            'name',
            'text'
        ]));
        session()->flash('message', 'Новая запись успешно добавлена');
        return redirect()->route('home');
    }
    public function update(Request $request, Post $post){
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required'
        ]);
        $post->update($request->only([
            'name',
            'text'
        ]));
        session()->flash('message', 'Запись успешно изменена');
        return redirect()->route('home');
    }
    public function destroy(Post $post){
        $post->delete();
        session()->flash('message', 'Запись успешно удалена');
        return redirect()->route('home');
    }
    public function comment(Request $request, Post $post){
        $request->validate([
            'text' => 'required'
        ]);
        $data = $request->only('text');
        $data['user_id'] = auth()->id();
        $post->comments()->create($data);
        return back();
    }
}
