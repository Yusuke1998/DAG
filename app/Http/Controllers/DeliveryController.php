<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
use App\Product;
use App\Area;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
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
