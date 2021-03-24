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
			<form class="tab-wizard wizard-circle wizard" method="post" id="form-animal">
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
								<input value="{{ $animal->fecha_nacimiento }}" type="date" class="form-control" required>
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
								<input type="number" class="form-control">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Estado corporal :</label>
								<input type="text" class="form-control">
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
								<select class="custom-select2 form-control" name="id_dominio_tipo_identificacion" style="width: 100%; height: 38px;" required >
									@foreach($tipos_identificacion as $dom)
										<option @if($propietario->id_dominio_tipo_identificacion == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Identificación :</label>
								<input value="{{ $propietario->identificacion }}" name="apellidos" type="text" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>*Nombres :</label>
								<input value="{{ $propietario->nombres }}"  name="nombres" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>*Apellidos :</label>
								<input value="{{ $propietario->apellidos }}"  name="apellidos" type="text" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email :</label>
								<input value="{{ $propietario->email }}"  name="email" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Telefono :</label>
								<input value="{{ $propietario->telefono }}"  name="telefono" type="text" class="form-control" >
							</div>
						</div>
					</div>
				</section>
				<!-- Step 3 -->
				<h5>Otros datos</h5>
				<section>
					<div class="row">
						<div class="col-md-6">
							<div class="da-card">
								<div class="da-card-content">
									<h5 class="h5 mb-3">Foto del animal</h5>
								</div>
								<div class="da-card-photo">
									<img src="{{ asset('plantilla/vendors/images/photo3.jpg') }}" alt="">
									<div class="da-overlay">
										<div class="da-social">
											<ul class="clearfix">
												<li><a href="#"><i class="fa fa-edit"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</section>
			</form>

		</div>
	</div>
	<script type="">

		$(document).ready(()=>{
			$(".actions ul li:nth-child(1) a").html("Anterior")
			$(".actions ul li:nth-child(2) a").html("Siguiente")
			$(".actions ul li:nth-child(3) a").html("Guardar cambios")

			$(".actions ul li:nth-child(3) a").click(()=>{
				loading(true, "Guardando informacion del animal...")
				$("#form-animal").submit()
			})
		})
	</script>
@endsection
