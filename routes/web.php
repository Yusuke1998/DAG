<?php

Route::get('/', function () {
	return view('dashboard');
});

Route::group(['prefix'	=>	'inventario'],function(){

	Route::get('DireccionDeInformatica',function(){
		return ['Autores'=>['Jhonny Perez','Fidel Herrera']];
	});

	Route::get('entradas',function(){
		return view('entradas');
	});

	Route::get('salidas',function(){
		return view('salidas');
	});

	Route::get('consolidados',function(){
		return view('consolidados');
	});

	Route::resource('producto','ProductController');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
