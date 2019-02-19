<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrance;
use App\Product;

class EntranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $entradas = Entrance::all();
        $productos = Product::all();
        return view('entradas',compact('entradas','productos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $entradas = Entrance::create($request->all());

        return Response()->json($entradas);
        // return Response()->json($request->all());
    }

    public function show(Entrance $entrance)
    {
        //
    }

    public function edit(Entrance $entrance)
    {
        //
    }

    public function update(Request $request, Entrance $entrance)
    {
        //
    }

    public function destroy(Entrance $entrance)
    {
        //
    }
}
