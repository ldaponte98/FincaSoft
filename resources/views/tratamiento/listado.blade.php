@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Tratamiento</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Listado de tratamientos</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de los tratamientos</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="text-blue h4">Historial de tratamientos registrados</h4>
			</div>
			<div class="col-sm-6">
				<a href="{{ route('tratamiento/registrar') }}" class="btn btn-primary pull-right">+ Nuevo tratamiento</a>
			</div>
		</div>
		
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th><center><span class="micon dw dw-rabbit datatable-nosort"></span></center></th>
					<th><center>Animal</center></th>
					<th><center>Tipo</center></th>
					<th><center>Tratamiento</center></th>
					<th><center>Descripción</center></th>
					<th><center>Fecha</center></th>
					<th><center>Estado</center></th>
					<th><center>Usuario Reg.</center></th>
					<th class="datatable-nosort"><center>Soporte</center></th>
					<th class="datatable-nosort"><center>Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tratamientos as $item)
					<tr>
						<td><center><img class="img-table" src="{{ $item->animal->url_imagen() }}"></center></td>
						<td><center>{{ $item->animal->referencia }} - {{ $item->animal->tipo->nombre }}</center></td>
						<td><center>{{ $item->tipo->nombre }}</center></td>
						<td><center>{{ $item->nombre }}</center></td>
						<td><center>{{ strlen($item->descripcion) <= 15 ? $item->descripcion : substr($item->descripcion, 0, 15) }}</center></td>
						<td><center>{{ date("d/m/Y H:i", strtotime($item->fecha)) }}</center></td>
						<td><center>{{ $item->_estado->nombre }}</center></td>
						<td><center>{{ $item->usuario->tercero->nombre_completo() }}</center></td>
						<td><center>
							@if ($item->soporte)
								<a href="{{ config('global.url_servidor').'files/'.$item->soporte }}" target="_blank">
									<span class="micon dw dw-file icon-table"></span>
								</a>
							@endif
						</center></td>
						<td>
							<center>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									<a class="dropdown-item" 
									   href="{{ route('tratamiento/editar') }}?tratamiento={{ $item->id_tratamiento }}">
									   <i class="dw dw-eye"></i> Más</a>
								</div>
							</div>
							</center>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection