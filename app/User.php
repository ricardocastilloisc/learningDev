<?php

namespace App;

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
