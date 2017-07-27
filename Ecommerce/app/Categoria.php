<?php

namespace carrito;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table= 'categorias';

    protected $primaryKey= 'idcategoria';

    public $timestamps= false;
    // capos que si queremos que se vean
    protected $filelable= [
    	'nombre',
    	'description',
    	'condicion'
    ];
    // campos que no queremos que se vean
    protected $guarded=[
    ];
}
