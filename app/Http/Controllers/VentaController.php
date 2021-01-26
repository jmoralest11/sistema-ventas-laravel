<?php

namespace App\Http\Controllers;

use App\Venta;
use App\DetalleVenta;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = DB::table('venta as v')->join('persona as p', 'v.idcliente', '=', 'p.idpersona')->join('detalle_venta as dv', 'dv.idventa', '=', 'v.idventa')->select('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->orderBy('v.idventa', 'DESC')->groupBy('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Persona::all();
        $articulos = DB::table('articulo as a')->join('detalle_ingreso as di', 'a.idarticulo', '=', 'di.idarticulo')->select(DB::raw('CONCAT(a.codigo, " - ", a.nombre) as articulo'), 'a.idarticulo', 'a.stock', DB::raw('AVG(di.precio_venta) as precio_promedio'))->where('a.estado', '=', 'ACTIVO')->where('a.stock', '>', '0')->groupBy('articulo', 'a.idarticulo', 'a.stock')->get();
        return view('ventas.create', compact('clientes', 'articulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idcliente' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'num_comprobante' => 'required|max:10',
            'idarticulo' => 'required',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            'descuento' => 'required',
            'total_venta' => 'required'
        ]);

        try {

            DB::beginTransaction();
            $venta = new Venta();
            $venta->idcliente = $request->input('idcliente');
            $venta->tipo_comprobante = $request->input('tipo_comprobante');
            $venta->serie_comprobante = $request->input('serie_comprobante');
            $venta->num_comprobante = $request->input('num_comprobante');
            $venta->total_venta = $request->input('total_venta');

            $myTime = Carbon::now('America/Bogota');
            $venta->fecha = $myTime->toDateTimeString();
            $venta->impuesto = '0';
            $venta->estado = 'ACTIVO';
            $venta->save();

            $idarticulo = $request->input('idarticulo');
            $cantidad = $request->input('cantidad');
            $descuento = $request->input('descuento');
            $precio_venta = $request->input('precio_venta');

            $cont = 0;

            while($cont < count($idarticulo)) {
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->idventa;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();

                $cont = $cont + 1;
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

        }

        return redirect(route('ventas.index'))->with('Mensaje', 'Venta Guardada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = DB::table('venta as v')->join('persona as p', 'p.idpersona', '=', 'v.idcliente')->join('detalle_venta as dv', 'dv.idventa', '=', 'v.idventa')->select('v.idventa', 'v.fecha', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')->where('v.idventa', '=', $id)->first();

        $detalles = DB::table('detalle_venta as dv')->join('articulo as a', 'a.idarticulo', '=', 'dv.idarticulo')->select('a.nombre as articulo', 'dv.cantidad', 'dv.descuento', 'dv.precio_venta')->where('dv.idventa', '=', $id)->get();

        return view('ventas.show', compact('venta', 'detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->estado = 'CANCELADO';
        $venta->update();
        return redirect(route('ventas.index'))->with('Mensaje', 'Se ha Anulado la Venta');
    }
}
