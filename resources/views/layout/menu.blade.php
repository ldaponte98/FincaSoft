@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
<div class="brand-logo">
	<a>
		<center>
			<img src="{{ asset('images/logo_negro.png') }}" alt="" style="height: 60px;" class="dark-logo">
			<img src="{{ asset('images/logo.png') }}" alt="" style="height: 60px;" class="light-logo">
		</center>
	</a>
	<div class="close-sidebar" data-toggle="left-sidebar-close">
		<i class="ion-close-round"></i>
	</div>
</div>
<div class="menu-block customscroll">
	<div class="sidebar-menu">
		<ul id="accordion-menu">
			<li class="dropdown">
				<a href="{{ route('sitio/panel') }}" class="dropdown-toggle no-arrow">
					<span class="micon dw dw-house"></span><span class="mtext">Mi Finca</span>
				</a>
			</li>
			<li class="dropdown">
				<a href="javascript:;" class="dropdown-toggle">
					<span class="micon dw dw-rabbit"></span><span class="mtext">Animales</span>
				</a>
				<ul class="submenu">
					<li><a href="{{ route('animal/registrar') }}">Registrar animal</a></li>
					<li><a href="{{ route('animal/inventario') }}">Inventario animales</a></li>
				</ul>
			</li>

			<li class="dropdown">
				<a href="{{ route('tratamiento/listado') }}" class="dropdown-toggle no-arrow">
					<span class="micon dw dw-syringe"></span><span class="mtext">Tratamientos</span>
				</a>
			</li>

			<li class="dropdown">
				<a href="{{ route('pesaje/listado') }}" class="dropdown-toggle no-arrow">
					<span class="micon dw dw-balance"></span><span class="mtext">Pesajes</span>
				</a>
			</li>

			<li class="dropdown">
				<a href="{{ route('produccion/listado') }}" class="dropdown-toggle no-arrow">
					<span class="micon dw dw-milk"></span><span class="mtext">Producción</span>
				</a>
			</li>

			<li class="dropdown">
				<a href="{{ route('caja/listado') }}" class="dropdown-toggle no-arrow">
					<span class="micon dw dw-money-2"></span><span class="mtext">Contabilidad</span>
				</a>
			</li>
			@if ($usuario->id_perfil == 1 || $usuario->id_perfil == 2)
				<li class="dropdown">
					<a href="{{ route('usuario/listado') }}" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-user"></span><span class="mtext">Usuarios</span>
					</a>
				</li>
			@endif
			@if ($usuario->id_perfil == 1)
				<li class="dropdown">
					<a href="{{ route('dominio/listado') }}" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-book2"></span><span class="mtext">Dominios</span>
					</a>
				</li>
			@endif
		</ul>
	</div>
</div>