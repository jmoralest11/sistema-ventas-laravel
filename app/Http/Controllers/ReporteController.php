<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Categoria;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function reporteArticulos() {
        $articulos = Articulo::all();
        $pdf = \PDF::loadview('reportes.articulos', compact('articulos'));
        return $pdf->stream('articulos.pdf');
    }

    public function reporteCategorias() {
        $categorias = Categoria::all();
        $pdf = \PDF::loadview('reportes.categorias', compact('categorias'));
        return $pdf->stream('categorias.pdf');
    }

    public function reporteClientes() {
        $clientes = Persona::all()->where('tipo_persona', '=', 'CLIENTE');
        $pdf = \PDF::loadview('reportes.clientes', compact('clientes'));
        return $pdf->stream('clientes.pdf');
    }

    public function reporteProveedores() {
        $proveedores = Persona::all()->where('tipo_persona', '=', 'PROVEEDOR');
        $pdf = \PDF::loadview('reportes.proveedores', compact('proveedores'));
        return $pdf->stream('proveedores.pdf');
    }

    public function reporteIngresos(Request $request) {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        if(!empty($fecha_inicio) && !empty($fecha_fin)) {
            $ingresos = DB::table('ingreso as i')->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')->select('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('SUM(di.cantidad * di.precio_compra) as total'))->orderBy('i.idingreso', 'DESC')->groupBy('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')->where('i.fecha', '>=', $fecha_inicio)->where('i.fecha', '<=', $fecha_fin)->get();
        } else {
            $ingresos = DB::table('ingreso as i')->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')->select('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('SUM(di.cantidad * di.precio_compra) as total'))->orderBy('i.idingreso', 'DESC')->groupBy('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')->get();
        }
        $pdf = \PDF::loadview('reportes.ingresos', compact('ingresos'));
        return $pdf->stream('ingresos.pdf');
    }

    public function reporteVentas(Request $request) {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        if(!empty($fecha_inicio) && !empty($fecha_fin)) {
            $ventas = DB::table('venta as v')->join('persona as p', 'v.idcliente', '=', 'p.idpersona')->join('detalle_venta as dv', 'dv.idventa', '=', 'v.idventa')->select('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->orderBy('v.idventa', 'DESC')->groupBy('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->where('v.fecha', '>=', $fecha_inicio)->where('v.fecha', '<=', $fecha_fin)->get();
        } else {
            $ventas = DB::table('venta as v')->join('persona as p', 'v.idcliente', '=', 'p.idpersona')->join('detalle_venta as dv', 'dv.idventa', '=', 'v.idventa')->select('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->orderBy('v.idventa', 'DESC')->groupBy('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->get();
        }
        $pdf = \PDF::loadview('reportes.ventas', compact('ventas'));
        return $pdf->stream('ventas.pdf');
    }
}
