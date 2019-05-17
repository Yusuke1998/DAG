<p>Reporte {{ $type }} del {{ $fecha }}</p>
<table>
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Producto</th>
			<th>Tipo</th>
			<th>Presentacion</th>
		</tr>
	</thead>
	<tbody>
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