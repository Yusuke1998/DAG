 @extends('template.layout')
@section('title') Productos @stop
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col-md-12">
				<p class="h3" align="center">Todos los reportes ofrecidos por el sistema</p>
		    </div>
		    <div class="col-md-12 row mt-3">
		    	<p class="h5 col-md-12" align="center">COMIDA</p>
		    	<p class="col-md-12">FORMATO PDF</p>
		    	<div class="col-md-3">
		          <a href="{{ route('pdf.dia','Comida') }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('pdf.mes','Comida') }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('pdf.anio','Comida') }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		        <div class="col-md-3">
		          <a href="#" class="btn btn-primary btn-sm">GENERAL</a>
		        </div>
		    	<p class="col-md-12">FORMATO EXCEL</p>
		    	<div class="col-md-3">
		          <a href="{{ route('excel.dia','Comida') }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('excel.mes','Comida') }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('excel.anio','Comida') }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="#" class="btn btn-primary btn-sm">GENERAL</a>
		    	</div>
		    </div>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">PRODUCTOS</p>
		    	<p class="col-md-12">FORMATO PDF</p>
		    	<div class="col-md-3">
		          <a href="{{ route('pdf.dia','Producto') }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('pdf.mes','Producto') }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('pdf.anio','Producto') }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		        <div class="col-md-3">
		          <a href="#" class="btn btn-primary btn-sm">GENERAL</a>
		        </div>
		    	<p class="col-md-12">FORMATO EXCEL</p>
		    	<div class="col-md-3">
		          <a href="{{ route('excel.dia','Producto') }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('excel.mes','Producto') }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-3">
		          <a href="{{ route('excel.anio','Producto') }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		        <div class="col-md-3">
		          <a href="#" class="btn btn-primary btn-sm">GENERAL</a>
		    	</div>
		    </div>
		    <hr>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">COMIDA ENTRADAS</p>
		    	<p class="col-md-12">FORMATO PDF</p>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.entradas',['Dia','Comida','PDF']) }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.entradas',['Mes','Comida','PDF']) }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.entradas',['Anio','Comida','PDF']) }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		    	<p class="col-md-12">FORMATO EXCEL</p>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.entradas',['Dia','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.entradas',['Mes','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.entradas',['Anio','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		    </div>
		    <div class="col-md-12 row mt-5">
		    	<p class="h5 col-md-12" align="center">COMIDA SALIDAS</p>
		    	<p class="col-md-12">FORMATO PDF</p>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.salidas',['Dia','Comida','PDF']) }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.salidas',['Mes','Comida','PDF']) }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.salidas',['Anio','Comida','PDF']) }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		    	<p class="col-md-12">FORMATO EXCEL</p>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.salidas',['Dia','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">DIA</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.salidas',['Mes','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">MES</a>
		        </div>
		    	<div class="col-md-4">
		          <a href="{{ route('reporte.salidas',['Anio','Comida','EXCEL']) }}" class="btn btn-primary btn-sm">AÑO</a>
		        </div>
		    </div>
		</div>
	</div>
@stop