@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Pesaje</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Listado de pesajes</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de los pesajes</li>
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
				<h4 class="text-blue h4">Historial de pesajes registrados</h4>
			</div>
			<div class="col-sm-6">
				<a href="{{ route('pesaje/registrar') }}" class="btn btn-primary pull-right">+ Nuevo pesaje</a>
			</div>
		</div>
		
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th><center><span class="micon dw dw-rabbit datatable-nosort"></span></center></th>
					<th><center>Animal</center></th>
					<th><center>Peso Antiguo</center></th>
					<th><center>Peso Medido</center></th>
					<th><center>Fecha</center></th>
					<th><center>Usuario Reg.</center></th>
					<th><center>Estado</center></th>
					<th class="datatable-nosort"><center>Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($pesajes as $item)
					<tr>
						<td><center><img class="img-table" src="{{ $item->animal->url_imagen() }}"></center></td>
						<td><center>{{ $item->animal->referencia }} - {{ $item->animal->tipo->nombre }}</center></td>
						<td><center>{{ $item->peso_anterior }} Kg</center></td>
						<td><center>{{ $item->peso_medido }} Kg</center></td>
						<td><center>{{ date("d/m/Y H:i", strtotime($item->fecha)) }}</center></td>
						<td><center>{{ $item->usuario->tercero->nombre_completo() }}</center></td>
						<td><center>{{ $item->estado == 1 ? "Activo" : "Inactivo" }}</center></td>
						
						<td>
							<center>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									<a class="dropdown-item" 
									   href="{{ route('pesaje/editar') }}?pesaje={{ $item->id_animal_pesaje }}">
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