<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'nombreUsuario' => ['required'],
            'password' => ['required'],
        ], [
            'nombreUsuario.required' => 'El nombre de usuario es requerido',
            'password.required' => 'La contraseña es requerida'
        ]);

        if (Auth::attempt($credenciales)) {

            if (Auth::User()->rolUsuario == 2) {
                return  redirect()->route('welcomeAdmin');
            } else {
                return  redirect()->route('welcome');
            }

            $this->redirectPath($request->usuario);
        }
        return redirect()->route('login')->withErrors([
            'nombreUsuario' => 'El usuario no está registrado',
        ])->onlyInput('nombreUsuario');
    }
}
