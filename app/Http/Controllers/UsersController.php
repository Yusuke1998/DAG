<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Services\DataTable;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index',compact('usuarios'));
    }

    public function userTable()
    {
        $model = User::all();
        // $model=["info"=>"No funciona"];
        // return DataTable($model)->toJson();
        return $model;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $usuarios = User::create($request->all());
        return Response()->json($usuarios);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
        $usuario = User::find($id)->delete();
    }
}
