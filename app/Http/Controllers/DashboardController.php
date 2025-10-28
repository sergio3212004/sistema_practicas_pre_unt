<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $rol = $user->rol->rol ?? null;

        $vistas = [
            'alumno' => 'dashboard.alumno',
            'profesor' => 'dashboard.profesor',
            'empresa' => 'dashboard.empresa',
            'director' => 'dashboard.director'
        ];

        $vista = $vistas[$rol] ?? null;
        return view($vista, compact('user'));
    }
}
