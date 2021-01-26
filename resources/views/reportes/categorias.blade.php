@extends('layouts.reportes')
@section('title', 'Reporte Categorías')
@section('content')

<h1>Listado Categorías</h1>

<hr>

<table id="detalles" class="table table-striped table-bordered text-center">
    <thead style="background-color: #A9D0F5;">
        <tr>
            <th>Categoría</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{$categoria->nombre}}</td>
            <td>{{$categoria->descripcion}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection