<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Binnacle;
use Yajra\Datatables\Services\DataTable;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index',compact('usuarios'));
    }

    public function userTable()
    {
        $model = User::all();
        return $model;
    }

    public function store(Request $request)
    {
        $usuarios = User::create([
            'name'      =>  $request->name,
            'type'      =>  $request->type,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo usuario '.$usuarios->name.' / '.$usuarios->email.' / '.$usuarios->type.' agregado exitosamente!',
            'small_description' =>  'Nuevo registro de usuario',
            'date'              =>  Carbon::now(),
        ]);

        return Response()->json($usuarios);
    }

    public function eliminar($id)
    {
        $usuario = User::find($id);
        $name = $usuario->name;
        $email = $usuario->email;
        $type = $usuario->type;
        $usuario->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Usuario '.$name.' / '.$email.' / '.$type.' eliminado exitosamente!',
            'small_description' =>  'Usuario eliminado',
            'date'              =>  Carbon::now(),
        ]);
    }
}
