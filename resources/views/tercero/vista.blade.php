@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Tercero</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Vista</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información del tercero</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection
@extends('layout.principal')

@section('content')
	<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<img src="{{ $tercero->url_imagen() }}" style="height: 150px;" alt="" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-0">{{ strtoupper($tercero->nombre_completo()) }}</h5>
							<p class="text-center text-muted font-14">Propietario</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Mas información</h5>
								<ul>
									<li>
										<span>Nombre completo:</span>
										{{ $tercero->nombres }}
									</li>
									<li>
										<span>Apellido completo:</span>
										{{ $tercero->apellidos }}
									</li>
									<li>
										<span>Tipo de identificacion:</span>
										{{ $tercero->tipo_identificacion->nombre }}
									</li>
									<li>
										<span>Identificacion:</span>
										{{ $tercero->identificacion }}
									</li>
									<li>
										<span>Correo electronico:</span>
										{{ $tercero->email }}
									</li>
									<li>
										<span>Telefono:</span>
										{{ $tercero->telefono }}
									</li>
								</ul>
								<br>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#activos" role="tab">Activos</a>
										</li>
										
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="activos" role="tabpanel">
											<div class="pd-30 profile-task-wrap">
												<div class="container pd-0">
													<div class="row">
														@foreach($tercero->animales as $animal)
														<div class="col-sm-6">
															<div class="contact-directory-box">
																<div class="contact-dire-info text-center">
																	<div class="contact-avatar">
																		<span>
																			<img src="{{ $animal->url_imagen() }}" style="height: 100%;" alt="">
																		</span>
																	</div>
																	<div class="contact-name">
																		<h4>{{ strtoupper($animal->referencia) }}</h4>
																		<p>{{ $animal->tipo->nombre }} - {{ $animal->raza->nombre }}</p>
																		<div class="work text-success"><b>Estado: </b>{{ $animal->_estado->nombre }}</div>
																	</div>
																</div>
																<br>
																<div class="view-contact mt-2">
																	<a  href="{{ route('animal/vista', $animal->id_animal) }}" target="_blank">Ver mas</a>
																</div>
															</div>
														</div>
														@endforeach
													</div>
													
												</div>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection