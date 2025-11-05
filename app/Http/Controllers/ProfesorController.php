<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\ProfesorAsignado;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    //
    public function alumnos() {
        $profesor = auth()->user()->profesor;

        if (!$profesor) {
            abort(403, 'No tienes un perfil de profesor asignado');
        }

        $alumnos = $profesor->alumnos()
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->orderBy('nombres')
            ->get();

        return view('profesor.alumnos', compact('alumnos', 'profesor'));
    }
}
