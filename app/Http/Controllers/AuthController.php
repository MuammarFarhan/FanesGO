<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // --- LOGIKA REDIRECT BERDASARKAN ROLE DIMULAI DI SINI ---
            if ($user->role === 'admin') {
                // Admin (Penjual) diarahkan ke dashboard
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali Admin!');
            }
            
            // Pelanggan diarahkan ke halaman beranda (home)
            return redirect()->intended('/')->with('success', 'Login berhasil! Selamat berbelanja.');
            // --- LOGIKA REDIRECT BERDASARKAN ROLE SELESAI DI SINI ---
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.'
        ]);
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register', ['title' => 'Daftar']);
    }

    // Memproses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            // 'role' akan otomatis 'pelanggan' sesuai migrasi
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
