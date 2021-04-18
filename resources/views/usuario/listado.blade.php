@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Usuario</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Listado de usuarios</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de los usuarios</li>
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
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-sm-6">Usuarios registrados</h4>
			</div>
			<div class="col-sm-6">
				<a href="{{ route('usuario/registrar') }}" class="btn btn-primary pull-right">+ Nuevo usuario</a>
			</div>
		</div>
		
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th><center><span class="micon dw dw-user datatable-nosort"></span></center></th>
					<th><center>Nombres</center></th>
					<th><center>Apellidos</center></th>
					<th><center>Email</center></th>
					<th><center>Perfil</center></th>
					<th><center>Usuario</center></th>
					<th><center>Estado</center></th>
					<th class="datatable-nosort"><center>Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($usuarios as $item)
					<tr>
						<td><center><img class="img-table" src="{{ $item->tercero->url_imagen() }}"></center></td>
						<td><center>{{ $item->tercero->nombres }}</center></td>
						<td><center>{{ $item->tercero->apellidos }}</center></td>
						<td><center>{{ $item->tercero->email }}</center></td>
						<td><center>{{ $item->perfil->nombre }}</center></td>
						<td><center>{{ $item->usuario }}</center></td>
						<td><center>{{ $item->estado == 1 ? "Activo" : "Inactivo" }}</center></td>
						<td>
							<center>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									@if ($usuario->id_perfil == 1 || $usuario->id_perfil == 2)
									 	@if ($usuario->id_perfil == 2)
										 	@if ($item->id_perfil != 1 and $item->id_perfil != 2)
										 		<a class="dropdown-item" 
												   href="{{ route('usuario/editar') }}?usuario={{ $item->id_usuario }}">
												   <i class="dw dw-eye"></i> Editar</a>
										 	@endif
									 	@else
									 		<a class="dropdown-item" 
										   href="{{ route('usuario/editar') }}?usuario={{ $item->id_usuario }}">
										   <i class="dw dw-eye"></i> Editar</a>
									 	@endif
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