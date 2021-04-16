@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')

@section('content')
	<div class="pd-20 card-box mb-30">
		<div class="clearfix">
			<h4 class="text-blue h4">Proceso de parto del animal</h4>
			<p class="mb-30">Informacion del parto</p>
			
		</div>
		<div class="wizard-content">
			<h5><b>Parto {{ $animal->tipo->nombre }} - {{ $animal->referencia }}</b></h5><br>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" onclick="ModalCria()">+ Registrar Cria</button>
				</div>
			</div><br>
			<div class="row" id="div-crias">
				
			</div>
			<br>
			<center>
				<button class="btn btn-primary" onclick="Guardar()">Registrar finalización de parto</button>
			</center>
		</div>
	</div>
	<div class="modal fade bs-example-modal-lg" id="modal-cria" tabindex="-1" role="dialog" aria-labelledby="modal" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal">Gestion de cria</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><b>Referencia</b></label>
								<input type="text" class="form-control" id="referencia">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><b>Sexo</b></label>
								<select class="custom-select2 form-control" id="id_dominio_sexo" style="width: 100%; height: 38px;" >
									@foreach(\App\Dominio::all()->where('id_padre', 24) as $item)
										<option value="{{ $item->id_dominio }}">{{ $item->nombre }} </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><b>Peso (Kg)</b></label>
								<input type="number" class="form-control" id="peso">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><b>Color de referencia</b></label>
								<input id="color" value="{{ $animal->color }}" type="color" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" onclick="GuardarCria()">Guardar</button>
				</div>
			</div>
		</div>
	</div>
	@csrf
	<script>
		var crias = []
		var posicion_editar = null;
		function ModalCria(posicion = null) {
			if(posicion_editar != null){
				let cria = this.crias[posicion]
				$("#referencia").val(cria.referencia)
				$("#id_dominio_sexo").val(cria.id_dominio_sexo).prop('selected', true);
				$("#peso").val(cria.peso)
				$("#color").val(cria.color)
			}
			$("#modal-cria").modal('show')
		}

		function GuardarCria() {
			if($("#referencia").val().trim() == "" || $("#peso").val().trim() == ""){
				alert("todos los campos son obligatorios")
				return false
			}
			let cria = {
				'referencia' : $("#referencia").val(),
				'id_dominio_sexo' : $("#id_dominio_sexo").val(),
				'peso' : $("#peso").val(),
				'color' : $("#color").val(),
				'tipo' : '{{ $animal->tipo->nombre }}',
				'imagen' : 'https://app.clez.co/images/sinimagen.jpg'
			}
			if(posicion_editar == null) this.crias.push(cria); else this.crias.splice(posicion_editar, 1, cria);
			console.log(crias)
			posicion_editar = null;
			$("#referencia").val("")
			$("#peso").val("")
			$("#modal-cria").modal('hide')
			this.ActualizarCrias()
		}
		function ActualizarCrias() {
			div = "";
			this.crias.forEach((cria) => {
				div += '<div class="col-sm-3">'+
							'<div class="contact-directory-box">'+
								'<div class="contact-dire-info text-center">'+
									'<div class="contact-avatar">'+
										'<span>'+
											'<img src="'+cria.imagen+'" style="height: 100%;" alt="">'+
										'</span>'+
									'</div>'+
									'<div class="contact-name">'+
										'<h4>'+cria.referencia+'</h4>'+
										'<p><b>'+cria.tipo+'</b></p>'+
										'<p>'+(cria.id_dominio_sexo == 25 ? "Hembra" : "Macho")+' - '+cria.peso+' Kg</p>'+
									'</div>'+
								'</div>'+
								'<br>'+
								'<div class="view-contact mt-2">'+
									'<a onclick="ModalCria('+crias.indexOf(cria)+')">Cria</a>'+
								'</div>'+
							'</div>'+
						'</div>'
			})
			$("#div-crias").html(div)
		}

		function Guardar() {
				if(this.crias.length != 0){
					let url = '{{ route('animal/guardar_parto') }}'
					let _token = $('input[name=_token]')[0].value
					let request = {
						'_token' : _token,
						'id_animal' : {{ $animal->id_animal }},
						'crias' : this.crias
					}
					loading(true, "Finalizando proceso de parto y registro de crias...")
					$.post(url, request, (response) => {
						loading(false)
						if(!response.error) toastr.success(response.message); else toastr.error(response.message);
						if(!response.error) location.href = "{{ route('animal/vista', $animal->id_animal) }}"
					})
					.fail((error) => {
						loading(false)
						toastr.error("Ocurrio un error al finalizar el proceso de parto")
					})
				}else{
					loading(false)
					toastr.error("Para finalizar el proceso de parto es necesario que registre a las crias del animal")
				}
			}

	</script>
@endsection
