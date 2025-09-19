<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrenamiento;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

class EntrenamientoController extends Controller
{
    public function index()
    {
        $entrenamientos = Entrenamiento::with('categoria','entrenador')
            ->orderBy('fecha','desc')
            ->paginate(15);

        return view('admin.entrenamientos.index', compact('entrenamientos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        // lista de entrenadores para asignar
        $entrenadores = User::where('fk_role_id', 2)->get();
        return view('admin.entrenamientos.create', compact('categorias','entrenadores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'user_id' => 'required|exists:users,id',
            'lugar' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'nullable|string',
        ]);

        $user = User::find($data['user_id']);
        if (!$user || $user->fk_role_id != 2) {
            return back()->withErrors(['user_id' => 'El usuario seleccionado no es un entrenador.'])->withInput();
        }

        Entrenamiento::create($data);

        return redirect()->route('admin.entrenamientos.index')->with('success', 'Entrenamiento creado correctamente.');
    }

    public function show(Entrenamiento $entrenamiento)
    {
        return view('admin.entrenamientos.show', compact('entrenamiento'));
    }

    public function edit(Entrenamiento $entrenamiento)
    {
        $categorias = Categoria::all();
        $entrenadores = User::where('fk_role_id', 2)->get();
        return view('admin.entrenamientos.edit', compact('entrenamiento','categorias','entrenadores'));
    }

    public function update(Request $request, Entrenamiento $entrenamiento)
    {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'user_id' => 'required|exists:users,id',
            'lugar' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'nullable|string',
        ]);

        $user = User::find($data['user_id']);
        if (!$user || $user->fk_role_id != 2) {
            return back()->withErrors(['user_id' => 'El usuario seleccionado no es un entrenador.'])->withInput();
        }

        $entrenamiento->update($data);
        return redirect()->route('admin.entrenamientos.index')->with('success', 'Entrenamiento actualizado.');
    }

    public function destroy(Entrenamiento $entrenamiento)
    {
        $entrenamiento->delete();
        return redirect()->route('admin.entrenamientos.index')->with('success', 'Entrenamiento eliminado.');
    }
}
