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
							<div class="profile-photo">
								<img src="{{ $animal->url_imagen() }}" style="height: 150px;" alt="" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-0">Referencia {{ strtoupper($animal->referencia) }}</h5>
							<p class="text-center text-muted font-14 mb-0">{{ $animal->tipo->nombre }}</p>
							@if($animal->prenado == 1)
								<h5 class="text-center h5 text-blue mb-2">Aproximadamente a {{ $animal->dias_restantes_parir() }} para parir</h5>
								<center>
									<button class="btn btn-primary">!Ya tuvo el parto!</button>
								</center>
								
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
							<center>
								<a href="{{ route('animal/editar') }}?id={{ $animal->id_animal }}" class="btn btn-primary">Editar información</a>
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
		@endsection