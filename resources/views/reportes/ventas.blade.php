@extends('layouts.reportes')
@section('title', 'Reporte Ventas')
@section('content')

<h1>Listado Ventas</h1>

<hr>

<table id="detalles" class="table table-striped table-bordered text-center">
    <thead style="background-color: #A9D0F5;">
        <tr>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Comprobante</th>
            <th>Total</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
        <tr>
            <td>{{$venta->fecha}}</td>
            <td>{{$venta->nombre}}</td>
            <td>{{$venta->tipo_comprobante . ': ' . $venta->serie_comprobante . ' - ' . $venta->num_comprobante}}</td>
            <td>$ {{number_format($venta->total_venta)}}</td>
            <td>{{$venta->estado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection