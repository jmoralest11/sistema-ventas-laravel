<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\DetalleIngreso;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos = DB::table('ingreso as i')->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')->select('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('SUM(di.cantidad * di.precio_compra) as total'))->orderBy('i.idingreso', 'DESC')->groupBy('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')->get();
        return view('ingresos.index', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Persona::all()->where('tipo_persona', 'PROVEEDOR');
        $articulos = DB::table('articulo as a')->select(DB::raw('CONCAT(a.codigo, " - ", a.nombre) as articulo'), 'a.idarticulo')->where('a.estado', '=', 'ACTIVO')->get();
        return view('ingresos.create', compact('proveedores', 'articulos'));
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
            'idproveedor' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'num_comprobante' => 'required|max:10',
            'idarticulo' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required'
        ]);

        try {

            DB::beginTransaction();
            $ingreso = new Ingreso();
            $ingreso->idproveedor = $request->input('idproveedor');
            $ingreso->tipo_comprobante = $request->input('tipo_comprobante');
            $ingreso->serie_comprobante = $request->input('serie_comprobante');
            $ingreso->num_comprobante = $request->input('num_comprobante');

            $myTime = Carbon::now('America/Bogota');
            $ingreso->fecha = $myTime->toDateTimeString();
            $ingreso->impuesto = '0';
            $ingreso->estado = 'ACTIVO';
            $ingreso->save();

            $idarticulo = $request->input('idarticulo');
            $cantidad = $request->input('cantidad');
            $precio_compra = $request->input('precio_compra');
            $precio_venta = $request->input('precio_venta');

            $cont = 0;

            while($cont < count($idarticulo)) {
                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();

                $cont = $cont + 1;
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

        }

        return redirect(route('ingresos.index'))->with('Mensaje', 'Ingreso Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingreso = DB::table('ingreso as i')->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')->select('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('SUM(di.cantidad * di.precio_compra) as total'))->groupBy('i.idingreso', 'i.fecha', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')->where('i.idingreso', '=', $id)->first();

        $detalles = DB::table('detalle_ingreso as d')->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')->where('d.idingreso', '=', $id)->get();

        return view('ingresos.show', compact('ingreso', 'detalles'));
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
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->estado = 'CANCELADO';
        $ingreso->update();
        return redirect(route('ingresos.index'))->with('Mensaje', 'Se ha Anulado el Ingreso');
    }
}
