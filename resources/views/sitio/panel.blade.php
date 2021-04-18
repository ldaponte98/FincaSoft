@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')

@section('content')
<style>
	.browser-visits ul li .browser-name {
	    width: calc(100% - 190px);
	    font-size: 14px;
	    font-weight: 600;
	    margin-left: 5px;
	}	
	.img-table {
	    width: 100px;
	    height: 100px;
	    border-radius: 10px;
	    -webkit-box-shadow: 1px 2px 13px rgb(0 0 0 / 20%);
	    box-shadow: 1px 2px 13px rgb(0 0 0 / 20%);
	}
	.info-prenado{
		padding-top: 5px;
		margin-left: 10px;
	}
	.info-prenado h3{
		margin-bottom: 0px;
	}
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box pd-20 height-100-p mb-30">
			<div class="row align-items-center">
				<div class="col-md-4">
					<img src="{{ asset('plantilla/vendors/images/banner-img.png') }}" alt="">
				</div>
				<div class="col-md-8">
					<h4 class="font-20 weight-500 mb-10 text-capitalize">
						Bienvenido <div class="weight-600 font-30 text-blue">{{ $usuario->tercero->nombres }}!</div>
					</h4>
					<p class="font-18 max-width-600">Aquí podrás ver información importante de tu empresa y te mantendremos informado de todas las actividades que debes tener en cuenta para mejorar la productividad de tu negocio.</p>
				</div>
			</div>
		</div>
	</div>
</div><br>
<div class="row">
	<div class="col-sm-6">
		<div class="card-box pd-20 height-100-p mb-30">
			<h2 class="mb-10 h4">Proximos a parir</h2>
			@foreach ($prenados as $animal)
				<div class="row align-items-center">
					<div class="col-md-8">
						<div class="d-flex">
							<img class="img-table" src="{{ $animal->url_imagen() }}" alt="">
							<div class="info-prenado">
								<h3 class="h6"><b>{{ $animal->referencia }}</b></h3>
								<small class="text-muted"><b>{{ $animal->tipo->nombre }}</b></small><br>
								<small class="text-muted"><b>Edad: </b>{{ $animal->edad() }} años</small><br>
								<span class="badge badge-warning">{{ $animal->dias_restantes_parir() }} dias para parto</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<a href="{{ route('animal/parto', $animal->id_animal) }}" class="badge badge-pill pull-right btn-titilante badge-primary">¡Ya pario!</a>
					</div>
				</div>
				<hr>
			@endforeach
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card-box pd-20 height-100-p mb-30">
			<h2 class="mb-10 h4">Tratamientos programados</h2>
			@foreach ($tratamientos as $tratamiento)
				<div class="row align-items-center">
					<div class="col-md-8">
						<div class="d-flex">
							<img class="img-table" src="{{ $tratamiento->animal->url_imagen() }}" alt="">
							<div class="info-prenado">
								<h3 class="h6"><b>{{ $tratamiento->animal->referencia }} - {{ $tratamiento->animal->tipo->nombre }}</b></h3>
								<small class="text-muted"><b>{{ $tratamiento->tipo->nombre }}: </b>{{ $tratamiento->nombre }}</small><br>
								<small class="text-muted"><b>Edad: </b>{{ $tratamiento->animal->edad() }} años</small><br>
								<span class="badge badge-warning">Programada para el {{ date('d/m/Y', strtotime($tratamiento->fecha)) }} a las {{ date('H:i', strtotime($tratamiento->fecha)) }} </span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<a href="{{ route('tratamiento/editar') }}?tratamiento={{ $tratamiento->id_tratamiento }}" class="badge badge-pill pull-right btn-titilante badge-primary">¡Aplicar o cancelar!</a>
					</div>
				</div>
				<hr>
			@endforeach
		</div>
	</div>
</div><br>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box pd-30 pt-10 height-100-p">
			<center><h2 class="mb-30 h4">Top 10 producción</h2></center>
			<div class="browser-visits">
				<ul>
					@foreach ($top_produccion as $animal)
						<li class="d-flex flex-wrap align-items-center">
						<div><img class="img-thumbnail mr-2" src="{{ $animal->imagen != "" ? config('global.url_imagenes').'/animales/'.$animal->imagen : config('global.sin_imagen')  }}" style="width: 80px; height: 80px;" alt=""></div>
						<div class="browser-name"> <a href="{{ route('animal/vista', $animal->id_animal) }}"> {{ $animal->nombre }} </a></div>
						<div class="visit">
							<span class="badge badge-pill badge-primary">{{ $animal->total }} {{ $animal->unidad_medida }}</span>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div><br><br>
	
@endsection