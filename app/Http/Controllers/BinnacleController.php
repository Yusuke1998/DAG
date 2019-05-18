<?php

namespace App\Http\Controllers;

use App\Binnacle;
use Illuminate\Http\Request;

class BinnacleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bitacoras = Binnacle::all();
        return view('bitacora.index',compact('bitacoras'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Binnacle $binnacle)
    {
        //
    }

    public function edit(Binnacle $binnacle)
    {
        //
    }

    public function update(Request $request, Binnacle $binnacle)
    {
        //
    }

    public function destroy(Binnacle $binnacle)
    {
        //
    }
}
