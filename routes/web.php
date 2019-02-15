<?php

Route::get('/', function () {
	return redirect(route('login'));
});

Route::group(['prefix'	=>	'inventario'],function(){

	Route::get('inicio', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('entradas',function(){
		return view('entradas');
	})->name('entradas');

	Route::get('salidas',function(){
		return view('salidas');
	})->name('salidas');

	Route::get('consolidados',function(){
		return view('consolidados');
	})->name('consolidados');

	Route::get('DireccionDeInformatica',function(){
		return ['Autores'=>['Jhonny Perez','Fidel Herrera']];
	})->name('autores');

	Route::resource('usuarios','UsersController');

	// Productos
	Route::resource('productos','ProductController');
	Route::get('productos/editar/{id}','ProductController@editar')->name('productos.editar');
	Route::get('productos/eliminar/{id}','ProductController@eliminar')->name('productos.eliminar');
	// Productos

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
