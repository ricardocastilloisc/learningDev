<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;

    //union de base de datos

    //tener en cuenta que para las relaciones siempre tienes que tener el modelo
    //adecuado , es como una interface

    //la relacion de base de datos courso con los que señalan las funciones
    public function category ()
    {
        //un curso pertenece a una categoria, selecionas los campos que quieres
        //mostrar
        return $this->belongsTo(Category::class)->select('id','name');
    }

    public function  goals()
    {
        // un curso tiene varias metas
        return $this->hasMany(Goal::class)->select('id','course_id','goal');
    }

    public function level()
    {
        //un curso pertenece a un nivel
        return $this->belongsTo(Level::class)->select('id','name');
    }

    public function reviews()
    {
        //un curso tiene varias reviews
        return $this->hasMany(Review::class)->select('id','user_id','course_id','rating', 'comment', 'created_at');
    }

    public function requirements()
    {
        //un curso tiene varios requirimientos
        return $this->hasMany(Requirement::class)->select('id','course_id', 'requirement');
    }


    public function students()
    {
        //esta parte se entiende o es
        //un curso puede que tenga o que provenga varias
        //estudiantes
        return $this->belongsToMany(Student::class);
    }

    public function teacher ()
    {
        //un curso pertenece a un maestro
        return $this->belongsTo(Teacher::class);
    }

}
