<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entrenamiento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrenamientoController extends Controller
{
    // Listar entrenamientos
    public function index()
    {
        $entrenamientos = Entrenamiento::with('categoria')->get();
        return view('entrenador.entrenamientos.index', compact('entrenamientos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $categorias = Categoria::all();
        return view('entrenador.entrenamientos.create', compact('categorias'));
    }

    // Guardar un entrenamiento
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'cancha' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $data['user_id'] = Auth::id();

        Entrenamiento::create($data);

        return redirect()->route('entrenador.entrenamientos.index')
            ->with('success', 'Entrenamiento creado correctamente.');
    }

    // Ver detalles de un entrenamiento
    public function show(Entrenamiento $entrenamiento)
    {
        return view('entrenador.entrenamientos.show', compact('entrenamiento'));
    }

    // Mostrar formulario de edición
    public function edit(Entrenamiento $entrenamiento)
    {
        $categorias = Categoria::all();
        return view('entrenador.entrenamientos.edit', compact('entrenamiento', 'categorias'));
    }

    // Actualizar un entrenamiento
    public function update(Request $request, Entrenamiento $entrenamiento)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'cancha' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $entrenamiento->update($data);

        return redirect()->route('entrenador.entrenamientos.index')
            ->with('success', 'Entrenamiento actualizado.');
    }

    // Eliminar un entrenamiento
    public function destroy(Entrenamiento $entrenamiento)
    {
        $entrenamiento->delete();

        return redirect()->route('entrenador.entrenamientos.index')
            ->with('success', 'Entrenamiento eliminado.');
    }
    public function indexJugador()
{
    // Aquí cargas los entrenamientos, pero solo en modo "lectura"
    $entrenamientos = Entrenamiento::all();

    return view('jugador.entrenamientos.index', compact('entrenamientos'));
}

}
