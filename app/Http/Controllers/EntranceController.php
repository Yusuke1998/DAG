<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Binnacle;
use App\Entrance;
use App\Product;

class EntranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entradas = Entrance::all();
        $productos = Product::all();
        return view('entradas',compact('entradas','productos'));
    }

    public function editar($id){
        $entrada = Entrance::find($id);
        return Response()->json($entrada);
    }

    public function update(Request $request, $id)
    {
        $edit = Entrance::find($id);
        $producto = $edit->product->name;
        $recibe = $edit->reception;
        $cantidad = $edit->quantity;
        $unidad = $edit->unity_m;
        $edit->update($request->all());

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Entrada, '.$producto.' recibe: '.$recibe.' cantidad: '.$cantidad.$unidad.'  editada exitosamente!',
            'small_description' =>  'Edicion de entrada',
            'date'              =>  Carbon::now(),
        ]);
    }

    public function eliminar($id){
        $entrada = Entrance::find($id);
        $producto = $entrada->product->name;
        $recibe = $entrada->reception;
        $cantidad = $entrada->quantity;
        $unidad = $entrada->unity_m;
        $entrada->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Entrada, '.$producto.' recibe: '.$recibe.' cantidad: '.$cantidad.$unidad.'  eliminada exitosamente!',
            'small_description' =>  'Nuevo registro de entrada',
            'date'              =>  Carbon::now(),
        ]);
    }

    public function store(Request $request)
    {
        $entradas = Entrance::create($request->all());
        $producto = $entradas->product->name;
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva entrada, '.$producto.' recibe: '.$entradas->reception.' cantidad: '.$entradas->quantity.$entradas->unity_m.'  agregado exitosamente!',
            'small_description' =>  'Nuevo registro de entrada',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($entradas);
    }

}
