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

	Route::get('inicio', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('entradas','EntranceController@index')->name('entradas');

	Route::get('salidas','DeliveryController@index')->name('salidas');

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
	Route::get('productos/eliminar/{id}','ProductController@eliminar')->name('productos.eliminar');
	// Productos

});
