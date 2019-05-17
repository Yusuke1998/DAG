<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Product;
use App\Shopping;
use App\Entrance;
use App\Delivery;

class ReportesController extends Controller
{
    public function index(){
        return view('reportes.index');
    }

// PDF
    public function pdf_general(){
        $productos = Product::all();

        $pdf = PDF::loadView('reportes.general', compact('productos'));
        return $pdf->stream('reporte_general.pdf');
    }

    public function pdf_producto_id($id){
        $producto = Product::find($id);

        $pdf = PDF::loadView('reportes.producto', compact('producto'));
        return $pdf->stream('reporte_producto.pdf');
    }

    public function pdf_anio($type){
        $fecha = Carbon::now()->format('Y');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereYear('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_anio.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereYear('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_anio.pdf');
        }
    }

    public function pdf_mes($type){
        $fecha = Carbon::now()->format('m');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereMonth('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_mes.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereMonth('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_mes.pdf');
        }
    }

    public function pdf_dia($type){
        $fecha = Carbon::now()->format('Y-m-d');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereDate('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_dia.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereDate('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_dia.pdf');
        }
    }

// EXCEL
    public function excel_general(){

        Excel::create('reportes_productos', function($excel) {
            $excel->sheet('DGA', function($sheet) {
                $productos = Product::all();    
                $sheet->row(1, [
                    'Codigo','Nombre','Tipo','Descripcion','Presentacion','Cantidad','Fecha de vencimiento','Inicial','Entradas/Cantidad','Salidas/Cantidad','Existencias',
                ]);

                foreach ($productos as $index => $producto) {
                    $sheet->row($index+2, [
                        $producto->code, 
                        $producto->name, 
                        $producto->type, 
                        $producto->description, 
                        $producto->unity_m, 
                        $producto->quantity, 
                        $producto->date_maturity,
                        $producto->quantity,

                        $producto->entrances()->count('quantity')."/".$producto->entrances()->sum('quantity'),
                        $producto->deliverys()->count('quantity')."/".$producto->deliverys()->sum('quantity'),

                        $producto->quantity+
                        $producto->entrances()->sum('quantity')-
                        $producto->deliverys()->sum('quantity')
                    ]);
                }
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    public function excel_producto_id($id){
        Excel::create('reportes_producto', function($excel) use($id) {
            $excel->sheet('DGA', function($sheet) use($id) {
                $producto = Product::find($id);
                $sheet->row(1, [
                    'Codigo','Nombre','Tipo','Descripcion','Presentacion','Cantidad','Fecha de vencimiento',
                ]);
                $sheet->row(2, [
                        $producto->code, $producto->name, $producto->type, $producto->description, $producto->unity_m, $producto->quantity, $producto->date_maturity
                ]);
                $sheet->row(3, [
                    'Entradas/Cantidad','Salidas/Cantidad','Existencias',
                ]);
                $sheet->row(4, [
                    $producto->entrances->count('quantity')."/".$producto->entrances->sum('quantity'),
                    $producto->deliverys->count('quantity')."/".$producto->deliverys->sum('quantity'),
                    $producto->quantity+
                    $producto->entrances()->sum('quantity')-
                    $producto->deliverys()->sum('quantity')." ".$producto->unity_m
                ]);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    public function excel_anio($type){
        $fecha = Carbon::now()->format('Y');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereYear('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_anio.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereYear('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_anio.pdf');
        }
    }

    public function excel_mes($type){
        $fecha = Carbon::now()->format('m');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereMonth('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_mes.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereMonth('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_mes.pdf');
        }
    }

    public function excel_dia($type){
        $fecha = Carbon::now()->format('Y-m-d');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereDate('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_dia.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereDate('created_at', '=', $fecha)->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_dia.pdf');
        }
    }

    public function reporte_entradas($fecha,$tipo,$formato){
        if ($fecha == 'Dia') {
            $fecha = Carbon::now()->format('Y-m-d');
            $entradas = Entrance::whereDate('date', '=', $fecha)->get();
        }elseif ($fecha == 'Mes') {
            $fecha = Carbon::now()->format('m');
            $entradas = Entrance::whereMonth('created_at','=',$fecha)->get();
        }elseif ($fecha == 'Anio') {
            $fecha = Carbon::now()->format('Y');
            $entradas = Entrance::whereYear('created_at','=',$fecha)->get();
        }

        if ($formato == 'PDF') {
            $pdf = PDF::loadView('reportes.reporte-entrada-fecha', compact('entradas','fecha','tipo'));
            return $pdf->stream('reporte_entradas.pdf');
        }else{
            // EXCEL
        }
    }

    public function reporte_salidas($fecha,$tipo,$formato){
        if ($fecha == 'Dia') {
            $fecha = Carbon::now()->format('Y-m-d');
            $salidas = Delivery::whereDate('date', '=', $fecha)->get();
        }elseif ($fecha == 'Mes') {
            $fecha = Carbon::now()->format('m');
            $salidas = Delivery::whereMonth('created_at','=',$fecha)->get();
        }elseif ($fecha == 'Anio') {
            $fecha = Carbon::now()->format('Y');
            $salidas = Delivery::whereYear('created_at','=',$fecha)->get();
        }

        if ($formato == 'PDF') {
            $pdf = PDF::loadView('reportes.reporte-salida-fecha', compact('salidas','fecha','tipo'));
            return $pdf->stream('reporte_salidas.pdf');
        }else{
            // EXCEL
        }
    }

}
