@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Producción del animal</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Gestion de producción</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de la producción</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
<div class="pd-20 card-box mb-30">
	<form class="" method="post" id="form-produccion" enctype="multipart/form-data">
	@csrf
		@if($produccion->id_usuario_registra)
		<p><i><b>Ultima actualización: </b>{{ $produccion->usuario->tercero->nombre_completo() }} - {{ $produccion->updated_at }}</i></p>
		@endif
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Animal</b></label>
							<select class="custom-select2 form-control" name="id_animal" @if($produccion->id_animal) disabled @endif style="width: 100%; height: 38px;" >
								@foreach($animales as $item)
								<option @if($produccion->id_animal == $item->id_animal) selected @endif value="{{ $item->id_animal }}">{{ strtoupper($item->referencia)}} {{ $item->tipo->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Fecha Inicio</b></label>
							<input required max="{{ date('Y-m-d').'T'.date('H:i:s') }}" type="datetime-local" class="form-control" name="fecha_inicio" id="fecha_inicio" value="{{ $produccion->fecha_inicio }}">
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Fecha Fin</b></label>
							<input required max="{{ date('Y-m-d').'T'.date('H:i:s') }}" type="datetime-local" class="form-control" name="fecha_fin" id="fecha_fin" value="{{ $produccion->fecha_fin }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Concepto</b></label>
							<select required class="custom-select2 form-control" name="id_dominio_concepto" style="width: 100%; height: 38px;">
								@foreach(\App\Dominio::all()->where('id_padre', 34) as $item)
								<option @if($produccion->id_dominio_concepto == $item->id_dominio) selected @endif value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Unidad de medida</b></label>
							<select required class="custom-select2 form-control" name="id_dominio_unidad_medida" style="width: 100%; height: 38px;">
								@foreach(\App\Dominio::all()->where('id_padre', 36) as $item)
								<option @if($produccion->id_dominio_unidad_medida == $item->id_dominio) selected @endif value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Producción</b></label>
							<input required type="number" class="form-control" name="valor_produccion" id="valor_produccion" value="{{ $produccion->valor_produccion }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label><b>Observaciones</b></label>
							<textarea class="form-control" name="observaciones" id="observaciones" rows="3" placeholder="Escriba aqui alguna observacion y(o) anotacion sobre la toma de produccion del animal">{{ $produccion->observaciones }}</textarea>
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
		if ($("#fecha_inicio").val() == null || $("#fecha_inicio").val() == "") {
			alert("La fecha de inicio de la producción es un campo obligatorio")
			return false
		}

		if ($("#fecha_fin").val() == null || $("#fecha_fin").val() == "") {
			alert("La fecha de fin o cierre de la producción es un campo obligatorio")
			return false
		}
		if ($("#valor_produccion").val() == null || $("#valor_produccion").val() == "" || $("#valor_produccion").val() <= 0) {
			alert("La cantidad de produccion es un campo obligatorio y debe ser mayor a 0")
			return false
		}

		loading(true, "Guardando información de la producción...")
		$("#form-produccion").submit()
	}
</script>
@endsection
