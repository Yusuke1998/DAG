<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Product;
use App\Shopping;
use App\Entrance;
use App\Binnacle;
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
            'unity_m'       =>  $data['unity_m'],
            'price'         =>  $data['price'],
            'quantity'      =>  $data['quantity'],
            'product_id'    =>  $producto->id,
        ]);

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo producto '.$producto->name.' cantidad: '.$producto->quantity.$producto->unity_m.'  agregado exitosamente!',
            'small_description' =>  'Nuevo registro de producto',
            'date'              =>  Carbon::now(),
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
        $producto = Product::find($id);
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Edicion de producto '.$producto->name.' cantidad: '.$producto->quantity.$producto->unity_m.'  editado exitosamente!',
            'small_description' =>  'Edicion de producto',
            'date'              =>  Carbon::now(),
        ]);
        $edit = Product::find($id)->update($request->all());
        $edit2 = Shopping::where('product_id',$id)->update($request->all());
        return json_encode($request);
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
        $producto = Product::find($id);
        $name = $producto->name;
        $producto->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Producto '.$name.' eliminado exitosamente!',
            'small_description' =>  'Eliminacion de producto',
            'date'              =>  Carbon::now(),
        ]);
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

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva comida '.$comida->name.' cantidad: '.$comida->quantity.$comida->unity_m.'  agregada exitosamente!',
            'small_description' =>  'Nuevo registro de comida',
            'date'              =>  Carbon::now(),
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

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Edicion de comida '.$comida->name.' cantidad: '.$comida->quantity.$comida->unity_m.'  editado exitosamente!',
            'small_description' =>  'Edicion de producto',
            'date'              =>  Carbon::now(),
        ]);

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
        $producto = Product::find($id);
        $name = $producto->name;
        $producto->delete();
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Comida '.$name.' eliminada exitosamente!',
            'small_description' =>  'Eliminacion de comida',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }

    // Comida

}
