@extends('layouts.reportes')
@section('title', 'Reporte Ingresos')
@section('content')

<h1>Listado Ingresos</h1>

<hr>

<table id="detalles" class="table table-striped table-bordered text-center">
    <thead style="background-color: #A9D0F5;">
        <tr>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Comprobante</th>
            <th>Total</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ingresos as $ingreso)
            <tr>
                <td>{{$ingreso->fecha}}</td>
                <td>{{$ingreso->nombre}}</td>
                <td>{{$ingreso->tipo_comprobante . ': ' . $ingreso->serie_comprobante . ' - ' . $ingreso->num_comprobante}}</td>
                <td>$ {{number_format($ingreso->total)}}</td>
                <td>{{$ingreso->estado}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection