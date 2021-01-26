@extends('layouts.adminlte')
@section('title', 'MTVentas')
@section('content')

<div class="container p-5">
    <h1>MTVentas - Panel de Control</h1>

    <br>
    <hr>

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><strong>I</strong></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ingresos</span>
                    <span class="info-box-number">{{$ingresos}}<small></small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><strong>A</strong></span>

                <div class="info-box-content">
                    <span class="info-box-text">Artículos</span>
                    <span class="info-box-number">{{$articulos}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><strong>V</strong></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ventas</span>
                    <span class="info-box-number">{{$ventas}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><strong>C</strong></span>

                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">{{$clientes}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <br>

    <hr>

    <div class="row">
        <div class="col-6">
            <h2><small class="text-danger"><strong>Últimos Artículos</strong></small></h2>
            <ul class="list-group list-group-flush">
                @foreach($articulos_desc as $articulo)
                <li class="list-group-item list-group-item-light">{{$articulo->nombre}} - Stock: {{$articulo->stock}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-6">
            <h2><small class="text-green"><strong>Últimas Ventas</strong></small></h2>
            <ul class="list-group list-group-flush">
                @foreach($ventas_ult as $venta)
                <li class="list-group-item list-group-item-light">{{$venta->nombre}} - Total: $ {{number_format($venta->total_venta)}}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <br>
    <hr><br>

    <div class="row">
        <div class="col-6">
            <h2><small class="text-blue"><strong>Últimos Ingresos</strong></small></h2>
            <ul class="list-group list-group-flush">
                @foreach($ingresos_ult as $ingreso)
                    <li class="list-group-item list-group-item-light">{{$ingreso->nombre}} - {{$ingreso->tipo_comprobante}} {{$ingreso->serie_comprobante}}:{{$ingreso->num_comprobante}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-6">
            <h2><small class="text-yellow"><strong>Últimos Clientes</strong></small></h2>
            <ul class="list-group list-group-flush">
                @foreach($clientes_ult as $cliente)
                <li class="list-group-item list-group-item-light">{{$cliente->nombre}} - Tipo Persona: {{$cliente->tipo_persona}}</li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection