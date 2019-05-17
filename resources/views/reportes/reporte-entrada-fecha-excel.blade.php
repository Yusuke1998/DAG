<p>Reporte entradas de {{ $tipo }} del {{ $fecha }}</p>
<table>
	<thead>
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
	<tbody>
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