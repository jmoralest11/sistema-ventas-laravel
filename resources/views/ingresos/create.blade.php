@extends('layouts.adminlte')
@section('title', 'Crear Ingreso')
@section('content')

<div class="container p-5">

    <h1>Nuevo Ingreso</h1>

    <hr>


    <form action="{{route('ingresos.store')}}" method="POST">
        @csrf()

        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <select name="idproveedor" class="form-control mi-selector">
                @foreach($proveedores as $proveedor)
                <option value="{{$proveedor->idpersona}}">{{$proveedor->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="tipo_comprobante">Tipo Comprobante</label>
                <select name="tipo_comprobante" class="form-control">
                    <option value="BOLETA">BOLETA</option>
                    <option value="FACTURA">FACTURA</option>
                    <option value="TICKET">TICKET</option>
                </select>
            </div>

            <div class="col">
                <label for="serie_comprobante">Serie Comprobante</label>
                <input type="text" name="serie_comprobante" class="form-control {{ $errors->has('serie_comprobante') ? 'is-invalid' : '' }}" value="{{old('serie_comprobante')}}" placeholder="Ingresa Serie...">
                @if($errors->has('serie_comprobante'))
                <div class="invalid-feedback">
                    {{$errors->first('serie_comprobante')}}
                </div>
                @endif
            </div>

            <div class="col">
                <label for="num_documento">Número Comprobante</label>
                <input type="text" name="num_comprobante" class="form-control {{ $errors->has('num_comprobante') ? 'is-invalid' : '' }}" value="{{old('num_comprobante')}}" placeholder="Ingresa Número...">
                @if($errors->has('num_comprobante'))
                <div class="invalid-feedback">
                    {{$errors->first('num_comprobante')}}
                </div>
                @endif
            </div>
        </div>

        <hr>

        <div class="border border-info p-2">
            <div class="form-group">
                <label for="articulo">Artículo</label>
                <select name="pidarticulo" class="form-control mi-selector" id="pidarticulo">
                    @foreach($articulos as $articulo)
                    <option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">

                <div class="col">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="pcantidad" class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}" value="{{old('cantidad')}}" placeholder="Ingresa Cantidad..." min="0">
                    @if($errors->has('cantidad'))
                    <div class="invalid-feedback">
                        {{$errors->first('cantidad')}}
                    </div>
                    @endif
                </div>

                <div class="col">
                    <label for="precio_compra">Precio Compra</label>
                    <input type="number" name="precio_compra" id="pprecio_compra" class="form-control {{ $errors->has('precio_compra') ? 'is-invalid' : '' }}" value="{{old('precio_compra')}}" placeholder="Ingresa Precio Compra...">
                    @if($errors->has('precio_compra'))
                    <div class="invalid-feedback">
                        {{$errors->first('precio_compra')}}
                    </div>
                    @endif
                </div>

                <div class="col">
                    <label for="precio_venta">Precio Venta</label>
                    <input type="number" name="precio_venta" id="pprecio_venta" class="form-control {{ $errors->has('precio_venta') ? 'is-invalid' : '' }}" value="{{old('precio_venta')}}" placeholder="Ingresa Precio Venta...">
                    @if($errors->has('precio_venta'))
                    <div class="invalid-feedback">
                        {{$errors->first('precio_venta')}}
                    </div>
                    @endif
                </div>
            </div>

            <hr>

            <div class="form-group">
                <button class="btn btn-primary form-control" id="btn_add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
            </div>
        </div>

        <br>
        <hr>

        <table id="detalles" class="table table-striped table-bordered text-center">
            <thead style="background-color: #A9D0F5;">
                <tr>
                    <th>Opciones</th>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tfoot>
                <th><strong>TOTAL</strong></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>
                    <h4 id="total">$ 0</h4>
                </th>
            </tfoot>
            <tbody></tbody>
        </table>

        <hr>

        <div class="form-group" id="save">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#btn_add').click(function(e) {
            e.preventDefault();
            add();
        });
    });

    var cont = 0;
    total = 0;
    subtotal = [];
    $('#save').hide();

    function add() {
        idarticulo = $('#pidarticulo').val();
        articulo = $('#pidarticulo option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_compra = $('#pprecio_compra').val();
        precio_venta = $('#pprecio_venta').val();

        if (idarticulo != "" && cantidad != "" && cantidad > 0 && precio_compra != "" && precio_venta != "") {
            subtotal[cont] = (cantidad * precio_compra);
            total += subtotal[cont];

            var fila = '<tr class="selected" id="fila' + cont + '"><td><button class="btn btn-danger" type="button" onclick="eliminar(' + cont + ')"><i class="fa fa-times" aria-hidden="true"></i></button></td><td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '">' + articulo + '</td><td><input type="number" name="cantidad[]" value="' + cantidad + '"></td><td><input type="number" name="precio_compra[]" value="' + precio_compra + '"></td><td><input type="number" name="precio_venta[]" value="' + precio_venta + '"></td><td>' + subtotal[cont] + '</td></tr>';
            cont++;

            limpiar();
            $('#total').html("$ " + total);
            evaluar();

            $('#detalles').append(fila);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡Ingresa la Información!'
            })
        }
    }

    function eliminar(index) {
        total -= subtotal[index];
        $('#total').html("$ " + total);
        $('#fila' + index).remove();
        evaluar();
    }

    function limpiar() {
        $('#pcantidad').val('');
        $('#pprecio_compra').val('');
        $('#pprecio_venta').val('');
    }

    function evaluar() {
        if (total > 0) {
            $('#save').show();
        } else {
            $('#save').hide();
        }
    }
</script>
@endsection

@endsection