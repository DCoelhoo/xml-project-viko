<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function howItWorks()
    {
        return view('how-it-works');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'message' => 'required|min:5',
        ]);

        // (Optional) Here you could send email or save to DB

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
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
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Unique attempt key based on IP
        $key = 'login:' . $request->ip();

        // Check if user is rate-limited
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('error', "Too many attempts. Try again in {$seconds} seconds.");
        }

        // Credentials from .env
        $envUser  = env('ADMIN_USERNAME');
        $envHash  = env('ADMIN_PASSWORD_HASH');

        // Verify username and password
        if ($request->username === $envUser && Hash::check($request->password, $envHash)) {

            // Clear login attempts on success
            RateLimiter::clear($key);

            session(['admin' => true, 'last_activity_time' => time()]);

            return redirect('/admin');
        }

        // Login failed → record attempt
        RateLimiter::hit($key, 60); // block for 60 seconds

        return back()->with('error', 'Invalid credentials.');
    }

    // ================================
    // LOGOUT ADMIN
    // ================================
    public function logout(Request $request)
    {
        // Remove sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
