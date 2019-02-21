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

    public function charts_entradas_salidas()
    {
        $enero_e = DB::table('entrances')->whereMonth('date', '01')->count();
        $febrero_e = DB::table('entrances')->whereMonth('date', '02')->count();
        $marzo_e = DB::table('entrances')->whereMonth('date', '03')->count();
        $abril_e = DB::table('entrances')->whereMonth('date', '04')->count();
        $mayo_e = DB::table('entrances')->whereMonth('date', '05')->count();
        $junio_e = DB::table('entrances')->whereMonth('date', '06')->count();
        $julio_e = DB::table('entrances')->whereMonth('date', '07')->count();
        $agosto_e = DB::table('entrances')->whereMonth('date', '08')->count();
        $septiembre_e= DB::table('entrances')->whereMonth('date', '09')->count();
        $octubre_e = DB::table('entrances')->whereMonth('date', '10')->count();
        $noviembre_e = DB::table('entrances')->whereMonth('date', '11')->count();
        $diciembre_e = DB::table('entrances')->whereMonth('date', '12')->count();
        $datae = [$enero_e,$febrero_e,$marzo_e,$abril_e,$mayo_e,$junio_e,$julio_e,$agosto_e,$septiembre_e,$octubre_e,$noviembre_e,$diciembre_e];

        $enero_s = DB::table('deliveries')->whereMonth('date', '01')->count();
        $febrero_s = DB::table('deliveries')->whereMonth('date', '02')->count();
        $marzo_s = DB::table('deliveries')->whereMonth('date', '03')->count();
        $abril_s = DB::table('deliveries')->whereMonth('date', '04')->count();
        $mayo_s = DB::table('deliveries')->whereMonth('date', '05')->count();
        $junio_s = DB::table('deliveries')->whereMonth('date', '06')->count();
        $julio_s = DB::table('deliveries')->whereMonth('date', '07')->count();
        $agosto_s = DB::table('deliveries')->whereMonth('date', '08')->count();
        $septiembre_s= DB::table('deliveries')->whereMonth('date', '09')->count();
        $octubre_s = DB::table('deliveries')->whereMonth('date', '10')->count();
        $noviembre_s = DB::table('deliveries')->whereMonth('date', '11')->count();
        $diciembre_s = DB::table('deliveries')->whereMonth('date', '12')->count();
        $datas = [$enero_s,$febrero_s,$marzo_s,$abril_s,$mayo_s,$junio_s,$julio_s,$agosto_s,$septiembre_s,$octubre_s,$noviembre_s,$diciembre_s];

        return Response()->json(['entradas'=>$datae,'salidas'=>$datas]);
    }
}
