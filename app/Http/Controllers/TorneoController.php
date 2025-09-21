<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Models\Torneo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Escuela;
use App\Models\Categoria;
class TorneoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        Torneo::where('estado', 'En curso')
            ->whereDate('fecha_fin', '<', now()->toDateString())
            ->update(['estado' => 'Finalizado']);

        $torneosQuery = Torneo::with(['escuelas', 'categoria', 'admin', 'ubicacion']);

        if ($request->filled('nombre')) {
            $torneosQuery->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('ubicacion_id')) {
            $torneosQuery->where('fk_ubicacion_id', $request->ubicacion_id);
        }

        $ubicaciones = Ubicacion::all();
        $categorias = Categoria::where('created_by', $user->id)->get();

        if ($user->fk_role_id == 1) {
            $torneos = $torneosQuery->get();
            return view('admin.torneos', compact('torneos', 'ubicaciones', 'categorias'));
        } elseif ($user->fk_role_id == 2) {
            if ($user->escuela) {
                // Torneos del entrenador
                $torneos = $torneosQuery
                    ->whereHas('escuelas', function ($query) use ($user) {
                        $query->where('escuelas.id', $user->escuela->id);
                    })
                    ->orderByRaw("FIELD(estado, 'En curso', 'Finalizado', 'Cancelado')")
                    ->get();

                // Categorías solo de los torneos de la escuela
                $categoriaIds = $torneos->pluck('categoria')->unique('nombre')->pluck('id');
                $categorias = Categoria::whereIn('id', $categoriaIds)->get();



                $ubicaciones = Ubicacion::all();

                return view('entrenador.torneos', compact('torneos', 'ubicaciones', 'categorias'));
            } else {
                // Si no tiene escuela asignada
                $torneos = collect();
                $ubicaciones = Ubicacion::all();
                $categorias = collect();
                return view('entrenador.torneos', compact('torneos', 'ubicaciones', 'categorias'));
            }
        } elseif ($user->fk_role_id == 3) { // Jugador
            $asignacion = $user->asignaciones()->first();
            $ubicaciones = Ubicacion::all();

            if ($asignacion && $asignacion->escuela_id && $asignacion->categoria_id) {

                // Obtenemos el nombre de la categoría asignada
                $categoriaNombre = $asignacion->categoria->nombre ?? null;

                $torneos = Torneo::select('torneos.*')
                    ->join('escuela_torneo', 'torneos.id', '=', 'escuela_torneo.fk_torneo_id')
                    ->join('categorias', 'torneos.fk_categoria_id', '=', 'categorias.id')
                    ->where('escuela_torneo.fk_escuela_id', $asignacion->escuela_id)
                    ->where('categorias.nombre', $categoriaNombre)
                    ->where('torneos.estado', 'En curso')
                    ->whereDate('torneos.fecha_inicio', '<=', now())
                    ->with(['escuelas', 'categoria', 'admin', 'ubicacion'])
                    ->orderBy('torneos.fecha_inicio', 'asc')
                    ->distinct()
                    ->get();

                // Categorías únicas por nombre
                $categorias = $torneos->pluck('categoria')->filter()->unique('nombre');

                return view('jugador.torneos', compact('torneos', 'ubicaciones', 'categorias'));
            } else {
                return view('jugador.torneos', [
                    'torneos' => collect(),
                    'ubicaciones' => $ubicaciones,
                    'categorias' => collect()
                ]);
            }
        }

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->fk_role_id != 1) {
            return redirect()->route('torneos.index')->with('error', 'No tienes permiso para crear torneos');
        }

        $categorias = Categoria::where('created_by', $user->id)->get();

        // Escuelas que no estén participando en un torneo activo/en curso
        $escuelas = Escuela::whereHas('categorias', function ($q) use ($categorias) {
            $q->whereIn('nombre', $categorias->pluck('nombre'));
        })
            ->whereDoesntHave('torneos', function ($q) {
                $q->whereIn('estado', ['En curso', 'Pendiente']);
            })
            ->get();

        $ubicaciones = Ubicacion::all();

        return view('admin.crearTorneo', compact('escuelas', 'categorias', 'ubicaciones'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->fk_role_id != 1) {
            return redirect()->route('torneos.index')->with('error', 'No tienes permiso para crear torneos');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date|before_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fk_categoria_id' => 'required|exists:categorias,id',
            'fk_ubicacion_id' => 'required|exists:ubicacions,id',
            'escuelas' => 'required|array',
        ]);

        $torneo = Torneo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'fk_admin_id' => $user->id,
            'fk_categoria_id' => $request->fk_categoria_id,
            'fk_ubicacion_id' => $request->fk_ubicacion_id,
        ]);

        $torneo->escuelas()->sync($request->escuelas);

        return redirect()->route('torneos.index')->with('success', 'Torneo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $torneo = Torneo::with(['escuelas', 'categoria', 'ubicacion', 'admin'])->findOrFail($id);

        if ($user->fk_role_id == 1) {
            return view('torneos.index', compact('torneo'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        // Traemos el torneo con sus escuelas
        $torneo = Torneo::with('escuelas')->where('fk_admin_id', $user->id)->findOrFail($id);

        // Categorías creadas por el admin
        $categorias = Categoria::where('created_by', $user->id)->get();

        // Escuelas ya inscritas en este torneo
        $escuelasInscritasIds = $torneo->escuelas->pluck('id');

        // Escuelas disponibles: las que cumplen categorías del admin
        // O las que ya están inscritas en este torneo
        $escuelas = Escuela::whereHas('categorias', function ($q) use ($categorias) {
            $q->whereIn('nombre', $categorias->pluck('nombre'));
        })
            ->orWhereIn('id', $escuelasInscritasIds)
            ->get();

        $ubicaciones = Ubicacion::all();

        return view('admin.editarTorneo', compact('torneo', 'escuelas', 'categorias', 'ubicaciones'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $torneo = Torneo::where('fk_admin_id', $user->id)->findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date|before_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fk_categoria_id' => 'required|exists:categorias,id',
            'fk_ubicacion_id' => 'required|exists:ubicacions,id',
            'escuelas' => 'required|array',
            'estado' => 'required|in:En curso,Finalizado,Cancelado',
        ]);

        $torneo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'fk_categoria_id' => $request->fk_categoria_id,
            'fk_ubicacion_id' => $request->fk_ubicacion_id,
            'estado' => $request->estado,
        ]);

        $torneo->escuelas()->sync($request->escuelas);

        return redirect()->route('admin.dash_admin')->with('success', 'Torneo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $torneo = Torneo::findOrFail($id);

        // Solo el admin que creó el torneo puede eliminarlo
        if ($torneo->fk_admin_id !== $user->id) {
            return redirect()->route('admin.dash_admin')->with('error', 'No tienes permiso para eliminar este torneo.');
        }

        try {
            $torneo->escuelas()->detach(); // Desasociar escuelas
            $torneo->delete();

            return redirect()->route('admin.dash_admin')->with('success', 'Torneo eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.dash_admin')->with('error', 'Ocurrió un error al eliminar el torneo.');
        }
    }
}
