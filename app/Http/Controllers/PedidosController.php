<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; 
use App\Pedidos; 
use App\Http\Requests\PedidosFormRequest; 
use Illuminate\Support\Facades\Redirect; 
use DB;

class PedidosController extends Controller
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
            $pedidos=DB::table('pedidos as p')
            ->join('clientes as c', 'p.id_cliente','=','c.id_cliente')
            ->join('envios as e', 'p.id_envio','=','e.id_envio')
            ->join('articulos as a', 'p.id_articulo','=','a.id_articulo')
            ->select('p.id_pedido','p.id_cliente','p.id_envio','p.fecha','p.id_articulo','p.descripcion','p.cantidad','p.condicion',
            'c.nombre as clientes','c.apellido as clientess','e.lugar_envio as envios','a.articulo as articulos')
            
            ->where('p.id_pedido','LIKE','%'.$query.'%')
            ->where('p.condicion','=','1')
            ->orwhere('p.fecha','LIKE','%'.$query.'%')
            ->where('p.condicion','=','1')

            ->orderBy('p.id_pedido','desc')
            ->paginate(7);
            return view('pedidos.index',["pedidos"=>$pedidos,"searchText"=>$query]);
        }
    }

 
    public function create()
    { 
        //agregado 2 lineas       
        $clientes=DB::table('clientes')->where('condicion','=','1')->get();
        $envios=DB::table('envios')->where('condicion','=','1')->get();
        $articulos=DB::table('articulos')->where('condicion','=','1')->get();
        return view("pedidos.create",["clientes"=>$clientes,"envios"=>$envios,"articulos"=>$articulos]); // retorna a la vista principal que se ha creado en resource
    
    }

    public function store(PedidosFormRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $pedidos=new Pedidos;
            $pedidos->id_cliente=$request->get('id_cliente');
            $pedidos->id_envio=$request->get('id_envio');
            $pedidos->fecha=$request->get('fecha');
            $pedidos->id_articulo=$request->get('id_articulo');
            $pedidos->descripcion=$request->get('descripcion');
            $pedidos->cantidad=$request->get('cantidad');
            $pedidos->condicion='1';
            $pedidos->save();
            
            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('pedidos'); 
            
        }
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
            return Redirect::to('pedidos');
        }           
    }


    public function show($id_pedido) 
    {
        return view("pedidos.show",["pedidos"=>Pedidos::findOrFail($id_pedido)]);
    }


    public function edit($id_pedido) 
    {
        //Agregado 3 lineas
        $pedidos=Pedidos::findOrFail($id_pedido);
        $clientes=DB::table('clientes')->where('condicion','=','1')->get();
        $envios=DB::table('envios')->where('condicion','=','1')->get();
        $articulos=DB::table('articulos')->where('condicion','=','1')->get();
        return view("pedidos.edit",["pedidos"=>$pedidos,"clientes"=>$clientes,"envios"=>$envios,"articulos"=>$articulos]);
    }

    public function update(PedidosFormRequest $request,$id_pedido) 
    {   
        try
        {
            DB::beginTransaction();
            $pedidos=Pedidos::findOrFail($id_pedido); 
            $pedidos->id_cliente=$request->get('id_cliente');
            $pedidos->id_envio=$request->get('id_envio');
            $pedidos->fecha=$request->get('fecha');
            $pedidos->id_articulo=$request->get('id_articulo');
            $pedidos->descripcion=$request->get('descripcion');
            $pedidos->cantidad=$request->get('cantidad');
            $pedidos->update();

            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('pedidos');
        }
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
            return Redirect::to('pedidos');
        }   
    }

    public function destroy($id_pedido) 
    {
        try
        {
            DB::beginTransaction();
            $pedidos=Pedidos::findOrFail($id_pedido);
            $pedidos->condicion='0';  
            $pedidos->update();

            DB::Commit();
            return "<script type='text/javascript'>alert('La transacción se ejecuto correctamente');</script>";
            return Redirect::to('pedidos');
        }
        catch(\Exception $e)
        {   
            return "<script type='text/javascript'>alert('La transacción no se llevo a cabo');</script>";
            DB::rollback();
            return Redirect::to('pedidos');
        }   
    }
} 
