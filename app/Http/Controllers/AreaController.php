<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Area $area)
    {
        //
    }

    public function edit(Area $area)
    {
        //
    }

    public function update(Request $request, Area $area)
    {
        //
    }

    public function destroy(Area $area)
    {
        //
    }
}
