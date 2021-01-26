<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware('auth')->group(function(){
    Route::resource('/categorias', 'CategoriaController');

    Route::resource('/articulos', 'ArticuloController');

    Route::resource('/clientes', 'ClienteController');

    Route::resource('/proveedores', 'ProveedorController');

    Route::resource('/ingresos', 'IngresoController');

    Route::resource('/ventas', 'VentaController');

    Route::resource('/usuarios', 'UsuarioController');

    Route::get('/mtventas', 'MtventasController@index');

    Route::get('/reporte-articulos', 'ReporteController@reporteArticulos');

    Route::get('/reporte-categorias', 'ReporteController@reporteCategorias');

    Route::get('/reporte-clientes', 'ReporteController@reporteClientes');

    Route::get('/reporte-proveedores', 'ReporteController@reporteProveedores');

    Route::post('/reporte-ingresos', 'ReporteController@reporteIngresos')->name('reporte-ingresos');

    Route::post('/reporte-ventas', 'ReporteController@reporteVentas')->name('reporte-ventas');
});

Auth::routes();

