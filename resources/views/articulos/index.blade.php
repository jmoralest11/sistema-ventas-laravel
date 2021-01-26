@extends('layouts.adminlte')
@section('title', 'Artículos')
@section('content')

<div class="container p-5">
    <h1>Artículos <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearArticulo"><i class="fa fa-plus" aria-hidden="true"></i></button></h1>

    <br> <a href="{{url('reporte-articulos')}}" class="btn btn-info">Reporte</a>
    
    <!-- Modal -->
    <div class="modal fade" id="crearArticulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('articulos.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf()
    
                        <div class="form-row">
                            <div class="col">
                                <label for="codigo">Código Artículo</label>
                                <input type="text" class="form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" placeholder="Ingresa Código..." name="codigo" value="{{old('codigo')}}">
                                @if($errors->has('codigo'))
                                <div class="invalid-feedback">
                                    {{$errors->first('codigo')}}
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <label for="stock">Cantidad Artículo</label>
                                <input type="number" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" placeholder="Ingresa Stock..." name="stock" value="{{old('stock')}}">
                                @if($errors->has('stock'))
                                <div class="invalid-feedback">
                                    {{$errors->first('stock')}}
                                </div>
                                @endif
                            </div>
                        </div>
    
                        <hr>
    
                        <div class="form-group">
                            <label for="nombre">Nombre Artículo</label>
                            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="Ingresa Nombre..." name="nombre" value="{{old('nombre')}}">
                            @if($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{$errors->first('nombre')}}
                            </div>
                            @endif
                        </div>
    
                        <div class="form-group">
                            <label for="descripcion">Descripción Artículo</label>
                            <textarea name="descripcion" cols="30" rows="3" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" placeholder="Ingresa Descripción...">{{old('descripcion')}}</textarea>
                            @if($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{$errors->first('descripcion')}}
                            </div>
                            @endif
                        </div>
    
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select name="idcategoria" class="form-control mi-selector">
                                @foreach($categorias as $categoria)
                                <option value="{{$categoria->idcategoria}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="imagen">Imagen Artículo</label>
                            <input type="file" name="imagen" class="form-control {{ $errors->has('imagen') ? 'is-invalid' : '' }}">
                            @if($errors->has('imagen'))
                            <div class="invalid-feedback">
                                {{$errors->first('imagen')}}
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
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Categoría</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $articulo)
            <tr>
                <td>{{$articulo->codigo}}</td>
                <td>{{$articulo->nombre}}</td>
                <td>{{$articulo->descripcion}}</td>
                <td><img src="{{asset('storage/'.$articulo->imagen)}}" width="100" class="img-thumbnail img-fluid"></td>
                <td>{{$articulo->stock}}</td>
                <td>{{$articulo->categorias->nombre}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarCategoria{{$articulo->idarticulo}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
    
                    <!-- Modal -->
                    <div class="modal fade" id="editarCategoria{{$articulo->idarticulo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Artículo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('articulos.update', $articulo->idarticulo)}}" method="POST" enctype="multipart/form-data">
                                        @csrf()
    
                                        <input type="hidden" name="_method" value="put">
    
                                        <div class="form-row text-left">
                                            <div class="col">
                                                <label for="codigo">Código Artículo</label>
                                                <input type="text" class="form-control" placeholder="Ingresa Código..." name="codigo" value="{{$articulo->codigo}}">
                                            </div>
                                            <div class="col">
                                                <label for="stock">Stock Artículo</label>
                                                <input type="number" class="form-control" placeholder="Ingresa Stock..." name="stock" value="{{$articulo->stock}}">
                                            </div>
                                        </div>
    
                                        <hr>
    
                                        <div class="form-group text-left">
                                            <label for="nombre">Nombre Artículo</label>
                                            <input type="text" class="form-control" placeholder="Ingresa Nombre..." name="nombre" value="{{$articulo->nombre}}">
                                        </div>
    
                                        <div class="form-group text-left">
                                            <label for="descripcion">Descripción Artículo</label>
                                            <textarea name="descripcion" cols="30" rows="3" class="form-control" placeholder="Ingresa Descripción...">{{$articulo->descripcion}}</textarea>
                                        </div>
    
                                        <div class="form-group text-left">
                                            <label for="categoria">Categoría</label>
                                            <select name="idcategoria" class="form-control mi-selector">
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->idcategoria}}">{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
    
                                        <div class="form-group">
                                            <label for="imagen">Imagen Artículo</label>
                                            <input type="file" name="imagen" class="form-control">
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
                    <form action="{{route('articulos.destroy', $articulo->idarticulo)}}" method="POST" class="articulo-form-delete">
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
    $('.articulo-form-delete').submit(function(e) {
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
                    'Se ha eliminado el artículo',
                    'success'
                )
            }
        })
    });
</script>

@endsection

@endsection