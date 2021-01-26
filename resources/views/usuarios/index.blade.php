@extends('layouts.adminlte')
@section('title', 'Usuarios')
@section('content')

<div class="container p-5">
    <h1>Usuarios <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearUsuario"><i class="fa fa-plus" aria-hidden="true"></i></button></h1>

    <!-- Modal -->
    <div class="modal fade" id="crearUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('usuarios.store')}}" method="POST">
                        @csrf()

                        <div class="form-group">
                            <label for="name">Nombre Usuario</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Ingresa Nombre..." value="{{old('name')}}">
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email Usuario</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Ingresa Email..." value="{{old('email')}}">
                            @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{$errors->first('email')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña Usuario</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Ingresa Contraseña..." value="{{old('password')}}">
                            @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{$errors->first('password')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña...">
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
                <th>Correo Electrónico</th>
                <th>Fecha Creación</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->created_at}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarUsuario{{$usuario->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                    <!-- Modal -->
                    <div class="modal fade" id="editarUsuario{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('usuarios.update', $usuario->id)}}" method="POST">
                                        @csrf()

                                        <input type="hidden" name="_method" value="put">

                                        <div class="form-group text-left">
                                            <label for="nombre">Nombre Usuario</label>
                                            <input type="text" class="form-control" placeholder="Ingresa Nombre..." name="name" value="{{$usuario->name}}">
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="email">Email Usuario</label>
                                            <input type="email" name="email" class="form-control" placeholder="Ingresa Email..." value="{{$usuario->email}}">
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="password">Contraseña Usuario</label>
                                            <input type="password" name="password" class="form-control" placeholder="Ingresa Contraseña..." value="{{$usuario->password}}">
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
                    <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST" class="usuario-form-delete">
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
    $('.usuario-form-delete').submit(function(e) {
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
                    'Se ha eliminado el usuario',
                    'success'
                )
            }
        })
    });
</script>

@endsection

@endsection