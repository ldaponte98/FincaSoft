@php
	$usuario_actual = \App\Usuario::find(session('id_usuario'));
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
						<li class="breadcrumb-item"><a href="index.html">Gestion de dominios</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del dominio</li>
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
	<form class="" method="post" id="form-dominio" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label><b>*Nombre</b></label>
							<input required type="text" class="form-control" name="nombre" id="nombre" value="{{ $dominio->nombre }}">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label><b>Descripción</b></label>
							<input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $dominio->descripcion }}">
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label><b>Padre</b></label>
							<select class="custom-select2 form-control" name="id_padre" style="width: 100%; height: 38px;"  required >
								<option>Ninguno</option>
								@foreach(\App\Dominio::all()->where('id_padre', null) as $item)
									
									<option 
										@if($dominio->id_padre == $item->id_dominio) 
											selected 
										@endif value="{{ $item->id_dominio }}">{{ $item->nombre }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label><b>*Estado</b></label>
							<select class="custom-select2 form-control" name="estado" style="width: 100%; height: 38px;"  required >
									<option {{ $dominio->estado == 1 ? "selected" : "" }} value="1">Activo</option>
									<option {{ $dominio->estado == 0 ? "selected" : "" }} value="0">Inactivo</option>
							</select>
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
