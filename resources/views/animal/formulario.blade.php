@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')

@section('content')
	<div class="pd-20 card-box mb-30">
		<div class="clearfix">
			<h4 class="text-blue h4">@if($animal->id_animal) Actualización @else Registro @endif de animal</h4>
			<p class="mb-30">Datos del animal</p>
		</div>
		<div class="wizard-content">
			<form class="tab-wizard wizard-circle wizard" method="post" id="form-animal" enctype="multipart/form-data">
				@csrf
				<h5>Informacion basica</h5>
				<section>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label >*Referencia o codigo :</label>
								<input value="{{ $animal->referencia }}" name="referencia" type="text" class="form-control"  required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label >*Tipo :</label>
								<select class="custom-select2 form-control" name="id_dominio_tipo" style="width: 100%; height: 38px;" >
									@foreach($tipos as $dom)
									<option @if($animal->id_dominio_tipo == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>*Raza :</label>
								<select class="custom-select2 form-control" name="id_dominio_raza" style="width: 100%; height: 38px;">
									@foreach($razas as $dom)
										<option @if($animal->id_dominio_raza == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>*Fecha nacimiento :</label>
								<input value="{{ $animal->fecha_nacimiento }}" name="fecha_nacimiento" type="date" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>*Estado actual :</label>
								<select class="custom-select2 form-control" name="id_dominio_estado" style="width: 100%; height: 38px;">
									@foreach($estados as $dom)
										<option @if($animal->id_dominio_estado == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label >Peso(Kg) :</label>
								<input name="peso" value="{{ $animal->peso }}" type="number" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Estado corporal :</label>
								<input name="estado_corporal" value="{{ $animal->estado_corporal }}" type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label >*Origen :</label>
								<select class="custom-select2 form-control" name="id_dominio_origen" style="width: 100%; height: 38px;" required >
									@foreach($origenes as $dom)
										<option @if($animal->id_dominio_origen == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</section>
				<!-- Step 2 -->
				<h5>Informacion del propietario</h5>
				<section>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Tipo de identificacion :</label>
								<select class="custom-select2 form-control" name="id_dominio_tipo_identificacion" id="id_dominio_tipo_identificacion" style="width: 100%; height: 38px;" required >
									@foreach($tipos_identificacion as $dom)
										<option @if($propietario->id_dominio_tipo_identificacion == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Identificación :</label>
								<input onkeyup="ValidarPropietario(this.value)" value="{{ $propietario->identificacion }}" name="identificacion" id="identificacion" type="text" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>*Nombres :</label>
								<input value="{{ $propietario->nombres }}"  name="nombres" id="nombres" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>*Apellidos :</label>
								<input value="{{ $propietario->apellidos }}"  name="apellidos" id="apellidos" type="text" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email :</label>
								<input value="{{ $propietario->email }}"  name="email" id="email" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Telefono :</label>
								<input value="{{ $propietario->telefono }}"  name="telefono" id="telefono" type="number" class="form-control" >
							</div>
						</div>
					</div>
				</section>
				<!-- Step 3 -->
				<h5>Otros datos</h5>
				<section>
					<div class="row">
						<br>
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<div class="da-card">
								<div class="da-card-content">
									<h5>Foto del animal</h5>
									<i>Selecciona una imagen para el animal.</i>
								</div>

								<div class="da-card-photo">
									<img id="img_animal" src="{{ $animal->url_imagen() }}" alt="">
									<div class="da-overlay">
										<div class="da-social">
											<ul class="clearfix">
												<li>
													<label class="custom-file-upload">
													    <input name="imagen_animal" type="file" id="imagen_animal" />
													    <i class="fa fa-edit"></i>
													</label>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="da-card">
								<div class="da-card-content">
									<h5>Foto del propietario</h5>
									<i>Selecciona una imagen para el propietario del animal.</i>
								</div>

								<div class="da-card-photo">
									<img id="img_propietario" src="{{ $propietario->url_imagen() }}" alt="">
									<div class="da-overlay">
										<div class="da-social">
											<ul class="clearfix">
												<li>
													<label class="custom-file-upload">
													    <input type="file" name="imagen_propietario" id="imagen_propietario" />
													    <i class="fa fa-edit"></i>
													</label>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
				</section>
			</form>

		</div>
	</div>
	<style type="text/css">
		input[type="file"] {
		    display: none;
		}
		.custom-file-upload {
		    border: 1px solid #ccc;
		    display: inline-block;
		    padding: 6px 12px;
		    cursor: pointer;
		}
	</style>
	<script type="">

		$(document).ready(()=>{
			$(".actions ul li:nth-child(1) a").html("Anterior")
			$(".actions ul li:nth-child(2) a").html("Siguiente")
			$(".actions ul li:nth-child(3) a").html("Guardar")

			$(".actions ul li:nth-child(3) a").click(()=>{
				loading(true, "Guardando informacion del animal...")
				$("#form-animal").submit()
			})


			$('#imagen_animal').change(function(){
	            var input = this;
	            var url = $(this).val();
	            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
	             {
	                var reader = new FileReader();

	                reader.onload = function (e) {
	                   $('#img_animal').attr('src', e.target.result);
	                }
	               reader.readAsDataURL(input.files[0]);
	            }
	            else
	            {
	              alert("El archivo seleccionado debe ser una imagen")
	              $('#img_animal').attr('src', 'https://app.clez.co/images/sinimagen.jpg');
	            }
	        });

			$('#imagen_propietario').change(function(){
	            var input = this;
	            var url = $(this).val();
	            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
	             {
	                var reader = new FileReader();

	                reader.onload = function (e) {
	                   $('#img_propietario').attr('src', e.target.result);
	                }
	               reader.readAsDataURL(input.files[0]);
	            }
	            else
	            {
	              alert("El archivo seleccionado debe ser una imagen")
	              $('#img_propietario').attr('src', 'https://app.clez.co/images/sinimagen.jpg');
	            }
	        });
		})


		function ValidarPropietario(identificacion) {
			if(identificacion.length > 4){
				let url = "{{ config('global.url_servidor') }}tercero/validar_identificacion/"+identificacion
				$.get(url, (response) => {
					if(response != null){
						$('#id_dominio_tipo_identificacion').val(response.id_dominio_tipo_identificacion).prop('selected', true);
						$("#nombres").val(response.nombres)
						$("#apellidos").val(response.apellidos)
						$("#email").val(response.email)
						$("#telefono").val(response.telefono)
						if(response.imagen != null && response.imagen != ''){
							$('#img_propietario').attr('src', "{{ config('global.url_imagenes') }}terceros/"+response.imagen);
						}else{
							$('#img_propietario').attr('src', 'https://app.clez.co/images/sinimagen.jpg');
						}
						
					}
				}).fail((error)=>{

				})
			}
		}
	</script>
@endsection
