<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function edit(){
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }
    public function update(Request $request){
        $user = auth()->user();
        $request->validate([
            'password' => 'required|confirmed|string|max:255|min:6'
        ]);
        $password = bcrypt($request->password);
        $user->update([
            'password' => $password
        ]);
        session()->flash('message', 'Пароль успешно изменен');
        return redirect()->route('users.edit');
    }
}
