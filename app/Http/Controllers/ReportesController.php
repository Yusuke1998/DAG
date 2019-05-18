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
use App\Binnacle;

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

    public function pdf_general_comida(){
        $productos = Product::where('type','Comida')->get();
        $pdf = PDF::loadView('reportes.general', compact('productos'));
        return $pdf->stream('reporte_general.pdf');
    }

    public function pdf_general_otro(){
        $productos = Product::where('type','!=','Comida')->get();
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

    public function pdf_semana($type){
        $fecha = Carbon::now()->format('Y-m-d');
        $InicioSemana = Carbon::now()->startOfWeek();
        $FinSemana = Carbon::now()->endOfWeek();

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereBetween('created_at', [$InicioSemana,$FinSemana])->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_comida_semana.pdf');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereBetween('created_at', [$InicioSemana,$FinSemana])->get();

            $pdf = PDF::loadView('reportes.reporte-fecha', compact('data','fecha','type'));
            return $pdf->stream('reporte_producto_semana.pdf');
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

    public function excel_general_comida(){

        Excel::create('reportes_productos', function($excel) {
            $excel->sheet('DGA', function($sheet) {
                $productos = Product::where('type','Comida')->get();    
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

    public function excel_general_otro(){

        Excel::create('reportes_productos', function($excel) {
            $excel->sheet('DGA', function($sheet) {
                $productos = Product::where('type','!=','Comida')->get();    
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

            Excel::create('reporte_comida_año', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereYear('created_at', '=', $fecha)->get();

            Excel::create('reporte_producto_año', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }
    }

    public function excel_mes($type){
        $fecha = Carbon::now()->format('m');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereMonth('created_at', '=', $fecha)->get();

            Excel::create('reporte_comida_mes', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereMonth('created_at', '=', $fecha)->get();

            Excel::create('reporte_producto_mes', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }
    }

    public function excel_semana($type){
        $fecha = Carbon::now()->format('Y-m-d');
        $InicioSemana = Carbon::now()->startOfWeek();
        $FinSemana = Carbon::now()->endOfWeek();

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereBetween('created_at', [$InicioSemana,$FinSemana])->get();

            Excel::create('reporte_comida_semana', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereBetween('created_at', [$InicioSemana,$FinSemana])->get();

            Excel::create('reporte_producto_semana', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }
    }

    public function excel_dia($type){
        $fecha = Carbon::now()->format('Y-m-d');

        if ($type == 'Comida') {
            $data = Product::where('type','Comida')
            ->whereDate('created_at', '=', $fecha)->get();

            Excel::create('reporte_comida_dia', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }else{
            $data = Product::where('type','!=','Comida')
            ->whereDate('created_at', '=', $fecha)->get();

            Excel::create('reporte_producto_dia', function($excel) use($data, $fecha, $type){
                $excel->sheet('DAG', function($sheet) use($data, $fecha, $type){
                    $sheet->loadView('reportes.reporte-fecha-excel',
                        ['data'=>$data,'fecha'=>$fecha, 'type'=>$type]);
                });
            })->download('xls');
        }
    }

    public function reporte_entradas($fecha,$tipo,$formato){
        if ($tipo == 'Comida' && $formato == 'EXCEL') {
            $vista = 'reportes.reporte-entrada-comida-fecha-excel';
        }elseif($tipo == 'Comida' && $formato == 'PDF'){
            $vista = 'reportes.reporte-entrada-comida-fecha';
        }elseif($tipo != 'Comida' && $formato == 'EXCEL'){
            $vista = 'reportes.reporte-entrada-fecha-excel';
        }elseif($tipo != 'Comida' && $formato == 'PDF'){
            $vista = 'reportes.reporte-entrada-fecha';
        }

        if ($fecha == 'Dia') {
            $fecha = Carbon::now()->format('Y-m-d');
            $entradas = Entrance::whereDate('date', '=', $fecha)->get();
        }elseif ($fecha == 'Semana') {
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $fecha = Carbon::now()->format('m-Y');
            $entradas = Entrance::whereBetween('date', [$InicioSemana,$FinSemana])->get();
        }elseif ($fecha == 'Mes') {
            $fecha = Carbon::now()->format('m');
            $entradas = Entrance::whereMonth('date','=',$fecha)->get();
        }elseif ($fecha == 'Anio') {
            $fecha = Carbon::now()->format('Y');
            $entradas = Entrance::whereYear('date','=',$fecha)->get();
        }

        if ($formato == 'PDF') {
            $pdf = PDF::loadView($vista, compact('entradas','fecha','tipo'));
            return $pdf->stream('reporte_entradas.pdf');
        }else{
            Excel::create('reporte_entradas', function($excel) use($vista, $entradas, $fecha, $tipo){
                $excel->sheet('DAG', function($sheet) use($vista, $entradas, $fecha, $tipo){
                    $sheet->loadView($vista,
                        ['entradas'=>$entradas,'fecha'=>$fecha, 'tipo'=>$tipo]);
                });
            })->download('xls');
        }
    }

    public function reporte_salidas($fecha,$tipo,$formato){
        if ($tipo == 'Comida' && $formato == 'EXCEL') {
            $vista = 'reportes.reporte-salida-comida-fecha-excel';
        }elseif($tipo == 'Comida' && $formato == 'PDF'){
            $vista = 'reportes.reporte-salida-comida-fecha';
        }elseif($tipo != 'Comida' && $formato == 'EXCEL'){
            $vista = 'reportes.reporte-salida-fecha-excel';
        }elseif($tipo != 'Comida' && $formato == 'PDF'){
            $vista = 'reportes.reporte-salida-fecha';
        }

        if ($fecha == 'Dia') {
            $fecha = Carbon::now()->format('Y-m-d');
            $salidas = Delivery::whereDate('date', '=', $fecha)->get();
        }elseif ($fecha == 'Semana') {
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $fecha = Carbon::now()->format('m-Y');
            $salidas = Delivery::whereBetween('date', [$InicioSemana,$FinSemana])->get();
        }elseif ($fecha == 'Mes') {
            $fecha = Carbon::now()->format('m');
            $salidas = Delivery::whereMonth('date','=',$fecha)->get();
        }elseif ($fecha == 'Anio') {
            $fecha = Carbon::now()->format('Y');
            $salidas = Delivery::whereYear('date','=',$fecha)->get();
        }

        if ($formato == 'PDF') {
            $pdf = PDF::loadView($vista, compact('salidas','fecha','tipo'));
            return $pdf->stream('reporte_salidas.pdf');

        }else{
            Excel::create('reporte_salidas', function($excel) use($vista, $salidas, $fecha, $tipo){
                $excel->sheet('DAG', function($sheet) use($vista, $salidas, $fecha, $tipo){
                    $sheet->loadView($vista,
                        ['salidas'=>$salidas,'fecha'=>$fecha, 'tipo'=>$tipo]);
                });
            })->download('xls');
        }
    }

    public function bitacora_pdf($tipo){
        switch ($tipo) {
            case 'todo':
            $bitacoras = Binnacle::all();
                break;
            case 'dia':
            $fecha = Carbon::now()->format('Y-m-d');
            $bitacoras = Binnacle::whereDate('date', '=', $fecha)->get();
                break;
            case 'semana':
            $InicioSemana = Carbon::now()->startOfWeek();
            $FinSemana = Carbon::now()->endOfWeek();
            $bitacoras = Binnacle::wwhereBetween('date', [$InicioSemana,$FinSemana])->get();
                break;
            case 'mes':
            $fecha = Carbon::now()->format('m');
            $bitacoras = Binnacle::whereMonth('date','=',$fecha)->get();
                break;
            case 'anio':
            $fecha = Carbon::now()->format('Y');
            $bitacoras = Binnacle::whereYear('date','=',$fecha)->get()();
                break;
            default:
            $bitacoras = Binnacle::all();
                break;
        }
        $pdf = PDF::loadView('reportes.bitacora', compact('bitacoras'));
        return $pdf->stream('reporte_bitacora.pdf');
    }
}
