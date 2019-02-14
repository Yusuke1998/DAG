<?php

Route::get('/', function () {
	return view('dashboard');
});

Route::group(['prefix'	=>	'inventario'],function(){

	Route::get('DireccionDeInformatica',function(){
		return ['Autores'=>['Jhonny Perez','Fidel Herrera']];
	});

});
