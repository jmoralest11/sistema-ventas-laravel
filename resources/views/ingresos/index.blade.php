@extends('layouts.adminlte')
@section('title', 'Ingresos')
@section('content')

<div class="container p-5">
    <h1>Ingresos <a type="button" class="btn btn-primary" href="{{route('ingresos.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a></h1>

    <hr>

    <form action="{{route('reporte-ingresos')}}" method="POST">
        @csrf()

        <div class="row">
            <div class="form-group col-md-6">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" placeholder="Ingrese Nombre del Usuario">     
            </div>

            <div class="form-group col-md-6">
                <label for="fecha_fin">Fecha Final</label>
                <input type="date" name="fecha_fin" class="form-control" placeholder="Ingrese Nombre del Usuario">     
            </div>
        </div>

        <br>

        <button type="submit" class="btn btn-info">Reporte</button>
        
    </form>

    <br>

    <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Comprobante</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Detalles</th>
                <th>Anular</th>
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
                    <td>
                        <a class="btn btn-primary" href="{{route('ingresos.show', $ingreso->idingreso)}}"><i class="fa fa-info" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <form action="{{route('ingresos.destroy', $ingreso->idingreso)}}" method="POST" class="ingresos-form-cancel">
                            @csrf()
                            {{method_field('DELETE')}}

                            <button class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('scripts')

@if(Session::has('Mensaje'))

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success('{{Session::get("Mensaje")}}');
</script>

@endif

<script>
    $('.ingresos-form-cancel').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "No puedes revertir está acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Anular',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
                Swal.fire(
                    'Eliminado',
                    'Se ha anulado el ingreso',
                    'success'
                )
            }
        })
    });
</script>

@endsection

@endsection