<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Link;
use App\Models\Manfaat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = User::where('email', $request->username)
            ->where('role', 'admin')
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            session([
                'admin_login' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name
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
