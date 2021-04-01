<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Envios; 
use App\Http\Requests\EnviosFormRequest; 
use Illuminate\Support\Facades\Redirect; 
use DB;


class EnviosController extends Controller
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
                $envios=DB::table('envios')

                ->where('id_envio','LIKE','%'.$query.'%')
                ->where('condicion','=','1')
                ->orwhere('calle','LIKE','%'.$query.'%')
                ->where('condicion','=','1')
                ->orwhere('lugar_envio','LIKE','%'.$query.'%')
                ->where('condicion','=','1')
                ->orwhere('comuna','LIKE','%'.$query.'%')
                ->where('condicion','=','1')
                ->orwhere('ciudad','LIKE','%'.$query.'%')
                ->where('condicion','=','1')           
    
                ->orderBy('id_envio','desc')
                ->paginate(7);
                return view('envios.index',["envios"=>$envios,"searchText"=>$query]);
            }
        }

    
        public function create()
        { 
            return view("envios.create"); 
        }
    
        public function store(EnviosFormRequest $request)
        {
            try
            {
                DB::beginTransaction();

                $envios=new Envios;
                $envios->lugar_envio=$request->get('lugar_envio');
                $envios->calle=$request->get('calle');
                $envios->comuna=$request->get('comuna');
                $envios->ciudad=$request->get('ciudad');
                $envios->condicion='1';
                $envios->save();

                DB::Commit();
                return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
                return Redirect::to('envios');
            }
            catch(\Exception $e)
            {   
                return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
                DB::rollback();
                return Redirect::to('envios');
            }   
        }

        public function show($id_envio) 
        {
            return view("envios.show",["envios"=>Envios::findOrFail($id_envio)]);
        }


        public function edit($id_envio) 
        {
            return view("envios.edit",["envios"=>Envios::findOrFail($id_envio)]);
        }
    
        public function update(EnviosFormRequest $request,$id_envio) 
        {   
            try
            {
                DB::beginTransaction();

                $envios=Envios::findOrFail($id_envio); 
                $envios->lugar_envio=$request->get('lugar_envio');
                $envios->calle=$request->get('calle');
                $envios->comuna=$request->get('comuna');
                $envios->ciudad=$request->get('ciudad');
                $envios->update();

                DB::Commit();
                return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
                return Redirect::to('envios');
            }
            catch(\Exception $e)
            {   
                return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
                DB::rollback();
                return Redirect::to('envios');
            }   
            
        }
    
        public function destroy($id_envio) 
        {
            try
            {
                DB::beginTransaction();

                $envios=Envios::findOrFail($id_envio);
                $envios->condicion='0';  
                $envios->update();

                DB::Commit();
                return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
                return Redirect::to('envios');
            }
            catch(\Exception $e)
            {   
                return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
                DB::rollback();
                return Redirect::to('envios');
            }  

        }
}
