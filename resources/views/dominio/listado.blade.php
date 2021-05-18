@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Dominio</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Listado de dominios</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de los dominios</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
@if(session('message'))
	<script>
		toastr.success("{{ session('message') }}", "Información");
	</script>
@endif
<div class="alert alert-info">
	Los dominios son todos aquellos tipos seleccionables o dinamicos dentro de la aplicacion como lo son los tipos de animal, estados del animal, y otros mas.
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-sm-6">Dominios registrados</h4>
			</div>
			<div class="col-sm-6">
				<a href="{{ route('dominio/registrar') }}" class="btn btn-primary pull-right">+ Nuevo dominio</a>
			</div>
		</div>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th><center>Nombre</center></th>
					<th><center>Descripción</center></th>
					<th><center>Padre</center></th>
					<th><center>Estado</center></th>
					<th class="datatable-nosort"><center>Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($dominios as $item)
					<tr>
						<td><center>{{ $item->nombre }}</center></td>
						<td><center>{{ $item->descripcion }}</center></td>
						<td><center>{{ $item->padre ? $item->padre->nombre : "" }}</center></td>
						<td><center>{{ $item->estado == 1 ? "Activo" : "Inactivo" }}</center></td>
						<td>
							<center>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									@if ($usuario->id_perfil == 1)
									 	<a class="dropdown-item" 
											href="{{ route('dominio/editar') }}?dominio={{ $item->id_dominio }}">
											<i class="dw dw-eye"></i> Editar
										</a>
									@endif
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