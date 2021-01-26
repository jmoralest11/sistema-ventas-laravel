@extends('layouts.reportes')
@section('title', 'Reporte Proveedores')
@section('content')

<h1>Listado Proveedores</h1>

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
        @foreach($proveedores as $proveedor)
        <tr>
            <td>{{$proveedor->num_documento}}</td>
            <td>{{$proveedor->nombre}}</td>
            <td>{{$proveedor->direccion}}</td>
            <td>{{$proveedor->telefono}}</td>
            <td>{{$proveedor->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection