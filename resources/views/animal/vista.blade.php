@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Animal</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Vista</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del animal</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection
@extends('layout.principal')

@section('content')
	<style type="text/css">
		div.img-main{
		  display:table;
		}
		div.img-main img{
		 	margin:0;
		 	padding:0;
		}
		div.img-main span{
			line-height: normal;
		    font-size: 14px;
		    display: table-caption;
		    margin: 0;
		    padding: 0;
		    background: #646464;
		    color: white;
		    font-weight: 800;
		    text-align: center;
		    position: relative;
		    height: 0;
		    top: 65px;
		}
		div.img-main span span{
			background:rgba(0, 0, 0, 0.4);
			display:block;
			padding-top: 10px;
			text-shadow:0 0 15px white;
		}
		div.baja{
			background-color: red;
		    padding: 2px;
		    transform: rotate(-45deg);
		    margin-left: 3.7px;
		    margin-right: 2.5px;
		}
	</style>
	@if(session('message'))
	<script>
		toastr.success("{{ session('message') }}", "Información");
	</script>
	@endif
	<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo img-main">
								<img src="{{ $animal->url_imagen() }}" style="height: 150px;" alt="" class="avatar-photo">
								@if ($animal->estado == 0)
									<span><div class="baja">DADO DE BAJA</div></span>
								@endif
							</div>
							<h5 class="text-center h5 mb-0">Referencia {{ strtoupper($animal->referencia) }}</h5>
							<p class="text-center text-muted font-14 mb-0">{{ $animal->tipo->nombre }}</p>
							@if ($animal->estado == 0)
							<p class="text-center text-muted font-14 mb-0">
								<b>
									<span data-toggle="tooltip" title="MOTIVO DE BAJA: {{ strtoupper($animal->motivo_anulacion) }}">
										<i class="icon-copy dw dw-notebook"></i>
									</span>
								</b>
							</p>
							@endif
							@if($animal->prenado == 1)
								<h5 class="text-center h5 text-blue mb-2">Aproximadamente a {{ $animal->dias_restantes_parir() }} para parir</h5>
								@if ($animal->estado == 1)
									<center>
										<a href="{{ route('animal/parto', $animal->id_animal) }}" class="btn btn-primary">!Ya tuvo el parto!</a>
									</center>
								@endif
							@endif
							<br>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Mas información</h5>
								<ul>
									<li>
										<span>Sexo</span>
										{{ $animal->sexo->nombre }}
									</li>
									<li>
										<span>Color de referencia</span>

										<div style="
										     width: 20px; 
										     height: 20px; 
										     background: {{ $animal->color }};
										">@if ($animal->color == null) No definido @endif</div>
									</li>
									<li>
										<span>Raza</span>
										{{ $animal->raza->nombre }}
									</li>
									<li>
										<span>Fecha de nacimiento</span>
										{{ date('d-m-Y', strtotime($animal->fecha_nacimiento)) }}
									</li>
									<li>
										<span>Edad</span>
										{{ $animal->edad() }} años
									</li>
									<li>
										<span>Estado actual</span>
										{{ $animal->_estado->nombre }}
									</li>
									<li>
										<span>Peso</span>
										{{ $animal->peso }} Kg
									</li>
									<li>
										<span>Estado corporal</span>
										{{ $animal->estado_corporal }}
									</li>
									<li>
										<span>Origen</span>
										{{ $animal->origen->nombre }}
									</li>
									
									<li>
										<span>Preñado</span>
										{{ ($animal->prenado == 1) ? "Si" : "No" }}
									</li>
								</ul>
							</div>
								@if($animal->prenado == 1)
								<div class="profile-info">
									<h5 class="mb-20 h5 text-blue">Proceso de gestación</h5>
										<ul>
											<li>
												<span>Dias Preñado</span>
												{{ $animal->dias_prenado() }} días
											</li>
											<li>
												<span>Fecha aproximada de inicio de gestación</span>
												{{ date('d-m-Y', strtotime($animal->fecha_deteccion_prenado)) }}
											</li>
											<li>
												<span>Días promedio de gestación</span>
												283 días
											</li>
											<li>
												<span>Dias promedio restantes para parto</span>
												{{ $animal->dias_restantes_parir() }} días
											</li>
										</ul>
									
									<br>
								</div>
								@endif
								@if ($animal->estado == 1)
									<div class="row">
										<div class="col-sm-6">
											<a href="{{ route('animal/editar') }}?id={{ $animal->id_animal }}" class="btn btn-primary w-100">Editar información</a>
										</div>
										<div class="col-sm-6">
											<a onclick="DarDeBaja({{ $animal->id_animal }})" class="btn btn-danger w-100" style="color: white;">Dar de baja</a>
										</div>
									</div>
								@endif
							<center>

								
							</center>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#vacunas" role="tab">Tratamientos</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#propietario" role="tab">
											Propietario</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#parentescos" role="tab">
											Parentescos</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#pesajes" role="tab">
											Pesajes</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#producciones" role="tab">
											Producciones</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="vacunas" role="tabpanel">
											{{ view("animal.tabs.tratamientos", compact(["animal", "tratamientos_por_mes"])) }}
										</div>
										
										<div class="tab-pane fade" id="propietario" role="tabpanel">
											{{ view("animal.tabs.propietario", compact(["animal"])) }}
										</div>

										<div class="tab-pane fade" id="parentescos" role="tabpanel">
											{{ view("animal.tabs.parentescos", compact(["animal"])) }}
										</div>

										<div class="tab-pane fade" id="pesajes" role="tabpanel">
											{{ view("animal.tabs.pesajes", compact(["animal", "pesajes_por_mes"])) }}
										</div>

										<div class="tab-pane fade" id="producciones" role="tabpanel">
											{{ view("animal.tabs.produccion", compact(["animal", "producciones_por_mes"])) }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@csrf
		<script>
			function DarDeBaja(id_animal) {
				let confirmacion = confirm("¿Seguro que desea dar de baja a este animal?")
				if(confirmacion){
					var motivo = prompt("Por favor describe el motivo por el cual daras de baja a este animal", "");
					if(motivo.trim() != ""){
						loading(true, "Bajando animal...")
						let _token = $('input[name=_token]')[0].value
						let request = { '_token' : _token , 'motivo' : motivo, 'id_animal' : id_animal}
						let url = "{{ route('animal/anular') }}"
						$.post(url, request, (response) => {
							loading(false)
							if(!response.error){
								toastr.success("Animal dado de baja exitosamente")
								location.reload()
							}else{
								toastr.error(response.message)
							}
						})
						.fail((error) => {
							loading(false)
							toastr.error("Ocurrio un error al dar de baja al animal")
						})
					}else{
						alert("El motivo es un campo obligatorio")
					}
				}
			}
		</script>
		@endsection