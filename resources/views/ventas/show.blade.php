@extends('layouts.adminlte')
@section('title', 'Mostrar Venta')
@section('content')

<div class="container p-5">

    <h1>Listar Venta # {{$venta->idventa}}</h1>

    <hr>

    <div class="form-group">
        <label for="proveedor"><strong>Cliente</strong></label>
        <p>{{$venta->nombre}}</p>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="tipo_comprobante"><strong>Tipo Comprobante</strong></label>
            <p>{{$venta->tipo_comprobante}}</p>
        </div>

        <div class="col">
            <label for="serie_comprobante"><strong>Serie Comprobante</strong></label>
            <p>{{$venta->serie_comprobante}}</p>
        </div>

        <div class="col">
            <label for="num_comprobante"><strong>Número Comprobante</strong></label>
            <p>{{$venta->num_comprobante}}</p>
        </div>
    </div>

    <hr>

    <table class="table table-striped table-bordered text-center">
        <thead style="background-color: #A9D0F5;">
            <tr>
                <th>Artículo</th>
                <th>Cantidad</th>
                <th>Precio Venta</th>
                <th>Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tfoot>
            <th><strong>TOTAL</strong></th>
            <th></th>
            <th></th>
            <th></th>
            <th>
                <h4>$ {{number_format($venta->total_venta)}}</h4>
            </th>
        </tfoot>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                    <td>{{$detalle->articulo}}</td>
                    <td>{{$detalle->cantidad}}</td>
                    <td>$ {{number_format($detalle->precio_venta)}}</td>
                    <td>$ {{number_format(($detalle->descuento))}}</td>
                    <td>$ {{number_format(($detalle->cantidad * $detalle->precio_venta - $detalle->descuento))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endsection