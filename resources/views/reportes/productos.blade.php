@extends('layouts.template-reporte')
@section('content')
	<small>
		<p align="center">Reporte general de productos.</p>
	</small>
	<table class="table">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Producto</th>
				<th>Tipo</th>
				<th>Presentacion</th>
				<th>Inicial</th>
				<th>Entradas</th>
				<th>Salidas</th>
				<th>Existencias</th>
			</tr>
		</thead>
		<tbody>
			@foreach($productos as $producto)
			<tr>
				<td>{{ $producto->code }}</td>
				<td>{{ $producto->name }}</td>
				<td>{{ $producto->type }}</td>
				<td>{{ $producto->unity_m }}</td>
				<td>{{ $producto->id }}</td>
				<td>{{ $producto->entrances()->count() }}</td>
				<td>{{ $producto->deliverys()->count() }}</td>
				<td>{{ $producto->quantity+$producto->entrances()->count('quatity')-$producto->deliverys()->count('quantity') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop