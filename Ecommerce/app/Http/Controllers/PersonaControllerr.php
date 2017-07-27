<?php

namespace carrito\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use carrito\Http\Request;
use carrito\Persona;
use carrito\Http\Requests\PersonaFormRequest;
use DB;

class PersonaControllerr extends Controller
{
    public function __construct(){
    	//validaciones
    }

    public function index(Request $request){
    	//si existe request
    	if ($request) {
    		$query= trim($request->get('searchText'));
    		// '%' comodin en la busqueda
    		$categorias= DB::table('categorias')->where('nombre','like','%'.$query.'%')
    		->where('condicion','=','1')
    		->orderBy('idcategoria','desc')
    		->paginate(7);
    		return view('almacen.categorias.index',["categorias"=>$categorias,"searchText"=>$query]);   
    	}        
    }
    
    public function create(){
    	return view("almacen.categorias.create");
    }

    public function store(CategoriaFormRequest $request){
    	$categoria= new Categoria;
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->condicion= '1';
    	$categoria->save();
    	return Redirect::to('almacen/categorias');
    }

    public function show($id){
    	return view ("almacen.categorias.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id){
		return view ("almacen.categorias.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request, $id)
    {
    	$categoria = Categoria :: findOrFail($id);
    	$categoria->nombre= $request->get('nombre');
    	$categoria->descripcion = $request -> get('descripcion');
    	$categoria->update();
    	return Redirect('almacen/categorias');
    }
    public function destroy($id){
    	$categoria= Categoria:: findOrFail($id);
    	$categoria->condicion='0';
    	$categoria->update();
    	return Redirect('almacen/categorias');
    }
}
