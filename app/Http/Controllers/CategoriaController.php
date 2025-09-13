<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Asignacion;
use App\Models\Escuela;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $categorias = collect();
        $escuela = null;
        $asignacion = null;

        if ($user->fk_role_id == 1) { // Admin
            // Categorías asignadas a las escuelas que creó el admin
            $categorias = Categoria::whereHas('escuelas', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('escuelas')->get();

            $escuelas = Escuela::where('user_id', $user->id)->get();

            return view('admin.categorias', compact('user', 'categorias', 'escuelas'));

        } elseif ($user->fk_role_id == 2) { // Entrenador
            $escuela = Escuela::whereHas('asignaciones', function ($q) use ($user) {
                $q->where('user_id', $user->id)->where('tipo', 'entrenador');
            })->first();

            $categorias = $escuela ? $escuela->categorias : collect();
            return view('entrenador.categorias.index', compact('user', 'escuela', 'categorias'));

        } elseif ($user->fk_role_id == 3) { // Jugador
            $asignacion = \App\Models\Asignacion::where('user_id', $user->id)
                ->where('tipo', 'jugador')
                ->with('categoria', 'escuela')
                ->first();

            $categorias = $asignacion ? collect([$asignacion->categoria]) : collect();
            return view('jugador.categorias.index', compact('user', 'asignacion', 'categorias'));
        }

        abort(403, 'Rol no permitido');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->fk_role_id != 1)
            abort(403, 'Acceso no autorizado');

        // Escuelas del admin
        $escuelas = Escuela::where('user_id', $user->id)->get();

        return view('admin.inscripcionCategoria', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->fk_role_id != 1)
            abort(403, 'Acceso no autorizado');

        $request->validate([
            'nombre' => 'required|string|max:255',
            'escuelas' => 'required|array',
            'escuelas.*' => 'exists:escuelas,id',
        ]);

        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'created_by' => auth()->id(),
        ]);

        // Asignar a las escuelas seleccionadas
        $categoria->escuelas()->attach($request->escuelas);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada y asignada a las escuelas correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        $user = Auth::user();
        if ($user->fk_role_id != 1)
            abort(403, 'Acceso no autorizado');

        // Escuelas del admin
        $escuelas = Escuela::where('user_id', $user->id)->get();

        return view('admin.categorias.edit', compact('categoria', 'escuelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $user = Auth::user();
        if ($user->fk_role_id != 1)
            abort(403, 'Acceso no autorizado');

        $request->validate([
            'nombre' => 'required|string|max:255',
            'escuelas' => 'required|array',
            'escuelas.*' => 'exists:escuelas,id',
        ]);

        $categoria->update(['nombre' => $request->nombre]);

        // Sincronizar escuelas
        $categoria->escuelas()->sync($request->escuelas);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $user = Auth::user();
        if ($user->fk_role_id != 1)
            abort(403, 'Acceso no autorizado');

        $categoria->escuelas()->detach();
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }

    public function asignarUsuario(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        // Obtener la asignación de escuela del jugador
        $asignacion = $user->asignaciones()->first();

        if (!$asignacion) {
            return back()->with('error', 'El jugador debe estar asignado a una escuela antes de asignarle una categoría.');
        }

        // Verificar que el admin actual es el que hizo la asignación
        if ($asignacion->assigned_by !== auth()->id()) {
            return back()->with('error', 'No puedes asignar categoría a un jugador asignado por otro admin.');
        }

        // Validar categoría
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Guardar categoría en la asignación
        $asignacion->categoria_id = $request->categoria_id;
        $asignacion->save();

        return back()->with('success', 'Categoría asignada correctamente.');
    }

    public function eliminarCategoria($id)
    {
        $asignacion = \App\Models\Asignacion::findOrFail($id);

        // Validar que el admin logueado es quien asignó
        if ($asignacion->assigned_by !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar esta asignación.');
        }

        $asignacion->categoria_id = null;
        $asignacion->save();

        return back()->with('success', 'Categoría desasignada correctamente.');
    }
}
