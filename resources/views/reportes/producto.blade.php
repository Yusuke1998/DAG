@extends('layouts.template-reporte')
@section('content')
	<small>
		<p align="center"><b>{{$producto->name}}.</b></p>
	</small>
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
			<tr>
				<td>{{ $producto->code }}</td>
				<td>{{ $producto->name }}</td>
				<td>{{ $producto->type }}</td>
				<td>{{ $producto->unity_m }}</td>
			</tr>
		</tbody>
			</tr>
	</table>
	<hr>
	<table class="table" border="1">
		<thead align="center">
			<tr>
				<th>Entradas</th>
				<th>Salidas</th>
				<th>Existencia total del producto</th>
			</tr>
		</thead>
		<tbody align="left">
			<tr>
				<td>
				@foreach($producto->entrances as $entradas)
				<ul>
					<li>Cantitad: {{$entradas->quantity}}</li>
					<li>Recibe: {{$entradas->reception}}</li>
					<li>Fecha: {{$entradas->date}}</li>
				</ul>
				@endforeach
				</td>
				<td>
				@foreach($producto->deliverys as $salidas)
				<ul>
					<li>Cantidad: {{$salidas->quantity}}</li>
					<li>Fecha: {{$salidas->date}}</li>
					<li>Entrega: {{$salidas->functionary_e}}</li>
					<li>Recibe: {{$salidas->functionary_r}}</li>
					<li>Area: {{$salidas->area->name}}</li>
				</ul>
				@endforeach
				</td>
				<td>
					<ul>
						<li>
							{{ 	
								$producto->quantity+
						        $producto->entrances()->sum('quantity')-
						        $producto->deliverys()->sum('quantity') 
						    }} {{ $producto->unity_m }}
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
@stop