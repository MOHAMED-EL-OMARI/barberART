<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    public function showLogin()
    {
        return view('pages.login');
    }
    public function showRegister()
    {
        return view('pages.register');
    }
    public function register(Request $request)
    {
        // Handle the form data here

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string|in:barber,client',
            'phone' => 'nullable|string|max:15',
        ]);

        // For example, creating a new user:
        $user = User::create($validated);
        Auth::login($user);

        return redirect('/login')->with('success', 'Registration successful!');
    }
    public function login(Request $request)
    {
        // Handle the login form data here 
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Check if the user exists and the password is correct
        if (Auth::attempt($validated)) {
            request()->session()->regenerate();
            return redirect('/')->with('success', 'Login successful!');
        }
        throw ValidationException::withMessages([
            'credentials' => ['The provided credentials are incorrect.'],
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}