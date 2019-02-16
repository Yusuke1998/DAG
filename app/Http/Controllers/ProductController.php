<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $nameImage = 'producto'.time().'.'.$file->getClientOriginalExtension();
        //     $path = public_path().'\productos';
        //     $file->move($path,$nameImage);
        // }else{
        //     $nameImage = $request->image;
        // }

        $data = request()->validate(
            [
                'code'              =>  'required|min:4|max:100',
                'name'              =>  'required|min:4|max:100',
                'description'       =>  'max:150|min:4|max:100',
                'unity_m'           =>  'required',
                'date_maturity'     =>  'required',
            ]
            ,
            [
                'code.required'             =>  'El codigo es requerido',
                'name.required'             =>  'El nombre es requerido',
                'unity_m.required'          =>  'La unidad de medida es requerida',
                'date_maturity.required'    =>  'La fecha de vencimiento es requerida',
                'description.max'           =>  'La descripcion es muy larga',
                'description.min'           =>  'La descripcion es muy corta',
                'code.max'                  =>  'El codigo es muy largo',
                'code.min'                  =>  'El codigo es muy corto',
                'name.max'                  =>  'El nombre es muy largo',
                'name.min'                  =>  'El nombre es muy corto',

            ]);

        // $productos = Product::create([
        //     'code'              =>  $data['code'],
        //     'name'              =>  $data['name'],
        //     'description'       =>  $data['description'],
        //     'unity_m'           =>  $data['unity_m'],
        //     'date_maturity'     =>  $data['date_maturity'],
        // ]);

        if ($productos = Product::create($data)) {

            return Response()->json($productos);
        }
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

    public function editar($id)
    {
        return view('productos.edit');
    }

    public function update(Request $request, $id)
    {
        //
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
}
