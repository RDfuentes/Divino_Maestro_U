<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Fabricas; 
use App\Http\Requests\FabricasFormRequest; 
use Illuminate\Support\Facades\Redirect; 
use DB;

class FabricasController extends Controller
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
            $fabricas=DB::table('fabricas')

            ->where('id_fabrica','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orwhere('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orwhere('telefono','LIKE','%'.$query.'%')
            ->where('condicion','=','1')

            ->orderBy('id_fabrica','desc')
            ->paginate(7);
            return view('fabricas.index',["fabricas"=>$fabricas,"searchText"=>$query]);
        }
    }

 
    public function create()
    { 
        return view("fabricas.create"); 
    }

    public function store(FabricasFormRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $fabricas=new Fabricas;
            $fabricas->nombre=$request->get('nombre');
            $fabricas->telefono=$request->get('telefono');
            $fabricas->condicion='1';
            $fabricas->save();

            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('fabricas');
        }
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
            return Redirect::to('fabricas');
        }   
    }


    public function show($id_fabrica) 
    {
        return view("fabricas.show",["fabricas"=>Fabricas::findOrFail($id_fabrica)]);
    }


    public function edit($id_fabrica) 
    {
        return view("fabricas.edit",["fabricas"=>Fabricas::findOrFail($id_fabrica)]);
    }

    public function update(FabricasFormRequest $request,$id_fabrica) 
    {
        try
        {
            DB::beginTransaction(); 

            $fabricas=Fabricas::findOrFail($id_fabrica); 
            $fabricas->nombre=$request->get('nombre');
            $fabricas->telefono=$request->get('telefono');
            $fabricas->update();

            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('fabricas');
        }        
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
            return Redirect::to('fabricas');
        }   
    }

    public function destroy($id_fabrica) 
    {
        try
        {
            DB::beginTransaction(); 

            $fabricas=Fabricas::findOrFail($id_fabrica);
            $fabricas->condicion='0';  
            $fabricas->update();

            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('fabricas');
        }
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
            return Redirect::to('fabricas');
        }  
    }
} 
