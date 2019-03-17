<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Product;
use App\Shopping;
use App\Entrance;
use App\Delivery;
use Yajra\Datatables\Services\DataTable;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $data = request()->validate(
            [
                'code'              =>  'required',
                'name'              =>  'required',
                'description'       =>  'max:150',
                'unity_m'           =>  'required',
                'quantity'          =>  'required',
                'date_maturity'     =>  'required',
                'date'              =>  'required',
                'supplier'          =>  'required',
                'price'             =>  'required',
            ]);

        // if ($productos = Product::create($data)) {
        //     return Response()->json($productos);
        // }

        // FLECHAS --->

        $producto = Product::create([
            'code'              =>  $data['code'],
            'name'              =>  $data['name'],
            'description'       =>  $data['description'],
            'unity_m'           =>  $data['unity_m'],
            'quantity'          =>  $data['quantity'],
            'date_maturity'     =>  $data['date_maturity'],
        ]);

        $compra = Shopping::create([
            'date'          =>  $data['date'],
            'supplier'      =>  $data['supplier'],
            'price'         =>  $data['price'],
            'quantity'      =>  $data['quantity'],
            'product_id'    =>  $producto->id,
        ]);

        return Response()->json($compra->all());

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
        $data = Product::select('products.code', 'products.name', 'products.description',
                                'products.unity_m', 'products.quantity', 'products.date_maturity',
                                'shoppings.date', 'shoppings.supplier', 'shoppings.price',
                                'shoppings.quantity')
                ->join('shoppings', 'products.id', '=', 'shoppings.product_id')
                ->get();

        //$producto = Product::find($id);
        return Response()->json($data);

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

    public function pdf_producto_id($id){
        $producto = Product::find($id);

        $pdf = PDF::loadView('reportes.producto', compact('producto'));
        return $pdf->stream('reporte_producto.pdf');
    }

    public function excel_general(){

        Excel::create('reportes_productos', function($excel) {
            $excel->sheet('DGA', function($sheet) {
                $productos = Product::all();
                $sheet->row(1, [
                    'Codigo','Nombre','Descripcion','Unidad de medida','Cantidad','Fecha de vencimiento',
                ]);

                foreach ($productos as $index => $producto) {
                    $sheet->row($index+2, [
                        $producto->code, $producto->name, $producto->description, $producto->unity_m, $producto->quantity, $producto->date_maturity
                    ]);
                }
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    public function excel_producto_id($id){
        Excel::create('reportes_producto', function($excel) use($id) {
            $excel->sheet('DGA', function($sheet) use($id) {
                $producto = Product::find($id);
                $sheet->row(1, [
                    'Codigo','Nombre','Descripcion','Unidad de medida','Cantidad','Fecha de vencimiento',
                ]);
                $sheet->row(2, [
                        $producto->code, $producto->name, $producto->description, $producto->unity_m, $producto->quantity, $producto->date_maturity
                ]);
                $sheet->row(3, [
                    'Entradas','Salidas',
                ]);
                $sheet->row(4, [
                    $producto->entrances->count(),$producto->deliverys->count(),
                ]);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
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
