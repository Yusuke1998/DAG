@extends('layouts.template-reporte')
@section('content')
	<p align="center">Reporte {{ $type }} del {{ $fecha }}</p>
	<table class="table">
		<thead align="center">
			<tr>
				<th>Codigo</th>
				<th>Producto</th>
				<th>Tipo</th>
				<th>Presentacion</th>
			</tr>
		</thead>
		<tbody align="center">
			@foreach($data as $dato)
			<tr>
				<td>{{ $dato->code }}</td>
				<td>{{ $dato->name }}</td>
				<td>{{ $dato->type }}</td>
				<td>{{ $dato->unity_m }}</td>
			</tr>
			@endforeach
		</tbody>
			</tr>
	</table>
@stop