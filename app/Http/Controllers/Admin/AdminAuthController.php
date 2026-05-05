<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Link;
use App\Models\Manfaat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->username, 'password' => $request->password, 'role' => 'admin'])) {

            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        return view('admin.dashboard');
    }

    public function konten()
    {
        $faqs = Faq::latest()->get();
        $links = Link::latest()->get();
        $manfaats = Manfaat::latest()->get();

        return view('admin.konten.index', compact('faqs', 'links', 'manfaats'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
