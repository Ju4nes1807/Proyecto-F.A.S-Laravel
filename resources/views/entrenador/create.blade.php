@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Entrenamiento</h1>

    <form action="{{ route('entrenador/entrenamientos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                @foreach($categorias as $c)
                    <option value="{{ $c->id }}" {{ old('categoria_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->nombre ?? $c->tipo ?? 'Categoría' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="lugar">Lugar</label>
            <input type="text" name="lugar" id="lugar" class="form-control" value="{{ old('lugar') }}" required>
        </div>

        <div class="row">
            <div class="col">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
            </div>
            <div class="col">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Guardar</button>
        <a href="{{ route('entrenador/entrenamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
