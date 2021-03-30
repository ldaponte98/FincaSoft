@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')

@section('content')
	<div class="card-box pd-20 height-100-p mb-30">
		<div class="row align-items-center">
			<div class="col-md-4">
				<img src="{{ asset('plantilla/vendors/images/banner-img.png') }}" alt="">
			</div>
			<div class="col-md-8">
				<h4 class="font-20 weight-500 mb-10 text-capitalize">
					Bienvenido <div class="weight-600 font-30 text-blue">{{ $usuario->tercero->nombres }}!</div>
				</h4>
				<p class="font-18 max-width-600"></p>
			</div>
		</div>
	</div>
	{{ view('sitio.1') }}
	{{ view('sitio.2') }}
	<script type="text/javascript">
		var request = {
			'almacen' : null
		};


	</script>
@endsection