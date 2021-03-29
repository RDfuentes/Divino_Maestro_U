<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Articulos; 
use App\Http\Requests\ArticulosFormRequest; 
use Illuminate\Support\Facades\Redirect; 
use DB;

class ArticulosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $articulos=DB::table('articulos as a')
            ->join('fabricas as f', 'a.id_fabrica', '=', 'f.id_fabrica')
            ->select('a.id_articulo','a.articulo','a.existencia','a.descripcion','a.condicion','f.nombre as fabricas')
            ->where('a.id_articulo','LIKE','%'.$query.'%')
            ->where('a.condicion','=','1')
            ->orwhere('a.articulo','LIKE','%'.$query.'%')
            ->where('a.condicion','=','1') 
            ->orwhere('f.nombre','LIKE','%'.$query.'%')
            ->where('a.condicion','=','1')  
            ->orwhere('a.existencia','LIKE','%'.$query.'%')
            ->where('a.condicion','=','1')   

            ->orderBy('a.id_articulo','desc')
            ->paginate(7);
            return view('articulos.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }

    public function create()
    { 
        $fabricas=DB::table('fabricas')->where('condicion','=','1')->get();
        return view("articulos.create",["fabricas"=>$fabricas]); 
    }

    public function store(ArticulosFormRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $articulos=new Articulos;
            $articulos->articulo=$request->get('articulo');
            $articulos->id_fabrica=$request->get('id_fabrica');
            $articulos->existencia=$request->get('existencia');
            $articulos->descripcion=$request->get('descripcion');
            $articulos->condicion='1';
            $articulos->save();

            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('articulos');
         
        }

        //2. EN CATCH, HACE UNA EXCEPCION - PARA SABER SI FUNCIONA QUITAR LA CONTRADIAGONAL
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
        }     
    }


    public function show($id_articulo) 
    {
        return view("articulos.show",["articulos"=>Articulos::findOrFail($id_articulo)]);
    }


    public function edit($id_articulo) 
    {
        $articulos=Articulos::findOrFail($id_articulo);
        $fabricas=DB::table('fabricas')->where('condicion','=','1')->get();
        return view("articulos.edit",["articulos"=>$articulos,"fabricas"=>$fabricas]);
    }

    public function update(ArticulosFormRequest $request,$id_articulo) 
    {   
        $articulos=Articulos::findOrFail($id_articulo); 
        $articulos->articulo=$request->get('articulo');
        $articulos->id_fabrica=$request->get('id_fabrica');
        $articulos->existencia=$request->get('existencia');
        $articulos->descripcion=$request->get('descripcion');
        $articulos->update();
        return Redirect::to('articulos');
    }

    public function destroy($id_articulo) 
    {
        $articulos=Articulos::findOrFail($id_articulo);
        $articulos->condicion='0';  
        $articulos->update();
        return Redirect::to('articulos');
    }
} 
