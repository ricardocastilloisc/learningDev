<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectToProvider (string $driver)
    {
        return \Socialite::driver($driver)->redirect();
    }
    public function handleProviderCallback(string $driver)
    {

        //validaciones
        //valida si hay codido  que sea de denegacion

        if(! request()->has('code') || request()->has('denied')) {
            //deja un mensaje flash ose variable temporal que podemos usar en blade
            //session es dar entender que solo se crea o usa cuando estamos logiados o
            //vamos a logearnos
            //se crea un objeto o variable con un arreglo
            session()->flash('message',['danger', __("Inicio de sesiónm cancleado")]);
            //retorname un todo en la vista de login
            return redirect('login');
        }
        $socialUser = \Socialite::driver($driver)->user();
        dd($socialUser);
    }
}
