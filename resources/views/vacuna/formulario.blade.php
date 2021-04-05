@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Vacuna</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Registro de vacuna</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de la vacuna</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
<div class="pd-20 card-box mb-30">
	<form class="" method="post" id="form-vacuna" enctype="multipart/form-data">
	@csrf
		@if($vacuna->id_usuario_registra)
		<p><i><b>Ultima actualización: </b>{{ $usuario->tercero->nombre_completo() }} - {{ $vacuna->updated_at }}</i></p>
		@endif
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label><b>Animal</b></label>
					<select class="custom-select2 form-control" name="id_animal" @if($vacuna->id_animal) disabled @endif style="width: 100%; height: 38px;" >
						@foreach($animales as $item)
						<option @if($vacuna->id_animal == $item->id_animal) selected @endif value="{{ $item->id_animal }}">{{ strtoupper($item->referencia)}} {{ $item->tipo->nombre }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label><b>Vacuna</b></label>
					<input class="form-control" type="text" id="nombre" name="nombre" value="{{ $vacuna->nombre }}" placeholder="Nombre de la vacuna" required />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label><b>Descripcion</b></label>
					<input class="form-control" placeholder="Detalles sobre la informacion de la vacuna"  name="descripcion" value="{{ $vacuna->descripcion }}" />
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label><b>Estado</b></label>
					<select class="custom-select2 form-control" name="id_dominio_estado" style="width: 100%; height: 38px;" >
						@foreach($estados as $item)
						<option @if($vacuna->id_dominio_estado == $item->id_dominio) selected @endif value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label><b>Fecha</b></label>
					<input required type="datetime-local" class="form-control" name="fecha" id="fecha" value="{{ $vacuna->fecha }}">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label><b>Soporte</b></label>
					<div class="custom-file">
						<input id="soporte" name="soporte" type="file" class="custom-file-input">
						<label for="soporte" id="label_sopote" class="custom-file-label">@if($vacuna->soporte) Actual: {{ $vacuna->soporte }} @else Escoje un archivo @endif</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<center><button type="button" onclick="ValidarVacuna()" class="btn btn-primary">Guardar</button></center>
			</div>
		</div>
	</form>
</div>
<script>
	$(document).ready(()=>{


		$('#soporte').change(function(){
	        var input = this;
	        var url = $(this).val();
	        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	        if (input.files && input.files[0]) 
	        {
	            $('#label_sopote').html('Actual: '+input.files[0].name);
	        }
	        else
	        {
	          alert("El archivo seleccionado no es valido")
	          $('#label_sopote').html('Escoje un archivo');
	        }
	    });
	});

	function ValidarVacuna() {
		if ($("#fecha").val() == null || $("#fecha").val() == "") {
			alert("La fecha de la vacuna es un campo obligatorio")
			return false
		}
		if ($("#nombre").val() == null || $("#nombre").val() == "") {
			alert("El nombre de la vacuna es un campo obligatorio")
			return false
		}
		
		loading(true, "Guardando información de la vacuna...")
		$("#form-vacuna").submit()
	}

</script>
@endsection