@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Contabilidad</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Reporte de caja</a></li>
						<li class="breadcrumb-item active" aria-current="page">Contabilidad de la finca</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')
@if(session('message'))
<script>
	toastr.success("{{ session('message') }}", "Información");
</script>
@endif

<div class="row">
	<div class="col-xl-4 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-money-1"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">${{ number_format($total_caja, 0, '.', '.') }}</div>
					<div class="weight-600 font-14">Caja</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-diamond"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">${{ number_format($total_ingresos, 0, '.', '.') }}</div>
					<div class="weight-600 font-14">Ingresos</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-shopping-cart"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">${{ number_format($total_egresos, 0, '.', '.') }}</div>
					<div class="weight-600 font-14">Egresos</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="text-blue h4">Registros contables</h4>
			</div>
			<div class="col-sm-6">
				<a href="{{ route('caja/registrar') }}" class="btn btn-primary pull-right">+ Nuevo registro</a>
			</div>
		</div>
		<form method="POST" id="form-list-caja">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Rango de consulta</b></label>
						<div style="display: flex;">
							<input type="date" name="fecha_inicio" class="form-control" value="{{ $fecha_inicio }}" placeholder="Edad inicial">
							<label class="mr-2 ml-2"> &nbsp; </label>
							<input type="date" name="fecha_fin" class="form-control" value="{{ $fecha_fin }}" 
							placeholder="Edad final">
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Usuario Registro</b></label>
						<select class="custom-select2 form-control" name="id_usuario_registra" style="width: 100%; height: 38px;" >
							<option value="0">Todos</option>
							@foreach(\App\Usuario::all() as $usu)
							<option @if($usu->id_usuario == $id_usuario_registra) selected @endif value="{{ $usu->id_usuario }}">{{ $usu->tercero->nombre_completo() }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-3"><br>
					<button class="btn btn-primary mt-2">Consultar</button>
				</div>
			</div>
		</form>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th><center><span class="micon dw dw-user2 datatable-nosort"></span></center></th>
					<th><center>Usuario Reg.</center></th>
					<th><center>Movimiento</center></th>
					<th><center>Valor</center></th>
					<th><center>Concepto</center></th>
					<th><center>Observaciones</center></th>
					<th><center>Fecha</center></th>
					<th><center>Anula</center></th>
					<th><center>Observaciones Anulación</center></th>
					<th><center>Fecha Anulación</center></th>
					
					<th><center>Estado</center></th>
					<th class="datatable-nosort"><center>Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($cajas as $item)
					<tr>
						<td><center><img class="img-table" src="{{ $item->usuario->tercero->url_imagen() }}"></center></td>
						<td><center>{{ $item->usuario->tercero->nombre_completo() }}</center></td>
						<td><center>{{ $item->movimiento->nombre }}</center></td>
						<td><center>${{ number_format($item->valor, 0, '.', '.') }}</center></td>
						<td><center>{{ $item->concepto }}</center></td>
						<td title="{{ $item->observaciones }}">
							<center>
								{{ strlen($item->observaciones) <= 20 ? $item->observaciones : substr($item->observaciones, 0, 20).'...' }}
							</center>
						</td>
						<td><center>{{ date("d/m/Y H:i", strtotime($item->created_at)) }}</center></td>
						<td><center>{{ $item->usuario_anula ? $item->usuario_anula->tercero->nombre_completo() : "Ninguno" }}</center></td>
						<td><center>{{ $item->observaciones_anula ? $item->observaciones_anula : "Ninguna" }}</center></td>
						<td><center>{{ $item->fecha_anula ? date("d/m/Y H:i", strtotime($item->fecha_anula)) : "Ninguna" }}</center></td>
						<td><center>{{ $item->estado == 1 ? "Activo" : "Anulado" }}</center></td>
						<td>
							<center>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									<a class="dropdown-item" 
									   href="{{ route('caja/editar') }}?caja={{ $item->id_caja }}">
									   <i class="dw dw-eye"></i> Más</a>
									   @if ($item->estado == 1 and ($usuario->id_perfil == 1 or $usuario->id_perfil == 2))
										   	<a class="dropdown-item" 
										   onclick="ValidarAnulacion({{ $item->id_caja }})">
										   <i class="dw dw-trash"></i> Anular</a>
									   @endif
									
								</div>
							</div>
							</center>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	function ValidarAnulacion(id_caja) {
		let confirmacion = confirm("¿Seguro que desea anular este documento?")
		if(confirmacion){
			var observaciones = prompt("Por favor describe el motivo por el cual anular este documento", "");
			if(observaciones.trim() != ""){
				loading(true, "Anulando documento...")
				let _token = $('input[name=_token]')[0].value
				let request = { '_token' : _token , 'observaciones' : observaciones, 'id_caja' : id_caja}
				let url = "{{ route('caja/anular') }}"
				$.post(url, request, (response) => {
					loading(false)
					if(!response.error){
						toastr.success("Documento anulado exitosamente")
						$("#form-list-caja").submit()
					}else{
						toastr.error(response.message)
					}
				})
				.fail((error) => {
					loading(false)
					toastr.error("Ocurrio un error al anular la factura")
				})
			}else{
				alert("Las observaciones de la anulacion son obligatorias")
			}
		}
	}
</script>
@endsection