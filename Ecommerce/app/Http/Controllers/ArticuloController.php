<?php

namespace carrito\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use carrito\Articulo;
use carrito\Http\Requests\ArticuloFormRequest;
use DB;
use Validator;

class ArticuloController extends Controller
{
    public function __construct(){
    	//validaciones
    }

    public function index(Request $request){
    	//si existe request
    	if ($request) {
    		$query= trim($request->get('searchText'));
    		// '%' comodin en la busqueda
    		$articulos= DB::table('articulos as a')
    		->join('categorias as c','a.idcategoria','=','c.idcategoria')
    		->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
    		->where('a.nombre','like','%'.$query.'%')
    		->where('c.condicion','=','1')
    		->orderBy('a.idarticulo','desc')
    		->paginate(7);
            //return $articulos->toArray();
    		return view('almacen.articulos.index',["articulos"=>$articulos,"searchText"=>$query]);   
    	}        
    }
    
    public function create(){
    	$categorias =DB::table('categorias')->where('condicion','=','1')-> get();

    	return view("almacen.articulos.create",['categorias'=>$categorias]);
    }

    public function store(ArticuloFormRequest $request){
    	$articulo= new Articulo;
    	$articulo->codigo=$request->get('codigo');
    	$articulo->idcategoria=$request->get('idcategoria');
    	$articulo->stock=$request->get('stock');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado= 'Activo';
    	if(Input::hasfile('imagen')){
    		$file= Input::file('imagen');
    		$file->move(public_path().'/img/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}
    	$articulo->save();
    	return Redirect::to('almacen/articulos');
    }

    public function show($id){
    	return view ("almacen.articulos.show",["articulo"=>Articulo::findOrFail($id)]);
    }
    public function edit($id){
    	$categorias =DB::table('categorias')->where('condicion','=','1')-> get();
		return view ("almacen.articulos.edit",["articulo"=>Articulo::findOrFail($id),'categorias'=>$categorias]);
    }
    public function update(ArticuloFormRequest $request, $id)
    {
    	$articulo = Articulo::findOrFail($id);
    	$articulo->codigo=$request->get('codigo');
    	$articulo->idcategoria=$request->get('idcategoria');
    	$articulo->stock=$request->get('stock');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado= 'Activo';
    	if(Input::hasfile('imagen')){
    		$file= Input::file('imagen');
    		$file->move(public_path().'imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$fiel->getClientOriginalName();
    	};
    	$articulo->update();
    	return Redirect('almacen/articulos');
    }
    public function destroy($id){
    	$articulo= Articulo:: findOrFail($id);
    	$articulo->estado='Inactivo';
    	$articulo->update();
    	return Redirect('almacen/articulos');
    }    
}
