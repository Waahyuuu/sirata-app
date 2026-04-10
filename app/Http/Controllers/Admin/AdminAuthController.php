<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Link;
use App\Models\Manfaat;

class AdminAuthController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        if ($username == "admin" && $password == "admin123") {

            session([
                'admin_login' => true
            ]);

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function dashboard()
    {

        if (!session('admin_login')) {
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

    public function logout()
    {

        session()->forget('admin_login');

        return redirect('/admin/login');
    }
}
