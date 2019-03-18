<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>
		Productos
	</title>
</head>
<body>
<style>
	.page-break {
	    page-break-after: always;
	}

	table {
	  width: 100%;
	  margin: 0 auto;
	  clear: both;
	  border-collapse: separate;
	  border-spacing: 0;
	}

	thead th, tfoot th {
	  font-weight: bold;
	}
	
	thead th, thead td {
	  padding: 10px 18px;
	  border-bottom: 1px solid #111;
	}

	tfoot td {
	  padding: 10px 18px 6px 18px;
	  border-top: 1px solid #111;
	}

	tfoot thead td th{
		text-align: center;
	}

	ul{
		list-style-type: none;
	}

	li{
		list-style: none;
	}

</style>
	<p style="text-align: right;">Fecha: {{ date('d/m/Y') }}</p>
	<p align="center">DIRECCIÓN GENERAL DE ADMINISTRACIÓN</p>
	<small>
		<p align="center">Reporte general de {{$producto->name}}.</p>
	</small>
	<table class="table">
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Producto</th>
				<th>Tipo</th>
				<th>Presentacion</th>
			</tr>
		</thead>
		<tbody>
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
	<table class="table">
		<thead>
			<tr>
				<th>Entradas</th>
				<th>Salidas</th>
			</tr>
		</thead>
		<tbody>
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
			</tr>
		</tbody>
	</table>
</body>
</body>
</html>