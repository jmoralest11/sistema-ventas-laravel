@extends('layouts.reportes')
@section('title', 'Reporte Artículos')
@section('content')

<h1>Listado Artículos</h1>

<hr>

<table id="detalles" class="table table-striped table-bordered text-center">
    <thead style="background-color: #A9D0F5;">
        <tr>
            <th>Código</th>
            <th>Artículo</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articulos as $articulo)
        <tr>
            <td>{{$articulo->codigo}}</td>
            <td>{{$articulo->nombre}}</td>
            <td>{{$articulo->descripcion}}</td>
            <td>{{$articulo->categorias->nombre}}</td>
            <td>{{$articulo->stock}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection