<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use App\UserSocialAccount;
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
    public function handleProviderCallback (string $driver) {

        //lo que hace es una validacion y poner si hay error el cual si lo hay haces una variable
        if( ! request()->has('code') || request()->has('denied')) {
            session()->flash('message', ['danger', __("Inicio de sesión cancelado")]);
            //lo redirijes
            return redirect('login');
        }
        // si no hubo una redireccion
        //todos los valor que vamos a tener
        //se cargan en la variable
        //se vuelve un objeto el cual podremos acceder de lo que necesitamos
        //user es el metodo que nos da los valres
        $socialUser = \Socialite::driver($driver)->user();
        //esto va servir para los valores
        $user = null;
        $success = true;
        //de los que agrarrmos de la sesion
        //tomaremso el atriburo emai
        $email = $socialUser->email;
        //checamos si existe en la base de datos
        //y esto tambiem pone todos los valores en la variable
        $check = User::whereEmail($email)->first();
        //si hay valores p
        if($check) {
            //se ponen todo en una varianle
            $user = $check;
        } else {
            //dado que no exista en la base de datos
            //hacemos que haga una transicion o practivamente
            //insericiones
            \DB::beginTransaction();
            try {
                //damos una relacion con la tabla o base de datos que
                //queramos eso significa
                //que estaremos insetando lo que queramos
                //osea tenemos o las que queramos
                $user = User::create([
                    "name" => $socialUser->name,
                    "email" => $email
                ]);
                UserSocialAccount::create([
                    "user_id" => $user->id,
                    "provider" => $driver,
                    "provider_uid" => $socialUser->id
                ]);
                Student::create([
                    "user_id" => $user->id
                ]);
                //valiacion si todos sale mal
            } catch (\Exception $exception) {
                $success = $exception->getMessage();

                //elimalo
                \DB::rollBack();
            }
        }
        //si todos sale bien
        if($success === true) {
            //cre un comentario para afirmar tooos los cambios
            \DB::commit();
            //y si existes lo que nosotros estamos haciendo en la base de datros
            //independientemente si se crea o se inicia nuevamente
            //puedes hacer uns session
            auth()->loginUsingId($user->id);
            //te redirije  inicio
            return redirect(route('home'));
        }

        //dado caso salga mal pues
        session()->flash('message', ['danger', $success]);

        //redirijelo  login
        return redirect('login');
    }
}
