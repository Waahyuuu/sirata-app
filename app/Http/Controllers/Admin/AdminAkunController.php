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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|min:8',
        ], [
            'password.min' => 'Password minimal 8 karakter'
        ]);

        User::create([
            'name' => $request->name,
            'email' => strtolower(trim($request->email)) . '@stimata.ac.id',
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        return back()->with('success', 'Admin berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'nullable|min:8',
        ], [
            'password.min' => 'Password minimal 8 karakter'
        ]);

        $admin = User::findOrFail($id);

        $data = [
            'name' => $request->name,
            'email' => strtolower(trim($request->email)) . '@stimata.ac.id',
        ];

        if ($request->filled('password')) {
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
