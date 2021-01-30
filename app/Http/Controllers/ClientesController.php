<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests; // use el request para validar campos que hay que llenar en las vistas
use App\Clientes; // use el modelo creado llamado clientes, que llama a todos los datos de la DB
use App\Http\Requests\ClientesFormRequest; // use el request creado, validar campos que hay que llenar en las vistas
use Illuminate\Support\Facades\Input; // no necesaria
use Illuminate\Support\Facades\Redirect; // cuando este en la vista clientes pueda pasar a otra vista 
use DB; // use la base datos, conexion a la base de datos 

// ENTERNDER EL CODIGO DEL CONTROLADOR 

class ClientesController extends Controller
{
    // funcion para login - para que no me deje pasar a la vista de clientes 
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ---------------------------------------------------------------------------------------------------------------------------------
    
    // funcion para mostrar el la vista index 
    public function index(Request $request) // cargar un objeto, principal
    {
        if($request)
        { 
            $query=trim($request->get('searchText')); // objeto en formulario listado para realizar busquedas

            // en el iner join la "c.direccion es el campo de la tabla clientes", "e.id_envio" es el campo de la tabla envios
            $clientes=DB::table('clientes as c')
            ->join('envios as e', 'c.id_envio','=','e.id_envio')
            ->select('c.id_cliente','c.codigo_unico','c.nombre','c.apellido','c.saldo','c.credito','c.descuento','c.condicion','e.lugar_envio as envios')           

            ->orwhere('c.id_cliente','LIKE','%'.$query.'%')
            ->where('c.condicion','=','1')
            ->orwhere('c.codigo_unico','LIKE','%'.$query.'%')
            ->where('c.condicion','=','1')
            ->orwhere('c.nombre','LIKE','%'.$query.'%')
            ->where('c.condicion','=','1')
            ->orwhere('c.apellido','LIKE','%'.$query.'%')
            ->where('c.condicion','=','1')  
            ->orwhere('e.lugar_envio','LIKE','%'.$query.'%')
            ->where('c.condicion','=','1')   

            ->orderBy('c.id_cliente','desc')
            ->paginate(7);
            return view('clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
        }
    }
    // --------------------------------------------------------------------------------------------------------------------------------

    // funcion que sirve para dirigir a la vista de crear un cliete

    public function create() // cargar un objeto y sus datos 
    { 
        $envios=DB::table('envios')->where('condicion','=','1')->get();
        return view("clientes.create",["envios"=>$envios]);// retorna a la vista principal que se ha creado en resource
    }

    // --------------------------------------------------------------------------------------------------------------------------------

    // store sirve para craer un nuevo cliente - este se conecta desde la vista, gracias a los datos ingresados por el clientes 
    // hacia el controlador -> modelo -> base de datos 
    public function store(ClientesFormRequest $request) // almacenar un objeto y los datos 
    {
        $clientes=new Clientes;
        $clientes->codigo_unico=$request->get('codigo_unico');
        $clientes->nombre=$request->get('nombre');
        $clientes->apellido=$request->get('apellido');
        $clientes->id_envio=$request->get('id_envio');
        $clientes->saldo=$request->get('saldo'); 
        $clientes->credito=$request->get('credito');
        $clientes->descuento=$request->get('descuento');
        $clientes->condicion='1';
        $clientes->save();
        return Redirect::to('clientes');
    }

    // funcion show para mostrar las vistas, en base al id unico de cada objeto 

    public function show($id_cliente) // mostrar un objeto y los datos
    {
        return view("clientes.show",["clientes"=>Clientes::findOrFail($id_cliente)]);
    }

    
    // funcion para editar cliente 
    public function edit($id_cliente) // editar un objeto y los datos
    {
        $clientes=Clientes::findOrFail($id_cliente);
        $envios=DB::table('envios')->where('condicion','=','1')->get();
        return view("clientes.edit",["clientes"=>$clientes,"envios"=>$envios]);
    }

    public function update(ClientesFormRequest $request,$id_cliente) // guardar un objeto y los datos
    {   
        $clientes=Clientes::findOrFail($id_cliente); // duda
        $clientes->codigo_unico=$request->get('codigo_unico');
        $clientes->nombre=$request->get('nombre');
        $clientes->apellido=$request->get('apellido');
        $clientes->id_envio=$request->get('id_envio');
        $clientes->saldo=$request->get('saldo');
        $clientes->credito=$request->get('credito');
        $clientes->descuento=$request->get('descuento');
        $clientes->update();
        return Redirect::to('clientes');
    }

    public function destroy($id_cliente) // eliminar un objeto y sus datos
    {
        $clientes=Clientes::findOrFail($id_cliente);
        $clientes->condicion='0';  
        $clientes->update();
        return Redirect::to('clientes');
    }
}
