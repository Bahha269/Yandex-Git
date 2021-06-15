<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class HomeController extends Controller
{
    public function index(Request $request) {
        $posts = Post::latest();
        $q = $request->q;
        if($q) $posts = $posts->where('name', 'like', "%$q%")->orWhere('text', 'like', "%$q%");
        $posts = $posts->paginate(5);
        return view('home', compact('posts', 'q'));
    }
}
