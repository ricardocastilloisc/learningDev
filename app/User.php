<?php

namespace App;

use function GuzzleHttp\Psr7\str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    //por defecnto has todos esta un metodo que arranca automaticamente
    protected static function boot ()
    {
        //lo procesdes hcaer
        parent::boot();
        //hace un crerig para evitar errores
        //es necesario cuando los campos de un formulario o apu no estan
        //en este caso user es el parametro que esta definido en el apu
        static::creating(function(User $user)
        {
            //si es diferente y no hay
            if( ! \App::runningInConsole())
            {
                //entonces donde estara el slug del la tabla
                //le daras estas propuedades
                //con un separador
                $user->slug = str_slug($user->name . " " . $user->last_name, "-");
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //esta parte lo que hace es identificar lo roles que necesitamods
    //osea  la navegacion que tengamos dependera mucho de que role de usuario somos
    //esta parte ya tendremos en general
    public static function  navigation()
    {
        //retorname el role que tenga y de eso puede
        //saber que tipo de navegacion tendremos
        //con codicion
        return auth()->check() ? auth()->user()->role->name : 'guest';
    }

    public function role()
    {
        //un usuario tiene un role o un funcion pre establecida
        //por el cual estara en la tabla de role
        return $this->belongsTo(Role::class);
    }

    public function student()
    {
        //un usuario puede ser un estudiante
        //solo es una relacion uno a uno
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        //un usuario puede ser un maestro
        //relacion uno a uno
        return $this->hasOne(Teacher::class);
    }

    public function socialAccount()
    {
        //relacionar con cuentas de redes sociales
        return $this->hasOne(UserSocialAccount::class);
    }
}
