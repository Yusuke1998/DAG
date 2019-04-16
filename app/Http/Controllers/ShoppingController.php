<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shopping;

class ShoppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Shopping $shopping)
    {
        //
    }

    public function edit(Shopping $shopping)
    {
        //
    }

    public function update(Request $request, Shopping $shopping)
    {
        //
    }

    public function destroy(Shopping $shopping)
    {
        //
    }
}
