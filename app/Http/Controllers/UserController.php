<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Email;
use Inertia\Inertia;
use Log;

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
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password'=> bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        // This will automatically return JSON for Inertia requests
        throw $e;
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
    }
}
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return Inertia('User/Create', [
            'editUser' => $user,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:user,email,' . $id],
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
         $user->delete();
        Log::info("User deleted: " . $user->id);
        }
        
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}