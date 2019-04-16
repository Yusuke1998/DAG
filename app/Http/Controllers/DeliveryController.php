<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $salidas = Delivery::create($request->all());
        return Response()->json($salidas);
    }

    public function cantidad(Request $request){

        $entrada = Entrance::where('product_id',$request->producto)->sum('quantity');
        $salida = Delivery::where('product_id',$request->producto)->sum('quantity');

        $producto = Product::find($request->producto);

        $cantidad = $producto->quantity + $entrada - $salida;

        return Response()->json($cantidad);
    }

    public function show(Delivery $salidas)
    {
        //
    }

    public function edit(Delivery $delivery)
    {
        //
    }

    public function editar($id){
        $salida = Delivery::find($id);
        return Response()->json($salida);
    }

    public function update(Request $request, $id)
    {
        $edit = Delivery::find($id)->update($request->all());
        return Response()->json($edit);
    }

    public function destroy(Delivery $delivery)
    {
        //
    }

    public function eliminar($id)
    {
        $salida = Delivery::find($id)->delete();
    }
}
