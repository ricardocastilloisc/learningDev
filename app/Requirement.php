<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    public function course()
    {
        //un requirement pertenece o esta en un curso
        return $this->belongsTo(Course::class);
    }

    //
}
