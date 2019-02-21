<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Delivery;
use App\Entrance;
use App\Product;
use App\Shopping;

class ConsolidatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){

        return view('consolidados');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function charts_entradas()
    {
        $enero = DB::table('entrances')->whereMonth('created_at', '01')->count();
        $febrero = DB::table('entrances')->whereMonth('created_at', '02')->count();
        $marzo = DB::table('entrances')->whereMonth('created_at', '03')->count();
        $abril = DB::table('entrances')->whereMonth('created_at', '04')->count();
        $mayo = DB::table('entrances')->whereMonth('created_at', '05')->count();
        $junio = DB::table('entrances')->whereMonth('created_at', '06')->count();
        $julio = DB::table('entrances')->whereMonth('created_at', '07')->count();
        $agosto = DB::table('entrances')->whereMonth('created_at', '08')->count();
        $septiembre= DB::table('entrances')->whereMonth('created_at', '09')->count();
        $octubre = DB::table('entrances')->whereMonth('created_at', '10')->count();
        $noviembre = DB::table('entrances')->whereMonth('created_at', '11')->count();
        $diciembre = DB::table('entrances')->whereMonth('created_at', '12')->count();

        $data = [$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre];

        return Response()->json($data);
    }

    public function charts_salidas()
    {
        $enero = DB::table('deliveries')->whereMonth('created_at', '01')->count();
        $febrero = DB::table('deliveries')->whereMonth('created_at', '02')->count();
        $marzo = DB::table('deliveries')->whereMonth('created_at', '03')->count();
        $abril = DB::table('deliveries')->whereMonth('created_at', '04')->count();
        $mayo = DB::table('deliveries')->whereMonth('created_at', '05')->count();
        $junio = DB::table('deliveries')->whereMonth('created_at', '06')->count();
        $julio = DB::table('deliveries')->whereMonth('created_at', '07')->count();
        $agosto = DB::table('deliveries')->whereMonth('created_at', '08')->count();
        $septiembre= DB::table('deliveries')->whereMonth('created_at', '09')->count();
        $octubre = DB::table('deliveries')->whereMonth('created_at', '10')->count();
        $noviembre = DB::table('deliveries')->whereMonth('created_at', '11')->count();
        $diciembre = DB::table('deliveries')->whereMonth('created_at', '12')->count();

        $data = [$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre];

        return Response()->json($data);
    }
}
