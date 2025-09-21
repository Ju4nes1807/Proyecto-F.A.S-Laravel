<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrenamientoController extends Controller
{
    // ================== VISTAS POR ROL ==================

    // Admin
    public function adminIndex()
    {
        $entrenamientos = Entrenamiento::with('categoria')->get();
        return view('admin.entrenamientos.index', compact('entrenamientos'));
    }

    // Entrenador
    public function index()
    {
        $entrenamientos = Entrenamiento::with('categoria')
            ->where(function ($query) {
                $query->where('user_id', Auth::id()) // entrenamientos propios
                      ->orWhereHas('usuario', function ($q) { // entrenamientos creados por admin
                          $q->where('fk_role_id', 1);
                      });
            })
            ->get();

        return view('entrenador.entrenamientos.index', compact('entrenamientos'));
    }

    // Jugador
    public function indexJugador()
    {
        $entrenamientos = Entrenamiento::with('categoria')->get();
        return view('jugador.entrenamientos.index', compact('entrenamientos'));
    }

    // ================== CRUD ==================

    public function create()
    {
        $categorias = Categoria::all();

        if (Auth::user()->fk_role_id == 1) { // admin
            return view('admin.entrenamientos.create', compact('categorias'));
        }

        return view('entrenador.entrenamientos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'cancha' => 'nullable|string|max:255',
        ]);

        $data['user_id'] = Auth::id();
        Entrenamiento::create($data);

        // Redirigir según rol
        if (Auth::user()->fk_role_id == 1) {
            return redirect()->route('admin.entrenamientos.index')
                ->with('success', 'Entrenamiento creado correctamente.');
        }

        return redirect()->route('entrenador.entrenamientos.index')
            ->with('success', 'Entrenamiento creado correctamente.');
    }

    public function edit(Entrenamiento $entrenamiento)
    {
        $categorias = Categoria::all();

        if (Auth::user()->fk_role_id == 1) {
            return view('admin.entrenamientos.edit', compact('entrenamiento', 'categorias'));
        }

        return view('entrenador.entrenamientos.edit', compact('entrenamiento', 'categorias'));
    }

    public function update(Request $request, Entrenamiento $entrenamiento)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'cancha' => 'nullable|string|max:255',
        ]);

        $entrenamiento->update($data);

        if (Auth::user()->fk_role_id == 1) {
            return redirect()->route('admin.entrenamientos.index')
                ->with('success', 'Entrenamiento actualizado.');
        }

        return redirect()->route('entrenador.entrenamientos.index')
            ->with('success', 'Entrenamiento actualizado.');
    }

    public function destroy(Entrenamiento $entrenamiento)
    {
        $entrenamiento->delete();

        if (Auth::user()->fk_role_id == 1) {
            return redirect()->route('admin.entrenamientos.index')
                ->with('success', 'Entrenamiento eliminado.');
        }

        return redirect()->route('entrenador.entrenamientos.index')
            ->with('success', 'Entrenamiento eliminado.');
    }
}

