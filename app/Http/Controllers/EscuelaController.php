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

    public function index()
    {
        $user = Auth::user();

        if ($user->fk_role_id == 1) { // Rol de Administrador
            // El administrador ve todas las escuelas
            $escuelas = Escuela::all();
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
        $ubicaciones = Ubicacion::all();
        return view('admin.inscripcionEscuela', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:15',
            'correo' => 'required|email|unique:escuelas,correo',
            'direccion' => 'required|string|max:255',
            'ubicacion_id' => 'required|exists:ubicacions,id',
        ]);

        auth()->user()->escuelas()->create($request->all());
        return redirect()->route('escuelas.create')->with('success', 'Escuela registrada exitosamente.');
    }
}
