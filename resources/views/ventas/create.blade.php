@extends('layouts.adminlte')
@section('title', 'Crear Venta')
@section('content')

<div class="container p-5">

    <h1>Nueva Venta</h1>

    <hr>

    <form action="{{route('ventas.store')}}" method="POST">
        @csrf()

        <div class="form-group">
            <label for="proveedor">Cliente</label>
            <select name="idcliente" class="form-control mi-selector">
                @foreach($clientes as $cliente)
                <option value="{{$cliente->idpersona}}">{{$cliente->nombre}}</option>
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
                <select name="idarticulo" class="form-control mi-selector" id="pidarticulo">
                    <option value="#">SELECCIONAR</option>
                    @foreach($articulos as $articulo)
                    <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">

                <div class="col">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="pcantidad" class="form-control" placeholder="Ingresa Cantidad...">
                </div>

                <div class="col">
                    <label for="stock">Stock</label>
                    <input type="number" name="pstock" id="pstock" class="form-control" min="0" disabled>
                </div>

                <div class="col">
                    <label for="precio_venta">Precio Venta</label>
                    <input type="number" name="precio_venta" id="pprecio_venta" class="form-control" disabled>
                </div>

                <div class="col">
                    <label for="descuento">Descuento</label>
                    <input type="number" name="descuento" id="pdescuento" class="form-control" min="0">
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
                <th></th>
                <th>
                    <h4 id="total">$ 0</h4> <input type="hidden" name="total_venta" id="total_venta">
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
    $('#pidarticulo').change(mostrarValores);
    $('#pdescuento').val(0);

    function mostrarValores() {
        datosArticulo = document.getElementById('pidarticulo').value.split('_');
        $('#pstock').val(datosArticulo[1]);
        $('#pprecio_venta').val(datosArticulo[2]);
    }

    function add() {
        datosArticulo = document.getElementById('pidarticulo').value.split('_');

        idarticulo = datosArticulo[0];
        articulo = $('#pidarticulo option:selected').text();
        cantidad = $('#pcantidad').val();

        precio_venta = $('#pprecio_venta').val();
        descuento = $('#pdescuento').val();
        stock = $('#pstock').val();

        if (idarticulo != "" && cantidad != "" && cantidad > 0 && precio_venta != "" && descuento != "") {
            if (parseInt(stock) >= parseInt(cantidad)) {
                subtotal[cont] = (cantidad * precio_venta - descuento);
                total += subtotal[cont];

                var fila = '<tr class="selected" id="fila' + cont + '"><td><button class="btn btn-danger" type="button" onclick="eliminar(' + cont + ')"><i class="fa fa-times" aria-hidden="true"></i></button></td><td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '">' + articulo + '</td><td><input type="number" name="cantidad[]" value="' + cantidad + '"></td><td><input type="number" name="precio_venta[]" value="' + precio_venta + '"></td><td><input type="number" name="descuento[]" value="' + descuento + '"></td><td>' + subtotal[cont] + '</td></tr>';
                cont++;

                limpiar();
                $('#total').html("$ " + total);
                $('#total_venta').val(total);
                evaluar();

                $('#detalles').append(fila);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La cantidad supera el Stock'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡Ingresa la Cantidad!'
            })
        }
    }

    function eliminar(index) {
        total -= subtotal[index];
        $('#total').html("$ " + total);
        $('#total_venta').val(total);
        $('#fila' + index).remove();
        evaluar();
    }

    function limpiar() {
        $('#pcantidad').val(0);
        $('#pstock').val('');
        $('#pprecio_venta').val('');
        $('#pdescuento').val(0);
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