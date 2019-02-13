<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cool',function(){
	return view('template.layout');
});
