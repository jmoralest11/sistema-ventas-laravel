@extends('layouts.adminlte')
@section('title', 'Categorías')
@section('content')

<div class="container p-5">
    <h1>Categorías <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearCategoria"><i class="fa fa-plus" aria-hidden="true"></i></button></h1>

    <br> <a href="{{url('reporte-categorias')}}" class="btn btn-info">Reporte</a>
    
    <!-- Modal -->
    <div class="modal fade" id="crearCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categorias.store')}}" method="POST">
                        @csrf()
    
                        <div class="form-group">
                            <label for="nombre">Nombre Categoría</label>
                            <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="Ingresa Nombre..." value="{{old('nombre')}}">
                            @if($errors->has('nombre'))
                                <div class="invalid-feedback">
                                    {{$errors->first('nombre')}}
                                </div>
                            @endif
                        </div>
    
                        <div class="form-group">
                            <label for="descripcion">Descripción Categoría</label>
                            <textarea name="descripcion" cols="30" rows="5" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" placeholder="Ingresa Descripción...">{{old('descripcion')}}</textarea>
                            @if($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{$errors->first('descripcion')}}
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
                <th>Descripción</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{$categoria->nombre}}</td>
                <td>{{$categoria->descripcion}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarCategoria{{$categoria->idcategoria}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
    
                    <!-- Modal -->
                    <div class="modal fade" id="editarCategoria{{$categoria->idcategoria}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('categorias.update', $categoria->idcategoria)}}" method="POST">
                                        @csrf()
    
                                        <input type="hidden" name="_method" value="put">
    
                                        <div class="form-group text-left">
                                            <label for="nombre">Nombre Categoría</label>
                                            <input type="text" class="form-control" placeholder="Ingresa Nombre..." name="nombre" value="{{$categoria->nombre}}">
                                        </div>
    
                                        <div class="form-group text-left">
                                            <label for="descripcion">Descripción Categoría</label>
                                            <textarea name="descripcion" cols="30" rows="5" class="form-control" placeholder="Ingresa Descripción...">{{$categoria->descripcion}}</textarea>
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
                    <form action="{{route('categorias.destroy', $categoria->idcategoria)}}" method="POST" class="categoria-form-delete">
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
    $('.categoria-form-delete').submit(function(e) {
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
                    'Se ha eliminado la categoría',
                    'success'
                )
            }
        })
    });
</script>

@endsection

@endsection