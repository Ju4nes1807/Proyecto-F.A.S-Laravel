<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrenadorController extends Controller
{
    public function index()
    {
        return view('entrenador.principalEntrenador');
    }
}
