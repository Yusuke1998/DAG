<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Product;
use App\Shopping;
use App\Entrance;
use App\Delivery;
use Yajra\Datatables\Services\DataTable;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $productos = Product::all();
        return view('productos.index')->with('productos',$productos);
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        // $data = request()->validate(
        //     [
        //         'code'              =>  'required|min:4|max:100',
        //         'name'              =>  'required|min:4|max:100',
        //         'description'       =>  'max:150|min:4|max:100',
        //         'unity_m'           =>  'required',
        //         'quantity'          =>  'required',
        //         'date_maturity'     =>  'required',
        //     ]
        //     ,
        //     [
        //         'code.required'             =>  'El codigo es requerido',
        //         'quantity.required'         =>  'La cantidad es requerida',
        //         'name.required'             =>  'El nombre es requerido',
        //         'unity_m.required'          =>  'La unidad de medida es requerida',
        //         'date_maturity.required'    =>  'La fecha de vencimiento es requerida',
        //         'description.max'           =>  'La descripcion es muy larga',
        //         'description.min'           =>  'La descripcion es muy corta',
        //         'code.max'                  =>  'El codigo es muy largo',
        //         'code.min'                  =>  'El codigo es muy corto',
        //         'name.max'                  =>  'El nombre es muy largo',
        //         'name.min'                  =>  'El nombre es muy corto',

        //     ]);

        // if ($productos = Product::create($data)) {
        //     return Response()->json($productos);
        // }

        // FLECHAS --->

        $producto = Product::create([
            'code'              =>  $request->code,
            'name'              =>  $request->name,
            'description'       =>  $request->description,
            'unity_m'           =>  $request->unity_m,
            'quantity'          =>  $request->quantity,
            'date_maturity'     =>  $request->date_maturity,
        ]);

        $compra = Shopping::create([
            'date'          =>  $request->date,
            'supplier'      =>  $request->supplier,
            'price'         =>  $request->price,
            'quantity'      =>  $request->quantity,
            'product_id'    =>  $producto->id,
        ]);

        return Response()->json($compra);

    }

    public function charts()
    {
        $productos  = Product::all()->count();
        $entradas   = Entrance::all()->count();
        $salidas    = Delivery::all()->count();
        $consolidado = $productos+$entradas-$salidas;

        $data = [$productos,$entradas,$salidas,$consolidado];

        return Response()->json($data);
    }

    public function show($id)
    {
        return view('productos.show');
    }

    public function edit($id)
    {
        return view('productos.edit');
    }

    public function ajax_editar($id){
        $producto = Product::find($id);
        return Response()->json($producto);

    }

    public function editar($id)
    {
        return view('productos.edit');
    }

    public function update(Request $request, $id)
    {
        $edit = Product::find($id);
        $update = $edit->update($request->all());
        return Response::json($update);
    }

    public function pdf_general(){
        $productos = Product::all();

        $pdf = PDF::loadView('reportes.general', compact('productos'));
        return $pdf->stream('reporte_general.pdf');
    }

    public function pdf_productos(){
        $productos = Product::all();

        $pdf = PDF::loadView('reportes.productos', compact('productos'));
        return $pdf->stream('reporte_productos.pdf');
    }

    public function pdf_producto_id($id){
        $producto = Product::find($id);

        $pdf = PDF::loadView('reportes.producto', compact('producto'));
        return $pdf->stream('reporte_producto.pdf');
    }

    public function entradas($id)
    {
        $data = Product::find($id)->entrances()->get();
        if($data == '[]'){
                return Response()->json(['info'=>'No hay datos']);
        }
        else
        {
            return Response()->json($data->all());
        }
    }

    public function salidas($id)
    {
        $data = Product::find($id)->deliverys()->get();
        if($data == '[]'){
                return Response()->json(['info'=>'No hay datos']);
        }
        else
        {
            return Response()->json($data->all());
        }
    }

    public function destroy($id)
    {
        //
    }

    public function eliminar($id)
    {
        $producto = Product::find($id)->delete();
        return back();
    }

    public function entradas_tabla(){
        $model = Entrance::all();
        return datatables($model)->toJson();
    }

    public function salidas_tabla(){
        $model = Delivery::all();
        return datatables($model)->toJson();
    }
}
