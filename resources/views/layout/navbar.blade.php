@php
	$usuario = \App\Usuario::find(session('id_usuario'));
	$vacunas_pendientes = \App\Vacuna::all()->where('estado', 1)
									 		->where('id_dominio_estado', 22);

@endphp
<div class="dashboard-setting user-notification">
	<div class="dropdown">
		<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
			<i class="dw dw-settings2"></i>
		</a>
	</div>
</div>

<div class="user-notification">
	<div class="dropdown">
		<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
			<i class="icon-copy dw dw-notification"></i>
			@if(count($vacunas_pendientes) > 0) <span class="badge notification-active"></span> @endif
		</a>
		<div class="dropdown-menu dropdown-menu-right">
			<div class="notification-list mx-h-350 customscroll">
				
				<ul>
					@foreach($vacunas_pendientes as $vacuna)
					<li>
						<a href="{{ route('animal/vista', $vacuna->id_animal) }}">
							<img src="{{ $vacuna->animal->url_imagen() }}" alt="">
							<h3>{{ $vacuna->animal->referencia }} - {{ $vacuna->animal->tipo->nombre }}</h3>
							<p>Tiene un vacuna programada para el {{ date('d/m/Y', strtotime($vacuna->fecha)) }} a las {{ date('H:i', strtotime($vacuna->fecha)) }}</p>
						</a>
					</li>
					@endforeach
					@if(count($vacunas_pendientes) == 0) 
					<li>
						<center><i>No tienes eventos pendientes</i></center>
					</li> 
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="user-info-dropdown">
	<div class="dropdown">
		<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
			<span class="user-icon">
				<img src="{{ asset('plantilla/vendors/images/photo1.jpg') }}" alt="">
			</span>
			<span class="user-name">{{ $usuario->tercero->nombres }}</span>
		</a>
		<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
			<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Perfil</a>
			<a class="dropdown-item" href="{{ route('cerrar_sesion') }}"><i class="dw dw-logout"></i> Salir</a>
		</div>
	</div>
</div>

 {{ view('layout.sidebarDesing') }}