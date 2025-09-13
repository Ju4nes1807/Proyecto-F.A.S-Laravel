<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JugadorController extends Controller
{
    public function index()
    {
        return view('jugador.principal');
    }

    public function mostrarPerfil()
    {
        // Obtiene la información del usuario autenticado
        $user = Auth::user();

        // Pasa los datos del usuario a la vista
        $user = Auth::user()->load('asignaciones.categoria');
        return view('jugador.perfil', compact('user'));
    }
}
