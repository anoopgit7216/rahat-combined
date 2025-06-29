<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
           $roleName = Auth::user()->role->name ?? null;

            if (!$roleName) {
                abort(403, 'Role not assigned or does not exist.');
            }

            return match ($roleName) {
                'Admin' => redirect()->route('admin.dashboard'),
                'Lekhpal' => redirect()->route('lekhpal.dashboard'),
                'Tahsildar' => redirect()->route('tahsildar.dashboard'),
                'Naib Tahsildar' => redirect()->route('ntahsildar.dashboard'),
                'Revenue Inspector' => redirect()->route('rinspactor.dashboard'),
                'Sub Divisional Magistrate' => redirect()->route('smagistrate.dashboard'),
                'Additional District Magistrate' => redirect()->route('dmagistrate.dashboard'),
                default => abort(403, 'Unauthorized Role'),
            };
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
