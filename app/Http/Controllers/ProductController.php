<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
        // $data = Request::validate(
        //     [
        //         'code'              =>  'required|min:4|max:10',
        //         'name'              =>  'required|min:4|max:10',
        //         'description'       =>  'max:150',
        //         'unity_m'           =>  'required',
        //         'date_maturity'     =>  'required',
        //     ]
        //     ,
        //     [
        //         'code.required'     =>  'El codigo es requerido'
        //     ]);
        if ($productos = Product::create($request->all())) {
            return Response()->json($productos);
        }
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
