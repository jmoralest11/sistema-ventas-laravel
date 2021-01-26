@extends('layouts.reportes')
@section('title', 'Reporte Clientes')
@section('content')

<h1>Listado Clientes</h1>

<hr>

<table class="table table-striped table-bordered text-center">
    <thead style="background-color: #A9D0F5;">
        <tr>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{$cliente->num_documento}}</td>
            <td>{{$cliente->nombre}}</td>
            <td>{{$cliente->direccion}}</td>
            <td>{{$cliente->telefono}}</td>
            <td>{{$cliente->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection