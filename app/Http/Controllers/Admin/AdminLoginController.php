<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if ($request->user()->role === 'user') {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Login untuk user tidak diizinkan di halaman ini.',
            ]);
        }

        session()->flash('success', "Berhasil masuk aplikasi");
        return redirect()->intended(RouteServiceProvider::ADMIN);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->flash('success', "Berhasil keluar aplikasi");
        return redirect()->route('admin.login');
    }
}
