<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/User', [
            'user' => User::all(),
        ]);
    }

    public function create(){
        return Inertia::render('User/Create', [
            'user' => User::all(),
        ]);
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:user',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,user',
    ]);

    try {
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);
        
        \Log::info('User created successfully:', $user->toArray());
        return redirect()->route('user.index')->with('success', 'User created successfully.');
        
    } catch (\Exception $e) {
        \Log::error('Error creating user: ' . $e->getMessage());
        return back()->with('error', 'Error creating user: ' . $e->getMessage());
    }
}
    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email,' . $id,
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}