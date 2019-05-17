<?php

Route::get('/', function () {
	return redirect(route('login'));
});
Route::get('inventario',function(){
	return redirect(Route('dashboard'));
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'	=>	'inventario', 'middleware'	=>	'auth'],function(){

	Route::get('/charts','ProductController@charts')->name('charts');

	Route::get('/charts/entradas','ConsolidatedController@charts_entradas')->name('consolidados.charts_entradas');

	Route::get('/charts/salidas','ConsolidatedController@charts_salidas')->name('consolidados.charts_salidas');

	Route::get('/charts/entradas/salidas','ConsolidatedController@charts_entradas_salidas')->name('consolidados.charts_entradas_salidas');

	Route::get('/tabla/consolidados/{id}','ConsolidatedController@tabla_consolidados')->name('consolidados.tabla');

	Route::get('inicio', function () {
		return view('dashboard');
	})->name('dashboard');

	// AREAS
	Route::get('areas','AreaController@index')->name('areas.index');
	Route::post('areas','AreaController@store')->name('areas.store');
	Route::get('areas/editar/{id}','AreaController@editar')->name('areas.editar');
	Route::put('areas/actualizar/{id}','AreaController@update')->name('areas.update');
	Route::get('areas/eliminar/{id}','AreaController@destroy')->name('areas.destroy');
	// AREAS

	// ENTRADAS
	Route::resource('entradas','EntranceController');
	Route::get('entradas','EntranceController@index')->name('entradas');
	Route::get('entradas/eliminar/{id}','EntranceController@eliminar')->name('entradas.eliminar');
	Route::post('entradas/editar/{id}','EntranceController@editar')->name('entradas.editar');
	// ENTRADAS

	// SALIDAS
	Route::resource('salidas','DeliveryController');
    Route::get('salidas','DeliveryController@index')->name('salidas');
	Route::get('salidas/eliminar/{id}','DeliveryController@eliminar')->name('salidas.eliminar');
    Route::post('salidas/editar/{id}','DeliveryController@editar')->name('salidas.editar');

    Route::post('salidas/cantidad','DeliveryController@cantidad')->name('salidas.cantidad');
	// SALIDAS

	Route::get('consolidados','ConsolidatedController@index')->name('consolidados');

	Route::get('DireccionDeInformatica',function(){
		return ['Autores'=>
			[
				['estado'=>'inicio del sistema','fecha'=>'13/02/2019'],
				['nombre'=>'Jhonny Perez','correo'=>'jhperez@unerg.edu.ve'],
				['nombre'=>'Fidel Herrera','correo'=>'fidelherrera@unerg.edu.ve'],
				['estado'=>'sistema finalizado','fecha'=>'08/04/2019'],
				['estado'=>'actualizaciones','fecha'=>'17/05/2019'],
			]
		];
	})->name('autores');

	// USUARIOS
	Route::resource('usuarios','UsersController');
	Route::get('usuarios/tabla','UsersController@userTable')->name('usuarios.table');
	Route::get('usuarios/eliminar/{id}','UsersController@eliminar')->name('usuarios.eliminar');
	// USUARIOS

	// Productos
	Route::resource('productos','ProductController');

	
	Route::get('productos/editar/{id}','ProductController@ajax_editar')->name('productos.ajax_editar');
	
	Route::get('productos/eliminar/{id}','ProductController@eliminar')->name('productos.eliminar');
	// Productos

	// Comida
	Route::get('comida','ProductController@comida_index')->name('comida.index');
	Route::post('comida','ProductController@comida_store')->name('comida.store');
	Route::put('comida/actualizar/{id}','ProductController@comida_update')->name('comida.update');
	Route::get('comida/editar/{id}','ProductController@comida_editar')->name('comida.editar');
	Route::get('comida/eliminar/{id}','ProductController@comida_destroy')->name('comida.destroy');
	// Comida

	// Entradas y salidas por producto
	Route::get('productos/entradas/{id}','ProductController@entradas')->name('productos.entradas');
	Route::get('productos/salidas/{id}','ProductController@salidas')->name('productos.salidas');
	// Entradas y salidas por producto

	// Tablas de entradas y salidas
	Route::get('ultimas/entradas','ProductController@entradas_tabla')->name('ultimas_entradas');
	Route::get('ultimas/salidas','ProductController@salidas_tabla')->name('ultimas_salidas');
	// Tablas de entradas y salidas


	// Reportes
	Route::get('reportes','ReportesController@index')->name('reportes.index');
		// PDF
		Route::get('reporte/general/pdf','ReportesController@pdf_general')->name('pdf.general');

		Route::get('reporte/general/comida/pdf','ReportesController@pdf_general_comida')->name('pdf.general.comida');

		Route::get('reporte/general/otro/pdf','ReportesController@pdf_general_otro')->name('pdf.general.otro');

		Route::get('reporte/producto/{id}/pdf','ReportesController@pdf_producto_id')->name('pdf.producto_id');

		Route::get('reporte/anio/pdf/{type}','ReportesController@pdf_anio')->name('pdf.anio');
		Route::get('reporte/mes/pdf/{type}','ReportesController@pdf_mes')->name('pdf.mes');
		Route::get('reporte/dia/pdf/{type}','ReportesController@pdf_dia')->name('pdf.dia');
		// PDF
		Route::get('reporte/entradas/{date}/{type}/{format}','ReportesController@reporte_entradas')->name('reporte.entradas');
		Route::get('reporte/salidas/{date}/{type}/{format}','ReportesController@reporte_salidas')->name('reporte.salidas');
		// EXCEL
		Route::get('reporte/general/excel','ReportesController@excel_general')->name('excel.general');
		Route::get('reporte/general/comida/excel','ReportesController@excel_general_comida')->name('excel.general.comida');
		Route::get('reporte/general/otro/excel','ReportesController@excel_general_otro')->name('excel.general.otro');

		Route::get('reporte/producto/{id}/excel','ReportesController@excel_producto_id')->name('excel.producto_id');
		Route::get('reporte/anio/excel/{type}','ReportesController@excel_anio')->name('excel.anio');
		Route::get('reporte/mes/excel/{type}','ReportesController@excel_mes')->name('excel.mes');
		Route::get('reporte/dia/excel/{type}','ReportesController@excel_dia')->name('excel.dia');
		// EXCEL
	// Reportes

});
