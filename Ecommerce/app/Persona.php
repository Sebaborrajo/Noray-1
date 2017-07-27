<?php

namespace carrito;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table= 'clientes';

    protected $primaryKey= 'idUsuario';

    public $timestamps= false;
    // capos que si queremos que se vean
    protected $filelable= [
    	'tipo_persona',
    	'nombre',
    	'tipo_documento',
    	'num_documento',
    	'direccion',
    	'telefono',
    	'email'
    ];
    // campos que no queremos que se vean
    protected $guarded=[
    ];

}
