@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Contabilidad</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Gestion de registros contables</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del documento</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
@php
	$disabled = $caja->id_caja == null ? "" : "disabled";
@endphp
<div class="pd-20 card-box mb-30">
	<form class="" method="post" id="form-caja" enctype="multipart/form-data">
	@csrf
		@if($caja->id_usuario_registra)
		<p><i><b>Ultima actualización: </b>{{ $caja->usuario->tercero->nombre_completo() }} - {{ $caja->updated_at }}</i></p>
		@endif
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Movimiento</b></label>
							<select class="custom-select2 form-control" {{ $disabled }} name="id_dominio_movimiento" style="width: 100%; height: 38px;" >
								@foreach(\App\Dominio::all()->where('id_padre', 42) as $item)
								<option @if($caja->id_dominio_movimiento == $item->id_dominio_movimiento) selected @endif value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Concepto</b></label>
							<input type="text" autocomplete="on" class="form-control" {{ $disabled }} id="concepto" name="concepto" value="{{ $caja->concepto }}">
						</div>
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label><b>Valor</b></label>
							<input type="number" autocomplete="off" class="form-control" {{ $disabled }} id="valor" name="valor" value="{{ $caja->valor }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label><b>Observaciones</b></label>
							<textarea class="form-control" {{ $disabled }} name="observaciones" id="observaciones" rows="3" placeholder="Escriba aqui alguna observacion y(o) anotacion sobre el registro a realizar">{{ $caja->observaciones }}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<center>
				@if($caja->id_caja == null)
				<button type="button" onclick="Validar()" class="btn btn-primary">Guardar cambios</button>
				@else
				<i>No se pueden realizar cambios sobre el documento, si desea cambiar la informacion lo recomendable es anular y crear nuevamente el documento.</i><br><br>
				@endif
			</center>
		</div>
	</div>
	</form>
</div>

<script>
	function Validar() {
		if ($("#concepto").val() == null || $("#concepto").val() == "") {
			alert("El concepto es un campo obligatorio")
			return false
		}
		if ($("#valor").val() == null || $("#valor").val() == "" || $("#valor").val() <= 0) {
			alert("El valor es un campo obligatorio y debe ser mayor a 0")
			return false
		}

		loading(true, "Guardando registro...")
		$("#form-caja").submit()
	}
</script>
@endsection
