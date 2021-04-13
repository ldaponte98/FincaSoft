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
						<li class="breadcrumb-item"><a href="index.html">Gestion de pesajes</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del pesaje</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
<div class="pd-20 card-box mb-30">
	<form class="" method="post" id="form-pesaje" enctype="multipart/form-data">
	@csrf
		@if($pesaje->id_usuario_registra)
		<p><i><b>Ultima actualización: </b>{{ $pesaje->usuario->tercero->nombre_completo() }} - {{ $pesaje->updated_at }}</i></p>
		@endif
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Animal</b></label>
							<select class="custom-select2 form-control" name="id_animal" @if($pesaje->id_animal) disabled @endif style="width: 100%; height: 38px;" >
								@foreach($animales as $item)
								<option @if($pesaje->id_animal == $item->id_animal) selected @endif value="{{ $item->id_animal }}">{{ strtoupper($item->referencia)}} {{ $item->tipo->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Fecha</b></label>
							<input required max="{{ date('Y-m-d').'T'.date('H:i:s') }}" type="datetime-local" class="form-control" name="fecha" id="fecha" value="{{ $pesaje->fecha }}">
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Pesaje (Kg)</b></label>
							<input required type="number" class="form-control" name="peso_medido" id="peso_medido" value="{{ $pesaje->peso_medido }}">
						</div>
					</div>
				</div>
			</div>
		</div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<center><button type="button" onclick="Validar()" class="btn btn-primary">Guardar cambios</button></center>
		</div>
	</div>
	</form>
</div>

<script>
	function Validar() {
		if ($("#fecha").val() == null || $("#fecha").val() == "") {
			alert("La fecha de la tratamiento es un campo obligatorio")
			return false
		}
		if ($("#peso_medido").val() == null || $("#peso_medido").val() == "" || $("#peso_medido").val() <= 0) {
			alert("El valor del pesaje es un campo obligatorio y debe ser mayor a 0")
			return false
		}

		loading(true, "Guardando información del pesaje...")
		$("#form-pesaje").submit()
	}
</script>
@endsection
