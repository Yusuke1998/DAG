@extends('template.layout')
@section('title') Bitacora @stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="h3 text-center">Bitacora de usuarios</p>
				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				  <div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown"
				      aria-haspopup="true" aria-expanded="false">PDF</button>
				    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				        <a href="{{ route('bitacora.pdf','todo') }}" class="dropdown-item">TODO</a>
				        <a href="{{ route('bitacora.pdf','dia') }}" class="dropdown-item">DIA</a>
				        <a href="{{ route('bitacora.pdf','semana') }}" class="dropdown-item">SEMANA</a>
				        <a href="{{ route('bitacora.pdf','mes') }}" class="dropdown-item">MES</a>
				        <a href="{{ route('bitacora.pdf','anio') }}" class="dropdown-item">AÑO</a>
				    </div>
				  </div>
				</div>
			</div>
		    <div class="col-md-12">
			    <table id="tb" class="table table-striped table-bordered tb" cellspacing="0" width="100%">
				  <thead class="black white-text">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Accion</th>
				      <th scope="col">Descripcion</th>
				      <th scope="col">Usuario</th>
				      <th scope="col">Fecha</th>
				      <th scope="col">Hora</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($bitacoras as $bitacora)
				    <tr>
                      <th>{{ $bitacora->id }}</th>
				      <td>{{ $bitacora->action }}</td>
				      <td>{{ $bitacora->description }}</td>
				      <td>{{ $bitacora->user->email }} / {{ $bitacora->user->type }}</td>
				      <td>{{ $bitacora->date }}</td>
				      <td>{{ $bitacora->created_at->format('H:i A') }}</td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
		    </div>
		</div>
	</div>
@stop
