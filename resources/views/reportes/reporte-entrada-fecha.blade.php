@extends('layouts.template-reporte')
@section('content')
	<p align="center">Reporte entradas de {{ $tipo }} del {{ $fecha }}</p>
	<table class="table">
		<thead align="center">
			<tr>
				<th>Producto</th>
				<th>Recibe</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Tipo</th>
				<th>Presentacion</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody align="center">
			@foreach($entradas as $dato)
				@if($dato->product->type != 'Comida')
				<tr>
					<td>{{ $dato->product->name }}</td>
					<td>{{ $dato->reception }}</td>
					<td>{{ $dato->quantity }}</td>
					<td>{{ $dato->price }}</td>
					<td>{{ $dato->product->type }}</td>
					<td>{{ $dato->unity_m }}</td>
					<td>{{ $dato->date }}</td>
				</tr>
				@endif
			@endforeach
		</tbody>
			</tr>
	</table>
@stop