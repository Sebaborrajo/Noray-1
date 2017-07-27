<?php

namespace carrito;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table= 'articulos';

    protected $primaryKey= 'idarticulo';

    public $timestamps= false;
    // capos que si queremos que se vean
    protected $filelable= [
    	'idcategoria',
    	'codigo',
    	'nombre',
    	'stock',
    	'descripcion',
    	'imagen',
    	'estado'
    ];
    // campos que no queremos que se vean
    protected $guarded=[
    ];
}
