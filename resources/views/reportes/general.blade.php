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

	td {
		text-align: center;
	}


</style>
	<p style="text-align: right;">Fecha: {{ date('d/m/Y') }}</p>
	<p align="center">DIRECCIÓN GENERAL DE ADMINISTRACIÓN</p>
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
				<td>{{ $producto->quantity }}</td>
				<td>{{ $producto->entrances()->count('quantity') }}</td>
				<td>{{ $producto->deliverys()->count('quantity') }}</td>
				<td>{{ $producto->quantity+$producto->entrances()->count('quantity')-$producto->deliverys()->count('quantity') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</body>
</html>