<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role_id', 'asc')->orderBy('created_at', 'desc')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $user = null;
        return view('user.form', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'sex' => ['required', 'in:Male,Female'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role_id' => ['required', 'in:1,2']
        ]);

        User::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect()->back()->with('msg', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('user.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'sex' => ['required', 'in:Male,Female'],
            'username' => ['required', 'unique:users,username'],
            'role_id' => ['required', 'in:1,2']
        ]);

        $user->update([
            'name' => $request->name,
            'sex' => $request->sex,
            'username' => $request->username,
        ]);

        return redirect()->back()->with('msg', 'User updated successfully');
    }
}
