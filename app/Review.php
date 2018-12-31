<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //union o relaciones en modelos
    public function course()
    {
        //un revisado esta en un curso o pertence a un curso
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        //un revisado viene de un usuario o pertence a un usuario
        return $this->belongsTo(User::class);
    }

    //
}
