<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    public function courses()
    {
        //un nivel tiene varias cursos o esta en varios cursos
        return $this->hasMany(Course::class);
    }
    //
}
