<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAkunController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->latest()->get();
        return view('admin.akun', compact('admins'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        return back()->with('success', 'Admin berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return back()->with('success', 'Admin berhasil diupdate');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        if ($admin->is_protected) {
            return back()->with('error', 'Akun bawaan sistem tidak bisa dihapus');
        }

        $admin->delete();

        return back()->with('success', 'Admin berhasil dihapus');
    }
}
