<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Rol;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */

    private const MAX_LENGTH = 255;
    public function create(): View
    {
        $roles = Rol::all();
        return view('registro', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombres' => ['required', 'string', 'max:' . self::MAX_LENGTH],
            'apellidos' => ['required', 'string', 'max:' . self::MAX_LENGTH],
            'documento' => ['required', 'integer', 'unique:users,documento'],
            'fecha_nacimiento' => ['required', 'date'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:' . self::MAX_LENGTH, 'unique:users,email'],
            'telefono' => ['nullable', 'integer'],
            'rol_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'documento' => $request->documento,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'fk_role_id' => $request->rol_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        switch ($user->fk_role_id) {
            case 1: // Administrador
                return redirect()->route('admin.dash_admin');
            case 2: // Entrenador
                return redirect()->route('entrenador.principalEntrenador');
            case 3: // Jugador
                return redirect()->route('jugador.principal');
            default:
                return redirect()->route('landinpage');
        }
    }
}