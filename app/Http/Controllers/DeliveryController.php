<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Binnacle;
use App\Delivery;
use App\Entrance;
use App\Product;
use App\Area;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $salidas = Delivery::all();
        $productos = Product::all();
        $areas = Area::all();
        return view('salidas',compact('salidas','productos','areas'));
    }

    public function store(Request $request)
    {
        $salidas = Delivery::create($request->all());
        $producto = $salidas->product->name;
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva salida, '.$producto.' entrega: '.$salidas->functionary_e.', recibe: '.$salidas->functionary_r.', cantidad: '.$salidas->quantity.$salidas->unity_m.'  agregada exitosamente!',
            'small_description' =>  'Nuevo registro de salida',
            'date'              =>  Carbon::now(),
        ]);

        return Response()->json($salidas);
    }

    public function cantidad(Request $request){

        $entrada = Entrance::where('product_id',$request->producto)->sum('quantity');
        $salida = Delivery::where('product_id',$request->producto)->sum('quantity');
        $producto = Product::find($request->producto);
        $cantidad = $producto->quantity + $entrada - $salida;

        return Response()->json($cantidad);
    }

    public function editar($id){
        $salida = Delivery::find($id);
        return Response()->json($salida);
    }

    public function update(Request $request, $id)
    {
        $edit = Delivery::find($id);
        $producto = $edit->product->name;
        $unidad = $edit->unity_m;
        $recibe = $edit->functionary_r;
        $entrega = $edit->functionary_e;
        $cantidad = $edit->quantity;
        $edit->update($request->all());

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Salida, '.$producto.' entrega: '.$entrega.', recibe: '.$recibe.', cantidad: '.$cantidad.$unidad.'  editada exitosamente!',
            'small_description' =>  'Edicion de salida',
            'date'              =>  Carbon::now(),
        ]);

        return Response()->json($edit);
    }

    public function eliminar($id)
    {
        $salida = Delivery::find($id);
        $producto = $salida->product->name;
        $unidad = $salida->unity_m;
        $recibe = $salida->functionary_r;
        $entrega = $salida->functionary_e;
        $cantidad = $salida->quantity;
        $salida->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Salida, '.$producto.' entrega: '.$entrega.', recibe: '.$recibe.', cantidad: '.$cantidad.$unidad.'  eliminada exitosamente!',
            'small_description' =>  'Eliminacion de salida',
            'date'              =>  Carbon::now(),
        ]);
    }
}
