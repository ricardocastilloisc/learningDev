<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function courses()
    {
        /// un maestro tiene varios o tiene mas de un curso
        /// estas relaciones deben tener en cuenta
        /// con el diagrama de modelo de base de datos que usamos
        return $this->hasMany(Course::class);
    }

    public function user()
    {
        //un maestro pertenece o esta en la tabla de usuarios
        return $this->belongsTo(User::class);
    }
    //
}
