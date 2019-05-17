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
        $areas = Area::all();
        return view('areas.index',compact('areas',$areas));
    }

    public function store(Request $request)
    {
        $areas = Area::create($request->all());
        return Response()->json($areas);
    }

    public function editar($id)
    {
        $area = Area::find($id);
        return Response()->json($area);
    }

    public function update(Request $request, $id)
    {
        $edit = Area::find($id)->update($request->all());
        return Response()->json($edit);
    }

    public function destroy($id)
    {
        $area = Area::find($id)->delete();
        return back();
    }
}
