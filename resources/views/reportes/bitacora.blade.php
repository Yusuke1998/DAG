@extends('layouts.template-reporte')
@section('content')
	<small>
		<p align="center">Reporte bitacora.</p>
	</small>
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
@stop