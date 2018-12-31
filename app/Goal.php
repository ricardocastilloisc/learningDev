<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //relacion con los modelos y la base de datos
    public function course ()
    {
        //una meta pertenece a un curso
        return $this->belongsTo(Course::class);
    }
    //
}
