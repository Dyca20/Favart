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
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.

    ARIADNE

    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'nombre_Usuario' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credenciales)) {

            $request->session()->regenerate();
            return  redirect()->route('welcome');

/*             $this->redirectPath($request->usuario);
 */        }
        return redirect()->route('login')->withErrors([
            'usuario' => 'Error',
        ])->onlyInput('usuario');
    }

/*     public function redirectPath($usuario)
    {

        $user = User::where('nombre_Usuario', $usuario)->get();

        if (($user->rolUsuario) == 2) {
            return '/admin/panel';
        }
        return  redirect()->route('welcome');
    } */
}
