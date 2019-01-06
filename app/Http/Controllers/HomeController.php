<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //almacenmos todos lo que necesitamos en un variable curso
        //esto lo que hace es que cuenta cuantos estudiantes
        //cuantos cursos se ve todos los datos con dd
        //with lo que hace es un relacion
        //de lo valores qu necesitamos
        //latest es ordenar
        $courses = Course::withCount(['students'])
            ->with('category', 'teacher', 'reviews')
            ->where('status', Course::PUBLISHED)
            ->latest()
            ->paginate(12);
        dd($courses);
        return view('home');
    }
}
