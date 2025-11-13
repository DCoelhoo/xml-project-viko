<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }
    
    public function about()
    {
        return view('about');
    }

    // ================================
    // ADMIN LOGIN FORM
    // ================================
    public function login()
    {
        return view('admin.login');
    }

    // ================================
    // AUTHENTICATE ADMIN
    // ================================
    public function authenticate(Request $request)
    {
        $username = "admin";
        $password = "password123"; // <- Change later

        if ($request->username === $username && $request->password === $password) {
            session(['admin' => true]);
            return redirect('/admin');
        }

        return redirect('/admin/login')->with('error', 'Invalid credentials.');
    }

    // ================================
    // LOGOUT ADMIN
    // ================================
    public function logout()
    {
        session()->forget('admin');
        return redirect('/admin/login');
    }
}
