 @extends('template.layout')
@section('title') Productos @stop
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col-md-12">
				<p class="h3" align="center">Todos los reportes ofrecidos por el sistema</p>
		    </div>
		    <div class="col-md-12 row mt-3">
		    	<p class="h5 col-md-12" align="center">TOTAL COMIDA</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('pdf.dia','Comida') }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('excel.dia','Comida') }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('pdf.mes','Comida') }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('excel.mes','Comida') }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('pdf.anio','Comida') }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('excel.anio','Comida') }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>

		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">TOTAL PRODUCTOS</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('pdf.dia','Producto') }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('excel.dia','Producto') }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('pdf.mes','Producto') }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('excel.mes','Producto') }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('pdf.anio','Producto') }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('excel.anio','Producto') }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>
		    <hr>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">COMIDA ENTRADAS</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.entradas',['Dia','Comida','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.entradas',['Dia','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.entradas',['Mes','Comida','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.entradas',['Mes','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
			    					<a href="{{ route('reporte.entradas',['Anio','Comida','PDF']) }}" class="btn btn-primary btn-sm">PDF AÑO</a>
			    					<a href="{{ route('reporte.entradas',['Anio','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL AÑO</a>
			    				</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">COMIDA SALIDAS</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.salidas',['Dia','Comida','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.salidas',['Dia','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.salidas',['Mes','Comida','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.salidas',['Mes','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
			    					<a href="{{ route('reporte.salidas',['Anio','Comida','PDF']) }}" class="btn btn-primary btn-sm">PDF AÑO</a>
			    					<a href="{{ route('reporte.salidas',['Anio','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL AÑO</a>
			    				</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">PRODUCTO ENTRADAS</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.entradas',['Dia','Producto','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.entradas',['Dia','Producto','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.entradas',['Mes','Producto','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.entradas',['Mes','Producto','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
			    					<a href="{{ route('reporte.entradas',['Anio','Producto','PDF']) }}" class="btn btn-primary btn-sm">PDF AÑO</a>
			    					<a href="{{ route('reporte.entradas',['Anio','Producto','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL AÑO</a>
			    				</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">PRODUCTO SALIDAS</p>
		    	<table class="table text-center">
		    		<thead>
		    			<tr>
		    				<th>DIA</th>
		    				<th>MES</th>
		    				<th>AÑO</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.salidas',['Dia','Producto','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.salidas',['Dia','Producto','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    					</div>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		    						<a href="{{ route('reporte.salidas',['Mes','Producto','PDF']) }}" class="btn btn-primary btn-sm">PDF</a>
		    						<a href="{{ route('reporte.salidas',['Mes','Producto','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL</a>
		    				</td>
		    				<td>
		    					<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
			    					<a href="{{ route('reporte.salidas',['Anio','Producto','PDF']) }}" class="btn btn-primary btn-sm">PDF AÑO</a>
			    					<a href="{{ route('reporte.salidas',['Anio','Producto','EXCEL']) }}" class="btn btn-primary btn-sm">EXCEL AÑO</a>
			    				</div>
		    				</td>
		    			</tr>
		    		</tbody>
		    	</table>
		    </div>
		</div>
	</div>
@stop