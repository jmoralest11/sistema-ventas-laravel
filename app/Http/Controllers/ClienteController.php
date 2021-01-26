<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Persona::all()->where('tipo_persona', 'CLIENTE');
        return view('clientes.index', compact('clientes'));
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
            'nombre' => 'required|string|max:100',
            'tipo_documento' => 'required|max:20',
            'num_documento' => 'max:15',
            'direccion' => 'max:70',
            'telefono' => 'max:15',
            'email' => 'email|max:50'
        ]);

        $persona = new Persona();
        $persona->tipo_persona = 'CLIENTE';
        $persona->nombre = strtoupper($request->input('nombre'));
        $persona->tipo_documento = $request->input('tipo_documento');
        $persona->num_documento = $request->input('num_documento');
        $persona->direccion = strtoupper($request->input('direccion'));
        $persona->telefono = $request->input('telefono');
        $persona->email = $request->input('email');
        $persona->save();

        return redirect(route('clientes.index'))->with('Mensaje', 'Cliente Guardado');
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
        $persona = Persona::findOrFail($id);
        $persona->nombre = strtoupper($request->input('nombre'));
        $persona->tipo_documento = $request->input('tipo_documento');
        $persona->num_documento = $request->input('num_documento');
        $persona->direccion = strtoupper($request->input('direccion'));
        $persona->telefono = $request->input('telefono');
        $persona->email = $request->input('email');
        $persona->save();

        return redirect(route('clientes.index'))->with('Mensaje', 'Cliente Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Persona::destroy($id);
        return redirect(route('clientes.index'));
    }
}
