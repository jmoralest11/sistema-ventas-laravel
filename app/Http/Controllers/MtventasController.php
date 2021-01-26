<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Ingreso;
use App\Venta;
use App\Persona;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MtventasController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::count();
        $ventas = Venta::count();
        $articulos = Articulo::count();
        $articulos_desc = DB::table('articulo as a')->select('a.nombre', 'a.stock')->orderBy('a.idarticulo', 'DESC')->paginate(5);
        $ventas_ult = DB::table('venta as v')->join('persona as p', 'p.idpersona', '=', 'v.idcliente')->select('p.nombre', 'v.total_venta')->orderBy('v.idventa', 'DESC')->paginate(5);
        $ingresos_ult = DB::table('ingreso as i')->join('persona as p', 'p.idpersona', '=', 'i.idproveedor')->select('p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante')->orderBy('i.idingreso', 'DESC')->paginate(5);
        $clientes_ult = DB::table('persona as p')->select('p.nombre', 'p.tipo_persona')->orderBy('p.idpersona', 'DESC')->paginate(5);
        $clientes = Persona::where('tipo_persona', 'CLIENTE')->count();
        return view('mtventas', compact('ingresos', 'ventas', 'articulos', 'clientes', 'articulos_desc', 'ventas_ult', 'ingresos_ult', 'clientes_ult'));
    }
}
