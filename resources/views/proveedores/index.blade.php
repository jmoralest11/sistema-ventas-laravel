@extends('layouts.adminlte')
@section('title', 'Proveedores')
@section('content')

<div class="container p-5">
    <h1>Proveedores <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearProveedor"><i class="fa fa-plus" aria-hidden="true"></i></button></h1>

    <br> <a href="{{url('reporte-proveedores')}}" class="btn btn-info">Reporte</a>
    
    <!-- Modal -->
    <div class="modal fade" id="crearProveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('proveedores.store')}}" method="POST">
                        @csrf()
    
                        <div class="form-group">
                            <label for="nombre">Nombre Proveedor</label>
                            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="Ingresa Nombre..." name="nombre" value="{{old('nombre')}}">
                            @if($errors->has('nombre'))
                                <div class="invalid-feedback">
                                    {{$errors->first('nombre')}}
                                </div>
                            @endif
                        </div>
    
                        <div class="form-group">
                            <label for="tipo_documento">Tipo Documento</label>
                            <select name="tipo_documento" class="form-control">
                                <option value="DNI">CC (Cédula Ciudadanía)</option>
                                <option value="NIT">NIT (DIAN)</option>
                                <option value="CE">CE (Cédula Extranjería)</option>
                                <option value="MS">MS (Menor sin Identificación)</option>
                                <option value="PA">PA (Pasaporte)</option>
                                <option value="RC">RC (Registro Civil)</option>
                                <option value="TI">TI (Tarjeta Identidad)</option>
                                <option value="AS">AS (Adulto sin Identidad)</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="num_documento">Número Documento</label>
                            <input type="text" name="num_documento" class="form-control {{ $errors->has('num_documento') ? 'is-invalid' : '' }}" value="{{old('num_documento')}}" placeholder="Ingresa Documento...">
                            @if($errors->has('num_documento'))
                                <div class="invalid-feedback">
                                    {{$errors->first('num_documento')}}
                                </div>
                            @endif
                        </div>
    
                        <div class="form-row">
                            <div class="col">
                                <label for="direccion">Dirección Proveedor</label>
                                <input type="text" class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" placeholder="Ingresa Dirección..." name="direccion" value="{{old('direccion')}}">
                                @if($errors->has('direccion'))
                                <div class="invalid-feedback">
                                    {{$errors->first('direccion')}}
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <label for="telefono">Teléfono Proveedor</label>
                                <input type="text" class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" placeholder="Ingresa Teléfono..." name="telefono" value="{{old('telefono')}}">
                                @if($errors->has('telefono'))
                                <div class="invalid-feedback">
                                    {{$errors->first('telefono')}}
                                </div>
                                @endif
                            </div>
                        </div>
    
                        <hr>
    
                        <div class="form-group">
                            <label for="email">Email Proveedor</label>
                            <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{old('email')}}" placeholder="Ingresa Email...">
                            @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{$errors->first('email')}}
                            </div>
                            @endif
                        </div>
    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Crear</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    
    <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo Documento</th>
                <th>Número Documento</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
            <tr>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->tipo_documento}}</td>
                <td>{{$proveedor->num_documento}}</td>
                <td>{{$proveedor->direccion}}</td>
                <td>{{$proveedor->telefono}}</td>
                <td>{{$proveedor->email}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarProveedor{{$proveedor->idpersona}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
    
                    <!-- Modal -->
                    <div class="modal fade" id="editarProveedor{{$proveedor->idpersona}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('proveedores.update', $proveedor->idpersona)}}" method="POST">
                                        @csrf()
    
                                        <input type="hidden" name="_method" value="put">
    
                                        <div class="form-group text-left">
                                            <label for="nombre">Nombre Proveedor</label>
                                            <input type="text" class="form-control" placeholder="Ingresa Nombre..." name="nombre" value="{{$proveedor->nombre}}">
                                        </div>
    
                                        <div class="form-group text-left">
                                            <label for="tipo_documento">Tipo Documento</label>
                                            <select name="tipo_documento" class="form-control">
                                                <option value="DNI">CC (Cédula Ciudadanía)</option>
                                                <option value="NIT">NIT (DIAN)</option>
                                                <option value="CE">CE (Cédula Extranjería)</option>
                                                <option value="MS">MS (Menor sin Identificación)</option>
                                                <option value="PA">PA (Pasaporte)</option>
                                                <option value="RC">RC (Registro Civil)</option>
                                                <option value="TI">TI (Tarjeta Identidad)</option>
                                                <option value="AS">AS (Adulto sin Identidad)</option>
                                            </select>
                                        </div>
    
                                        <div class="form-group text-left">
                                            <label for="num_documento">Número Documento</label>
                                            <input type="text" name="num_documento" class="form-control" value="{{$proveedor->num_documento}}" placeholder="Ingresa Documento">
                                        </div>
    
                                        <div class="form-row text-left">
                                            <div class="col">
                                                <label for="direccion">Dirección Proveedor</label>
                                                <input type="text" class="form-control" placeholder="Ingresa Dirección..." name="direccion" value="{{$proveedor->direccion}}">
                                            </div>
                                            <div class="col">
                                                <label for="telefono">Teléfono Proveedor</label>
                                                <input type="text" class="form-control" placeholder="Ingresa Teléfono..." name="telefono" value="{{$proveedor->telefono}}">
                                            </div>
                                        </div>
    
                                        <hr>
    
                                        <div class="form-group text-left">
                                            <label for="email">Email Proveedor</label>
                                            <input type="text" name="email" class="form-control" value="{{$proveedor->email}}" placeholder="Ingresa Email...">
                                        </div>
    
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Editar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{route('proveedores.destroy', $proveedor->idpersona)}}" method="POST" class="cliente-form-delete">
                        @csrf()
                        {{method_field('DELETE')}}
    
                        <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" type="submit"></i></button>
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
    $('.cliente-form-delete').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "No puedes revertir está acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
                Swal.fire(
                    'Eliminado',
                    'Se ha eliminado el proveedor',
                    'success'
                )
            }
        })
    });
</script>

@endsection

@endsection