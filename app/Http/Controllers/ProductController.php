<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('productos.index');
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('productos.show');
    }

    public function edit($id)
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
}
