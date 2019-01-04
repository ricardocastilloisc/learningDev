<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //esto  lo que hace es seleccionar que es lo que vamos a insertar ose los cmpos que vamos a manipular
    //deben de estar todos los datos que necestiamos
    protected $fillable = ['user_id', 'title'];

    public function courses()
    {
        //un estudiante esta en varios cursos
        //o pertence a varios cursos
        //simplemente esta en algunos cursos
        //esto es union muchos a muchos
        //tiene sentido porque
        //un curso tiene varios estudiantes o tiene mas de un estudiante
        //y un estidoante pude tener varios cursos o tene mas de un courso
        //o estar mas de un curso
        return $this->belongsToMany(Course::class);
    }

    public function user()
    {
        //un estudiante pertenece o es un usuario
        return $this->belongsTo(User::class)->select('id', 'role_id', 'name', 'email');
    }

    //
}
