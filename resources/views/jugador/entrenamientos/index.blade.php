@extends('layouts.principaljugador') {{-- Usa el layout de jugador --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary">Mis Entrenamientos</h2>

    @if($entrenamientos->isEmpty())
        <div class="alert alert-warning">No tienes entrenamientos asignados aún.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow-sm">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cancha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrenamientos as $entrenamiento)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $entrenamiento->titulo }}</td>
                            <td>{{ $entrenamiento->descripcion }}</td>
                            <td>{{ $entrenamiento->fecha }}</td>
                            <td>{{ $entrenamiento->hora }}</td>
                            <td>{{ $entrenamiento->cancha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
