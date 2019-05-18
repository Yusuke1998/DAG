<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Area;
use App\Binnacle;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $areas = Area::all();
        return view('areas.index',compact('areas',$areas));
    }

    public function store(Request $request)
    {
        $area = Area::create($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva area '.$area->name.' agregada exitosamente!',
            'small_description' =>  'Nueva area registrada',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($area);
    }

    public function editar($id)
    {
        $area = Area::find($id);
        return Response()->json($area);
    }

    public function update(Request $request, $id)
    {
        $edit = Area::find($id)->update($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Area '.$area->name.' editada exitosamente!',
            'small_description' =>  'Edicion de area',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($edit);
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $name = $area->name;
        $area->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Area '.$name.' eliminada exitosamente!',
            'small_description' =>  'Eliminacion de area',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }
}
