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
                'type'              =>  'required',
                'description'       =>  'max:150',
                'unity_m'           =>  'required',
                'quantity'          =>  'required',
                'date_maturity'     =>  'required',
                'date'              =>  'required',
                'supplier'          =>  'required',
                'price'             =>  'required',
            ]);

        $producto = Product::create([
            'code'              =>  $data['code'],
            'name'              =>  $data['name'],
            'type'              =>  $data['type'],
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

    public function edit($id)
    {
        return view('productos.edit');
    }

    public function show($id)
    {
        return $id;
    }

    public function ajax_editar($id){

        $producto = Product::find($id);
        $compra = $producto->shoppings()->first();
        $data = [
            'code'          =>  $producto->code,
            'name'          =>  $producto->name,
            'type'          =>  $producto->type,
            'description'   =>  $producto->description,
            'unity_m'       =>  $producto->unity_m,
            'date_maturity' =>  $producto->date_maturity,
            'quantity'      =>  $producto->quantity,
            'supplier'      =>  ($compra)?$compra->supplier:'',
            'price'         =>  ($compra)?$compra->price:'',
        ];

        return Response()->json($data);
    }

    public function editar($id)
    {
        return view('productos.edit');
    }

    public function update(Request $request, $id)
    {
        $edit = Product::find($id)->update($request->all());
        $edit2 = Shopping::where('product_id',$id)->update($request->all());
        return json_encode($request);
    }

    public function pdf_general(){
        $productos = Product::all();
        $entrances = Entrance::all();
        $salidas   = Delivery::all();

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
                    'Codigo','Nombre','Tipo','Descripcion','Presentacion','Cantidad','Fecha de vencimiento','Inicial','Entradas/Cantidad','Salidas/Cantidad','Existencias',
                ]);

                foreach ($productos as $index => $producto) {
                    $sheet->row($index+2, [
                        $producto->code, 
                        $producto->name, 
                        $producto->type, 
                        $producto->description, 
                        $producto->unity_m, 
                        $producto->quantity, 
                        $producto->date_maturity,
                        $producto->quantity,

                        $producto->entrances()->count('quantity')."/".$producto->entrances()->sum('quantity'),
                        $producto->deliverys()->count('quantity')."/".$producto->deliverys()->sum('quantity'),

                        $producto->quantity+
                        $producto->entrances()->sum('quantity')-
                        $producto->deliverys()->sum('quantity')
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
                    'Codigo','Nombre','Tipo','Descripcion','Presentacion','Cantidad','Fecha de vencimiento',
                ]);
                $sheet->row(2, [
                        $producto->code, $producto->name, $producto->type, $producto->description, $producto->unity_m, $producto->quantity, $producto->date_maturity
                ]);
                $sheet->row(3, [
                    'Entradas/Cantidad','Salidas/Cantidad','Existencias',
                ]);
                $sheet->row(4, [
                    $producto->entrances->count('quantity')."/".$producto->entrances->sum('quantity'),
                    $producto->deliverys->count('quantity')."/".$producto->deliverys->sum('quantity'),
                    $producto->quantity+
                    $producto->entrances()->sum('quantity')-
                    $producto->deliverys()->sum('quantity')." ".$producto->unity_m
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

    // Comida
    public function comida_index(){
        $comidas = Product::where('type','Comida')->get();
        return view('comida.index',compact('comidas',$comidas));
    }

    public function comida_store(Request $request){
        $data = [
            'code'          =>  $request->code,
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'unity_m'       =>  $request->unity_m,
            'date'          =>  $request->date,
            'date_maturity' =>  $request->date_maturity,
            'quantity'      =>  $request->quantity,
            'supplier'      =>  $request->supplier,
            'price'         =>  $request->price,
        ];

        $comida = Product::create([
            'code'           => $data['code'],
            'name'           => $data['name'],
            'description'    => $data['description'],
            'type'           => 'Comida',
            'unity_m'        => $data['unity_m'],
            'date_maturity'  => $data['date_maturity'],
            'quantity'       => $data['quantity'],
        ]);

        $compra = Shopping::create([
            'date'       => $data['date'],
            'supplier'   => $data['supplier'],
            'price'      => $data['price'],
            'unity_m'    => $data['unity_m'],
            'quantity'   => $data['quantity'],
            'product_id' => $comida->id,
        ]);

        return Response()->json($data);
    }

    public function comida_editar($id){

        $producto = Product::find($id);
        $compra = $producto->shoppings()->first();
        $data = [
            'code'          =>  $producto->code,
            'name'          =>  $producto->name,
            'type'          =>  $producto->type,
            'description'   =>  $producto->description,
            'unity_m'       =>  $producto->unity_m,
            'date_maturity' =>  $producto->date_maturity,
            'quantity'      =>  $producto->quantity,
            'supplier'      =>  ($compra)?$compra->supplier:'',
            'price'         =>  ($compra)?$compra->price:'',
        ];
        return Response()->json($data);
    }

    public function comida_update(Request $request, $id){

        $data = [
            'code'          =>  $request->code,
            'name'          =>  $request->name,
            'type'          =>  'Comida',
            'description'   =>  $request->description,
            'unity_m'       =>  $request->unity_m,
            'date_maturity' =>  $request->date_maturity,
            'date'          =>  $request->date,
            'supplier'      =>  $request->supplier,
            'price'         =>  $request->price,
            'quantity'      =>  $request->quantity,
            'product_id'    =>  $id
        ];

        $comida = Product::find($id);
        $comida->code           = $data['code'];
        $comida->name           = $data['name'];
        $comida->description    = $data['description'];
        $comida->type           = $data['type'];
        $comida->unity_m        = $data['unity_m'];
        $comida->date_maturity  = $data['date_maturity'];
        $comida->quantity       = $data['quantity'];
        $comida->save();

        if(!$comida->shoppings){
            $compra = new Shopping();
            $compra->unity_m    = $data['unity_m'];
            $compra->date       = $data['date'];
            $compra->supplier   = $data['supplier'];
            $compra->price      = $data['price'];
            $compra->quantity   = $data['quantity'];
            $compra->product_id = $data['product_id'];
            $compra->save();
        }else{
            $compra = Shopping::where('product_id',$id)->update([
                'date'       => $data['date'],
                'supplier'   => $data['supplier'],
                'price'      => $data['price'],
                'unity_m'    => $data['unity_m'],
                'quantity'   => $data['quantity'],
                'product_id' => $data['product_id'],
            ]);
        }
        return json_encode(compact('data1','data2'));
    }

    public function comida_destroy($id){
        $producto = Product::find($id)->delete();
        return back();
    }
    // Comida
}
