<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Categoria;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::all()->where('estado', 'ACTIVO');
        $categorias = Categoria::all();
        return view('articulos.index', compact('articulos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'idcategoria' => 'required|numeric',
            'codigo' => 'required|string|max:50',
            'nombre' => 'required|string|max:100',
            'stock' => 'required|numeric',
            'descripcion' => 'string'
        ]);

        $articulo = new Articulo();
        $articulo->idcategoria = $request->input('idcategoria');
        $articulo->codigo = strtoupper($request->input('codigo'));
        $articulo->nombre = strtoupper($request->input('nombre'));
        $articulo->stock = $request->input('stock');
        $articulo->descripcion = strtoupper($request->input('descripcion'));
        $articulo->estado = 'ACTIVO';

        if($request->hasFile('imagen')){
            $articulo->imagen = $request->file('imagen')->store('uploads', 'public');
        }

        $articulo->save();

        return redirect(route('articulos.index'))->with('Mensaje', 'Artículo Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $articulo = Articulo::findOrFail($id);
        $articulo->idcategoria = $request->input('idcategoria');
        $articulo->codigo = strtoupper($request->input('codigo'));
        $articulo->nombre = strtoupper($request->input('nombre'));
        $articulo->stock = $request->input('stock');
        $articulo->descripcion = strtoupper($request->input('descripcion'));

        if($request->hasFile('imagen')){
            $articulo->imagen = $request->file('imagen')->store('uploads', 'public');
        }

        $articulo->save();

        return redirect(route('articulos.index'))->with('Mensaje', 'Artículo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articulo::destroy($id);
        return redirect(route('articulos.index'));
    }
}
