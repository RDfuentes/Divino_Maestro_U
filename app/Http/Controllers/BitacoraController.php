<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use Illuminate\Support\Facades\Redirect; 
use DB;  

class BitacoraController extends Controller
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
            $bitacoras=DB::table('bitacora_articulos')

            ->where('id_bitacora','LIKE','%'.$query.'%')
            ->orwhere('fecha','LIKE','%'.$query.'%')
            ->orwhere('actividad_realizada','LIKE','%'.$query.'%')

            ->orderBy('id_bitacora','desc')
            ->paginate(7);
            return view('bitacoras.index',["bitacoras"=>$bitacoras,"searchText"=>$query]);
        }
    }

    //FUNCION PARA LLAMAR A LOS DATOS QUE ESTEN EN LA VISTA Y MANDARLOS AL PDF
    public function ListarPDF()
    {
        $bitacoras = DB::table('bitacora_articulos')
        ->orderBy('id_bitacora','desc')->get();

        $cont=Bitacora::count();

        $pdf = \PDF::loadview('pdf.bitacora_articulos',['bitacoras'=>$bitacoras,'cont'=>$cont]);
        return $pdf->download('bitacora_articulos.pdf');
    }
    // FIN DE LA FUNCION 
    
    public function show($id_bitacora) 
    {
        return view("bitacoras.show",["bitacoras"=>Bitacoras::findOrFail($id_bitacora)]);
    }

    public function edit($id_bitacora)
    {
        return view("bitacoras.edit",["bitacoras"=>Bitacora::findOrFail($id_bitacora)]);
    }

}
