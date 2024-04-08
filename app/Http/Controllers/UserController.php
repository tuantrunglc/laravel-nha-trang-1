<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách users
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    // Hiển thị form để tạo user mới
    public function create()
    {
        return view('users.create');
    }

    // Lưu user mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $user->save();

        return redirect('/users')->with('success', 'User saved!');
    }

    // Hiển thị form để chỉnh sửa thông tin user
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    // Cập nhật thông tin user trong database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone,'.$id,
            'wallet' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->wallet = $request->get('wallet');
        $user->save();

        return redirect('/users')->with('success', 'User updated!');
    }

    // Xóa user khỏi database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User has been blocked.');
    }
}
