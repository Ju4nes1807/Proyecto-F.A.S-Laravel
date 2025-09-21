<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cancha;
use App\Models\Ubicacion;
class CanchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $ubicaciones = Ubicacion::all();
        $canchas = Cancha::with('escuela', 'admin', 'ubicacion');

        if ($request->filled('nombre')) {
            $canchas->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('tipo')) {
            $canchas->where('tipo', 'like', '%' . $request->tipo . '%');
        }

        if ($request->filled('ubicacion')) {
            // Asume que 'ubicacion' en el request es el ID de la ubicación
            $canchas->where('fk_ubicacion_id', $request->ubicacion);
        }

        $canchas = $canchas->get();

        if ($user->fk_role_id == 1) { // Admin
            return view('admin.canchas', compact('canchas', 'user', 'ubicaciones'));
        } elseif ($user->fk_role_id == 2) { // Entrenador
            return view('canchas.index_entrenador', compact('canchas', 'user', 'ubicaciones'));
        } elseif ($user->fk_role_id == 3) { // Jugador
            return view('canchas.index_jugador', compact('canchas', 'user'));
        }

        abort(403, 'No tienes acceso a esta sección');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->fk_role_id != 1) {
            return redirect()->route('canchas.index')
                ->with('error', 'Solo los administradores pueden registrar canchas.');
        }

        $ubicaciones = Ubicacion::all();

        return view('admin.inscripcionCancha', compact('ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->fk_role_id != 1) {
            return redirect()->route('canchas.index')
                ->with('error', 'No tienes permisos para registrar canchas.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|string|max:255',
            'fk_ubicacion_id' => 'required|exists:ubicacions,id',
        ]);

        $escuela = \App\Models\Escuela::where('user_id', $user->id)->first();
        if (!$escuela) {
            // Puedes redirigir al usuario con un mensaje de error.
            return back()->with('error', 'El administrador no tiene una escuela asignada.');
        }

        Cancha::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'fk_ubicacion_id' => $request->fk_ubicacion_id,
            'fk_escuela_id' => $escuela->id,
            'fk_admin_id' => $user->id,
            'disponible' => $request->has('disponible'),
        ]);

        return redirect()->route('canchas.index')
            ->with('success', 'Cancha registrada correctamente.');
    }

    // En tu controlador (probablemente AdminController o CanchasController)
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        if ($user->fk_role_id != 1) {
            return redirect()->route('canchas.index')
                ->with('error', 'Solo los administradores pueden editar canchas.');
        }

        $cancha = Cancha::with('ubicacion')->findOrFail($id);

        // Seguridad: validar que la cancha le pertenezca al admin
        if ($cancha->fk_admin_id !== $user->id) {
            return redirect()->route('canchas.index')
                ->with('error', 'No tienes permiso para editar esta cancha.');
        }

        $ubicaciones = Ubicacion::all();

        return view('admin.editarCancha', compact('cancha', 'ubicaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        if ($user->fk_role_id != 1) {
            return redirect()->route('canchas.index')
                ->with('error', 'No tienes permisos para actualizar canchas.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|string|max:255',
            'fk_ubicacion_id' => 'required|exists:ubicacions,id',
            'disponible' => 'required|boolean',
        ]);

        $cancha = Cancha::findOrFail($id);

        // Seguridad: validar que la cancha le pertenezca al admin
        if ($cancha->fk_admin_id !== $user->id) {
            return redirect()->route('canchas.index')
                ->with('error', 'No tienes permiso para actualizar esta cancha.');
        }

        $cancha->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'fk_ubicacion_id' => $request->fk_ubicacion_id,
            'disponible' => $request->disponible, // 👈 cambio de estado
        ]);

        return redirect()->route('admin.dash_admin')
            ->with('success', 'Cancha actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        // Solo admins pueden eliminar
        if ($user->fk_role_id != 1) {
            return redirect()->route('canchas.index')
                ->with('error', 'No tienes permisos para eliminar canchas.');
        }

        $cancha = Cancha::with('ubicacion')->findOrFail($id);

        // Seguridad: validar que la cancha le pertenezca al admin
        if ($cancha->fk_admin_id !== $user->id) {
            return redirect()->route('canchas.index')
                ->with('error', 'No tienes permiso para eliminar esta cancha.');
        }

        // Borrar primero la ubicación relacionada

        $cancha->delete();

        return redirect()->route('admin.dash_admin')
            ->with('success', 'Cancha eliminada correctamente.');
    }
}
