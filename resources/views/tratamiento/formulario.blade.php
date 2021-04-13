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
						<li class="breadcrumb-item"><a href="index.html">Gestion de tratamientos</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del tratamiento</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
<div class="pd-20 card-box mb-30">
	<form class="" method="post" id="form-tratamiento" enctype="multipart/form-data">
	@csrf
		@if($tratamiento->id_usuario_registra)
		<p><i><b>Ultima actualización: </b>{{ $tratamiento->usuario->tercero->nombre_completo() }} - {{ $tratamiento->updated_at }}</i></p>
		@endif
		<div class="row">
			<div class="col-sm-7">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Animal</b></label>
							<select class="custom-select2 form-control" name="id_animal" @if($tratamiento->id_animal) disabled @endif style="width: 100%; height: 38px;" >
								@foreach($animales as $item)
								<option @if($tratamiento->id_animal == $item->id_animal) selected @endif value="{{ $item->id_animal }}">{{ strtoupper($item->referencia)}} {{ $item->tipo->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Tipo</b></label>
							<select class="custom-select2 form-control" name="id_dominio_tipo" style="width: 100%; height: 38px;"  required >
								@foreach(\App\Dominio::all()->where('id_padre', 27) as $item)
									<option 
										@if($tratamiento->id_dominio_tipo == $item->id_dominio) 
											selected 
										@endif value="{{ $item->id_dominio }}">{{ $item->nombre }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Tratamiento</b></label>
							<input class="form-control" type="text" id="nombre" name="nombre" value="{{ $tratamiento->nombre }}" placeholder="Nombre de la tratamiento" required />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Descripcion</b></label>
							<input class="form-control" placeholder="Detalles sobre la informacion de la tratamiento"  name="descripcion" value="{{ $tratamiento->descripcion }}" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Estado</b></label>
							<select class="custom-select2 form-control" name="id_dominio_estado" style="width: 100%; height: 38px;" >
								@foreach($estados as $item)
								<option @if($tratamiento->id_dominio_estado == $item->id_dominio) selected @endif value="{{ $item->id_dominio }}">{{ $item->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label><b>Fecha</b></label>
							<input required type="datetime-local" class="form-control" name="fecha" id="fecha" value="{{ $tratamiento->fecha }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label><b>Soporte</b></label>
							<div class="custom-file">
								<input id="soporte" name="soporte" type="file" class="custom-file-input">
								<label for="soporte" id="label_sopote" class="custom-file-label">@if($tratamiento->soporte) Actual: {{ $tratamiento->soporte }} @else Escoje un archivo @endif</label>
							</div>
						</div>
					</div>
				</div>

				
			</div>
			<div class="col-sm-5">
				<div class="row">
					<div class="col-sm-6">
						<span class="breadcrumb-item active" aria-current="page">Dosis</span>
					</div>
					<div class="col-sm-6">
						<button type="button" class="btn btn-primary pull-right" onclick="ModalDosis()">+ Agregar dosis</button>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-striped" id="tabla-dosis">
							  <thead>
							    <tr>
							      <th scope="col"><center>#</center></th>
							      <th scope="col"><center>Fecha</center></th>
							      <th scope="col"><center></center></th>
							    </tr>
							  </thead>
							  <tbody>
							  </tbody>
							</table>
						</div>
					</div>
				</div>	
			</div>
		</div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<center><button type="button" onclick="ValidarTratamiento()" class="btn btn-primary">Guardar cambios</button></center>
		</div>
	</div>

	<div id="data-dosis"></div>

	</form>
</div>

<div class="modal fade" id="modal-dosis" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Gestion de dosis</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label><b>Fecha de la dosis</b></label>
					<input type="datetime-local" id="dosis-fecha" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" onclick="AgregarDosis()">Guardar</button>
			</div>
		</div>
	</div>
</div>
<script>

	var dosis = []

	$(document).ready(()=>{
		EstablecerAntiguasDosis()
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

	function ModalDosis(id_dosis = null) {
		$("#modal-dosis").modal('show')
	}

	function AgregarDosis() {
		let fecha = $("#dosis-fecha").val()
		if(fecha != ""){
			this.dosis.push({
				"id" : null,
				"fecha" : fecha
			})
			$("#modal-dosis").modal('hide')
			this.ActualizarTablaDosis()
		}else{
			alert("Escoja una fecha valida")
		}
		
	}

	function ValidarTratamiento() {
		if ($("#fecha").val() == null || $("#fecha").val() == "") {
			alert("La fecha de la tratamiento es un campo obligatorio")
			return false
		}
		if ($("#nombre").val() == null || $("#nombre").val() == "") {
			alert("El nombre de la tratamiento es un campo obligatorio")
			return false
		}

		//MIRAMOS SI HAY DOSIS EN LA LISTA Y LAS AGREGAMOS AL FORMULARIO

		this.dosis.filter(item => item.id == null).forEach((dosis) => {
			$("#data-dosis").append('<input type="datetime-local" name="dosis[]" value="'+dosis.fecha+'">')
		})

		
		loading(true, "Guardando información de la tratamiento...")
		$("#form-tratamiento").submit()
	}

	function ActualizarTablaDosis() {
		let tabla = ""
		let cont = 0
		this.dosis.forEach((dosis) => {
			tabla += '<tr>'
			tabla += '<th scope="row"><center>'+(cont + 2)+'</center></th>'
			tabla += '<th scope="row"><center>'+dosis.fecha.replace("T", " ")+'</center></th>'
			if(dosis.id == null) 
				tabla += '<td><a onclick="EliminarDosis('+cont+')"><i class="fa fa-trash red"></i></a></td>'
			else
				tabla += '<td><a title="No se puede eliminar esta dosis, si desea cancelarla podra hacerlo accediendo a ella y cancelndola" target="_blank" href="{{ config('global.url_servidor') }}tratamiento/editar?tratamiento='+dosis.id+'"><i class="fa fa-bars"></i></a></td>'
			tabla += '</tr>'
			cont++
		})
		$("#tabla-dosis tbody").html(tabla)
	}

	function EliminarDosis(posicion) {
		let confirmacion = confirm("¿Seguro desea eliminar esta dosis?")
		if (confirmacion) this.dosis.splice(posicion, 1)
		this.ActualizarTablaDosis()
	}

	function EstablecerAntiguasDosis() {
		@foreach($tratamiento->dosis as $dosis)
			this.dosis.push({
				'id' : '{{ $dosis->id_tratamiento }}',
				'fecha' : '{{ $dosis->fecha }}'
			})
		@endforeach

		this.ActualizarTablaDosis()
	}



</script>
@endsection