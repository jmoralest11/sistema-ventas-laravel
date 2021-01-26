<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';

    protected $primaryKey = 'idarticulo';

    public $timestamps = false;

    protected $fillable = [
        'idcategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'
    ];

    public function categorias(){
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }
}
