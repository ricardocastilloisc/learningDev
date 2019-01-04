<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocialAccount extends Model
{
    //lo que hace es  ver o seleccionar lo que vamos a manpular}
    //esto es requerido para poder insertar o modificar
    protected $fillable = ['user_id', 'provider', 'provider_uid'];
//obviamente nos fata pero para valir lo que nosotros no quermos
//en este caso el timestamp pues solo es poner false
    public $timestamps = false;

    //relacion con la tabla user
    public function user () {
        //pertnecer a a tanña de user
        return $this->belongsTo(User::class);
    }
    //
}
