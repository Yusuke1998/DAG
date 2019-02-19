<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $salidas = Delivery::all();
        return view('salidas')->with('salidas',$salidas);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Delivery $delivery)
    {
        //
    }

    public function edit(Delivery $delivery)
    {
        //
    }

    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    public function destroy(Delivery $delivery)
    {
        //
    }
}
