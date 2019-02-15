<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrance;

class EntranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        return view('entradas');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
