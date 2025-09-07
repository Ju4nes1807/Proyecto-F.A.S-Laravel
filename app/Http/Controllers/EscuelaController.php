<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escuela;
use App\Models\Ubicacion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EscuelaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->fk_role_id == 1) { // Rol de Administrador
            // El administrador ve todas las escuelas
            $query = Escuela::query();

            if ($request->filled('q')) {
                $query->where('nombre', 'like', '%' . $request->q . '%');
            }

            $escuelas = $query->get();
            return view('admin.escuelas', compact('escuelas'));

        } elseif ($user->fk_role_id == 2) { // Rol de Entrenador
            // El entrenador ve solo las escuelas a las que está asociado
            $escuelas = $user->escuelas;
            return view('entrenador.escuelas', compact('escuelas'));

        } elseif ($user->fk_role_id == 3) { // Rol de Jugador
            // El jugador ve solo la información de su escuela
            $escuelas = [$user->escuela];
            return view('jugador.escuelas', compact('escuelas'));
        }

        // Para cualquier otro rol, o si no hay un rol definido
        return abort(403, 'Acceso no autorizado.');
    }



    public function create()
    {
        $user = auth()->user();

        // Si el usuario es Admin y ya tiene una escuela → no dejar registrar más
        if ($user->fk_role_id == 1 && $user->escuelas()->exists()) {
            return redirect()->route('escuelas.index')
                ->with('error', 'Ya tienes una escuela registrada. No puedes registrar otra.');
        }

        $ubicaciones = Ubicacion::all();
        return view('admin.inscripcionEscuela', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validar nuevamente en el store para evitar que se salten el create
        if ($user->fk_role_id == 1 && $user->escuelas()->exists()) {
            return redirect()->route('escuelas.create')
                ->with('error', 'Ya tienes una escuela registrada. No puedes registrar otra.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:15',
            'correo' => 'required|email|unique:escuelas,correo',
            'direccion' => 'required|string|max:255',
            'ubicacion_id' => 'required|exists:ubicacions,id',
        ]);

        $user->escuelas()->create($request->all());

        return redirect()->route('escuelas.index')->with('success', 'Escuela registrada exitosamente.');
    }

    public function edit($id)
    {
        $escuela = Escuela::findOrFail($id);

        // Verificar que la escuela pertenece al usuario
        if ($escuela->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta escuela.');
        }

        $ubicaciones = Ubicacion::all();

        return view('admin.editarEscuela', compact('escuela', 'ubicaciones'));
    }

    public function update(Request $request, $id)
    {
        $escuela = Escuela::findOrFail($id);

        if ($escuela->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta escuela.');
        }

        $data = $request->validate([
            'nombre' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:20',
            'correo' => 'nullable|email|unique:escuelas,correo,' . $escuela->id,
            'direccion' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'barrio' => 'nullable|string|max:255',
            'ubicacion_id' => 'nullable|exists:ubicacions,id',
        ]);

        $escuela->update(array_filter($data));

        return redirect()->route('escuelas.edit', $escuela->id)->with('success', 'Escuela actualizada correctamente.');
    }

    public function destroy($id)
    {
        $escuela = Escuela::findOrFail($id);

        if ($escuela->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta escuela.');
        }

        $escuela->delete();
        return redirect()->route('admin.dash_admin')->with('success', 'Escuela eliminada correctamente.');
    }
}
