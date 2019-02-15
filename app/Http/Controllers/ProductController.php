<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
        $productos = productos::create($request->all());

        return response()->json($productos);
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
