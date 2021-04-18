@php
	$usuario_actual = \App\Usuario::find(session('id_usuario'));
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
						<li class="breadcrumb-item"><a href="index.html">Gestion de usuarios</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del usuario</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
@if($message != null)
	<script>
		toastr.error("{{ $message }}", "Información");
	</script>
@endif
<div class="pd-20 card-box mb-30">
	<form class="" method="post" id="form-usuario" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Nombre completo</b></label>
							<input required type="text" class="form-control" name="nombres" id="nombres" value="{{ $tercero->nombres }}">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Apellido completo</b></label>
							<input required type="text" class="form-control" name="apellidos" id="apellidos" value="{{ $tercero->apellidos }}">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Tipo de identificación</b></label>
							<select class="custom-select2 form-control" name="id_dominio_tipo_identificacion" style="width: 100%; height: 38px;"  required >
								@foreach(\App\Dominio::all()->where('id_padre', 16) as $item)
									<option 
										@if($tercero->id_dominio_tipo_identificacion == $item->id_dominio) 
											selected 
										@endif value="{{ $item->id_dominio }}">{{ $item->nombre }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Identificación</b></label>
							<input required type="text" class="form-control" name="identificacion" id="identificacion" value="{{ $tercero->identificacion }}">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Email</b></label>
							<input type="email" class="form-control" name="email" id="email" value="{{ $tercero->email }}">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Telefono</b></label>
							<input type="text" class="form-control" name="telefono" id="telefono" value="{{ $tercero->telefono }}">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Perfil</b></label>
							<select class="custom-select2 form-control" name="id_perfil" style="width: 100%; height: 38px;"  required >
								@php
									$perfiles = \App\Perfil::all()->where('estado', 1);
									if ($usuario_actual->id_perfil != 1) {
										$perfiles = $perfiles->where('id_perfil', 3);
									}
								@endphp
								@foreach($perfiles as $item)
									<option 
										@if($usuario->id_perfil == $item->id_perfil) 
											selected 
										@endif value="{{ $item->id_perfil }}">{{ $item->nombre }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Usuario</b></label>
							<input type="text" autocomplete="off" required class="form-control" name="nombre_usuario" id="nombre_usuario" value="{{ $usuario->usuario }}">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>*Contraseña</b></label>
							<input type="password" autocomplete="off" required class="form-control" name="clave" id="clave" value="{{ $usuario->clave }}">
						</div>
					</div>
				</div>
			</div>
		</div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<center><button type="submit" class="btn btn-primary">Guardar cambios</button></center>
		</div>
	</div>
	</form>
</div>
@endsection
