<?php

Route::get('/', function () {
	return redirect(route('login'));
});
Route::get('inventario',function(){
	return redirect(Route('dashboard'));
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/charts','ProductController@charts')->name('charts');
Route::get('/charts/entradas','ConsolidatedController@charts_entradas')->name('consolidados.charts_entradas');
Route::get('/charts/salidas','ConsolidatedController@charts_salidas')->name('consolidados.charts_salidas');
Route::get('/charts/entradas/salidas','ConsolidatedController@charts_entradas_salidas')->name('consolidados.charts_entradas_salidas');

Route::group(['prefix'	=>	'inventario', 'middleware'	=>	'auth'],function(){

	Route::get('inicio', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::resource('entradas','EntranceController');
	Route::get('entradas','EntranceController@index')->name('entradas');
	// Route::post('entradas','EntranceController@store')->name('entradas.store');
	Route::get('entradas/eliminar/{id}','EntranceController@eliminar')->name('entradas.eliminar');
	Route::post('entradas/editar/{id}','EntranceController@editar')->name('entradas.editar');


	Route::resource('salidas','DeliveryController');
    Route::get('salidas','DeliveryController@index')->name('salidas');

	//Route::get('salidas/eliminar/{id}','DeliveryController@eliminar')->name('salidas.eliminar');
	//Route::post('salidas/editar/{id}','DeliveryController@editar')->name('salidas.editar');

	Route::get('consolidados','ConsolidatedController@index')->name('consolidados');

	Route::get('DireccionDeInformatica',function(){
		return ['Autores'=>
			[
				['estado'=>'inicio del sistema','fecha'=>'13/02/2019'],
				['nombre'=>'Jhonny Perez','correo'=>'jhperez@unerg.edu.ve'],
				['nombre'=>'Fidel Herrera','correo'=>'fidelherrera@unerg.edu.ve'],
				['estado'=>'sistema finalizado','fecha'=>'18/02/2019'],
			]
		];
	})->name('autores');

	Route::resource('usuarios','UsersController');

	// Productos
	Route::resource('productos','ProductController');
	Route::get('productos/editar/{id}','ProductController@editar')->name('productos.editar');
	Route::post('productos/editar/{id}','ProductController@ajax_editar')->name('productos.ajax_editar');
	Route::get('productos/eliminar/{id}','ProductController@eliminar')->name('productos.eliminar');
	// Productos

	// Entradas y salidas por producto
	Route::get('productos/entradas/{id}','ProductController@entradas')->name('productos.entradas');
	Route::get('productos/salidas/{id}','ProductController@salidas')->name('productos.salidas');
	// Entradas y salidas por producto


	// Reportes
	Route::get('reporte/general','ProductController@pdf_general')->name('pdf.general');
	// Reportes

});
