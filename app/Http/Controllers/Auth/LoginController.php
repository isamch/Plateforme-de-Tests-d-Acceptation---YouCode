<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;




class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Welcome Admin!');
            }

            if ($user->hasRole('staff')) {
                return redirect()->intended('/staff/dashboard')->with('success', 'Welcome Staff!');
            }

            if ($user->hasRole('candidat')) {
                return redirect()->intended('/home')->with('success', 'Welcome Candidat!');
            }

        }


        return redirect()->to('/login')->withErrors(['login_error' => 'Login failed!']);
    }



    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout success!');
    }

}
