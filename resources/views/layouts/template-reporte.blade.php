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
	@yield('content')
</body>
</body>
</html>