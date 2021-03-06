@extends('layouts.template-reporte')
@section('content')
	<p align="center">Reporte salidas de {{ $tipo }} del {{ $fecha }}</p>
	<table class="table">
		<thead align="center">
			<tr>
				<th>Producto</th>
				<th>Entrega</th>
				<th>Recibe</th>
				<th>Area</th>
				<th>Presentacion</th>
				<th>Cantidad</th>
				<th>Tipo</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody align="center">
			@foreach($salidas as $dato)
				@if($dato->product->type != 'Comida')
				<tr>
					<td>{{ $dato->product->name }}</td>
					<td>{{ $dato->functionary_e }}</td>
					<td>{{ $dato->functionary_r }}</td>
					<td>{{ $dato->area->name }}</td>
					<td>{{ $dato->unity_m }}</td>
					<td>{{ $dato->quantity }}</td>
					<td>{{ $dato->product->type }}</td>
					<td>{{ $dato->date }}</td>
				</tr>
				@endif
			@endforeach
		</tbody>
			</tr>
	</table>
@stop