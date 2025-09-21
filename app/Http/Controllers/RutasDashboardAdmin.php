<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Torneo;
use App\Models\Cancha;
class RutasDashboardAdmin extends Controller
{
    public function rutasAdmin()
    {
        $user = Auth::user();

        $torneos = Torneo::with(['categoria', 'escuelas', 'ubicacion'])
            ->where('fk_admin_id', $user->id)
            ->get();

        Torneo::where('estado', 'En curso')
            ->whereDate('fecha_fin', '<', now()->toDateString())
            ->update(['estado' => 'Finalizado']);

        $canchas = Cancha::with(['escuela', 'ubicacion'])
            ->where('fk_admin_id', $user->id)
            ->get();

        return view('admin.dash_admin', compact('torneos', 'user', 'canchas'));
    }
}
