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
							<p class="text-center text-muted font-14">{{ $animal->tipo->nombre }}</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Mas información</h5>
								<ul>
									<li>
										<span>Raza:</span>
										{{ $animal->raza->nombre }}
									</li>
									<li>
										<span>Fecha de nacimiento:</span>
										{{ date('Y-m-d', strtotime($animal->fecha_nacimiento)) }}
									</li>
									<li>
										<span>Estado actual:</span>
										{{ $animal->_estado->nombre }}
									</li>
									<li>
										<span>Peso:</span>
										{{ $animal->peso }} Kg
									</li>
									<li>
										<span>Estado corporal:</span>
										{{ $animal->estado_corporal }}
									</li>
									<li>
										<span>Origen:</span>
										{{ $animal->origen->nombre }}
									</li>
								</ul>
								<br>
								<a href="{{ route('animal/editar') }}?id={{ $animal->id_animal }}" class="btn btn-primary">Editar</a>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Vacunas</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Propietario</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
												<div class="row">
													<div class="col-sm-12">
														<a href="{{ route('vacuna/registrar') }}?id_animal={{ $animal->id_animal }}" class="btn btn-primary pull-right" style="position: absolute; right: 20px;">+ Nueva vacuna</a>
													</div>
												</div>
												<div class="profile-timeline">
												@foreach($vacunas_by_month as $mes => $vacuna_by_month)
													<div class="timeline-month">
														<h5>{{ $mes }}</h5>
													</div>
													@foreach($vacuna_by_month['vacunas'] as $vacuna)
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">{{ $vacuna->dia_mes }}</div>
																<div class="task-name" 
																	@if($vacuna->id_dominio_estado == 23) 
																	style="color: #dc3545;" 
																	@endif
																	@if($vacuna->id_dominio_estado == 22) 
																	style="color: #28a745;" 
																	@endif>
																	@if($vacuna->id_dominio_estado == 22)
																	<i class="ion-android-alarm-clock"></i>
																	@endif <span class="cursor-pointer" onclick="location.href = '{{ route('vacuna/editar') }}?id_vacuna={{ $vacuna->id_vacuna }}'"><b>{{ strtoupper($vacuna->_estado->nombre) }}</b></span></div>
																<p><b>Vacuna: </b>{{ $vacuna->nombre }}</p>
																@if($vacuna->soporte)
																	<p><a target="_blank" href="{{ config('global.url_servidor')."files/".$vacuna->soporte }}">Ver soporte</a></p>
																@endif
																
																<div class="task-time">{{ date('H:i', strtotime($vacuna->fecha)) }}</div>
															</li>
														</ul>
													</div>
													@endforeach
												@endforeach
												</div>
											</div>
										</div>
										<!-- Timeline Tab End -->
										<!-- Tasks Tab start -->
										<div class="tab-pane fade" id="tasks" role="tabpanel">
											<div class="pd-30 profile-task-wrap">
												<div class="container pd-0">
													<div class="contact-directory-box">
														<div class="contact-dire-info text-center">
															<div class="contact-avatar">
																<span>
																	<img src="{{ $animal->propietario->url_imagen() }}" style="height: 100%;" alt="">
																</span>
															</div>
															<div class="contact-name">
																<h4>{{ $animal->propietario->nombre_completo() }}</h4>
																<p>{{ $animal->propietario->identificacion }}</p>
																<div class="work text-success"><i class="ion-android-person"></i> {{ $animal->propietario->email }}</div>
															</div>
														</div>
														<br>
														<div class="view-contact mt-2">
															<a href="{{ route("tercero/vista", $animal->id_tercero_propietario) }}" target="_blank">Ver mas</a>
														</div>
													</div>
													
												</div>
											</div>
										</div>
										<!-- Tasks Tab End -->
										<!-- Setting Tab start -->
										<div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form>
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
															<div class="form-group">
																<label>Full Name</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Title</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email">
															</div>
															<div class="form-group">
																<label>Date of birth</label>
																<input class="form-control form-control-lg date-picker" type="text">
															</div>
															<div class="form-group">
																<label>Gender</label>
																<div class="d-flex">
																<div class="custom-control custom-radio mb-5 mr-20">
																	<input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label weight-400" for="customRadio4">Male</label>
																</div>
																<div class="custom-control custom-radio mb-5">
																	<input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
																	<label class="custom-control-label weight-400" for="customRadio5">Female</label>
																</div>
																</div>
															</div>
															<div class="form-group">
																<label>Country</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
																	<option>United States</option>
																	<option>India</option>
																	<option>United Kingdom</option>
																</select>
															</div>
															<div class="form-group">
																<label>State/Province/Region</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Postal Code</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Phone Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Address</label>
																<textarea class="form-control"></textarea>
															</div>
															<div class="form-group">
																<label>Visa Card Number</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label>Paypal ID</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Social Media links</h4>
															<div class="form-group">
																<label>Facebook URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Twitter URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Linkedin URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Instagram URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Dribbble URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Dropbox URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Google-plus URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Pinterest URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Skype URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group">
																<label>Vine URL:</label>
																<input class="form-control form-control-lg" type="text" placeholder="Paste your link here">
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Save & Update">
															</div>
														</li>
													</ul>
												</form>
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