@php
	$usuario = \App\Usuario::find(session('id_usuario'));
@endphp
@extends('layout.principal')
@section('header_content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4>Animal</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Listado de animales</a></li>
						<li class="breadcrumb-item active" aria-current="page">Información de los animales</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('content')

<div class="row">
	<div class="col-xl-3 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-analytics-4"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">{{ count(\App\Animal::all()) }}</div>
					<div class="weight-600 font-14">Total</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-analytics-8"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">{{ count(\App\Animal::all()->where('prenado', 1)) }}</div>
					<div class="weight-600 font-14">Preñados</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-analytics-10"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">{{ count(\App\Animal::all()->where('id_dominio_origen', 14)) }}</div>
					<div class="weight-600 font-14">De la finca</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 mb-30">
		<div class="card-box height-100-p widget-style1">
			<div class="d-flex flex-wrap align-items-center">
				<div class="progress-data">
					<center><i class="icon-card icon-copy dw dw-battery"></i></center>
				</div>
				<div class="widget-data">
					<div class="h4 mb-0">{{ count(\App\Animal::all()->where('id_dominio_estado', 12)) }}</div>
					<div class="weight-600 font-14">En ordeño</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-sm-6">
				<h4 class="text-blue h4">Todos los animales registrados</h4>
			</div>
		</div>
	</div>

	<div class="pl-20 pr-20">
		<form method="POST">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Raza</b></label>
						<select class="custom-select2 form-control" name="id_dominio_raza" style="width: 100%; height: 38px;" >
							<option value="0">Todas</option>
							@foreach(\App\Dominio::all()->where('id_padre', 2) as $dom)
							<option @if($id_dominio_raza == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Estado</b></label>
						<select class="custom-select2 form-control" name="id_dominio_estado" style="width: 100%; height: 38px;" >
							<option value="0">Todos</option>
							@foreach(\App\Dominio::all()->where('id_padre', 3) as $dom)
							<option @if($id_dominio_estado == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Preñado</b></label>
						<select class="custom-select2 form-control" name="prenado" style="width: 100%; height: 38px;" >
							<option @if ($prenado == -1) selected @endif value="-1">Sin discriminar</option>
							<option @if ($prenado == 1) selected @endif value="1">Si</option>
							<option @if ($prenado == 0) selected @endif value="0">No</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Propietario</b></label>
						<select class="custom-select2 form-control" name="id_tercero_propietario" style="width: 100%; height: 38px;" >
							<option value="0">Todos</option>
							@foreach($propietarios as $p)
							<option @if($p->id_tercero == $id_tercero_propietario) selected @endif value="{{ $p->id_tercero }}">{{ $p->propietario }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Rango de edad</b></label>
						<div style="display: flex;">
							<input type="number" name="edad_inicio" class="form-control" value="{{ $edad_inicio }}" placeholder="Edad inicial">
							<label class="mr-2 ml-2"> &nbsp; </label>
							<input type="number" name="edad_fin" class="form-control" value="{{ $edad_fin }}" placeholder="Edad final">
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Rango de peso</b></label>
						<div style="display: flex;">
							<input type="number" name="peso_inicio" class="form-control" value="{{ $peso_inicio }}" placeholder="Peso inicial">
							<label class="mr-2 ml-2"> &nbsp; </label>
							<input type="number" name="peso_fin" class="form-control" value="{{ $peso_fin }}" placeholder="Peso final">
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Origen</b></label>
						<select class="custom-select2 form-control" name="id_dominio_origen" style="width: 100%; height: 38px;" >
							<option value="0">Todos</option>
							@foreach(\App\Dominio::all()->where('id_padre', 4) as $dom)
							<option @if($id_dominio_origen == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
							@endforeach
						</select>
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
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label><b>Sexo</b></label>
						<select class="custom-select2 form-control" name="id_dominio_sexo" style="width: 100%; height: 38px;" >
							<option value="0">Todos</option>
							@foreach(\App\Dominio::all()->where('id_padre', 24) as $dom)
							<option @if($id_dominio_sexo == $dom->id_dominio) selected @endif value="{{ $dom->id_dominio }}">{{ $dom->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<button class="btn btn-primary w-100"><i class="micon dw dw-search"></i> Filtrar</button>
				</div>
			</div>
		</form>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover nowrap">
			<thead>
				<tr>
					<th><center><span class="micon dw dw-rabbit datatable-nosort"></span></center></th>
					<th><center>Animal</center></th>
					<th><center>Raza</center></th>
					<th><center>Peso Actual</center></th>
					<th><center>Nacimiento</center></th>
					<th><center>Estado</center></th>
					<th><center>Preñado</center></th>
					<th><center>Sexo</center></th>
					<th><center>Color</center></th>
					<th><center>Edad</center></th>
					<th><center>Propietario</center></th>
					<th class="datatable-nosort"><center>Acciones</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($animales as $item)
					<tr>
						<td><center><img class="img-table" src="{{ $item->url_imagen() }}"></center></td>
						<td><center>{{ $item->referencia }} - {{ $item->tipo->nombre }}</center></td>
						<td><center>{{ $item->raza->nombre }}</center></td>
						<td><center>{{ $item->peso }} Kg</center></td>
						<td><center><b>{{ $item->origen->nombre }}</b> - {{ date("d/m/Y", strtotime($item->fecha_nacimiento)) }}</center></td>
						<td><center>{{ $item->_estado->nombre }}</center></td>
						<td><center>{{ $item->prenado == 1 ? "Si" : "No" }}</center></td>
						<td><center>{{ $item->sexo->nombre }}</center></td>
						<td><center><div style=" width: 20px; height: 20px; background: {{ $item->color }};">
							{{ $item->color == null ? "Indefinido" : "" }}</div></center></td>
						<td><center>{{ $item->edad() }} años</center></td>
						<td><center>{{ $item->propietario->nombre_completo() }}</center></td>
						<td>
							<center>
							<div class="dropdown">
								<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									<i class="dw dw-more"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
									<a class="dropdown-item" 
									   href="{{ route('animal/vista', $item->id_animal) }}">
									   <i class="dw dw-eye"></i> Más</a>

									<a class="dropdown-item" 
									   href="{{ route('animal/editar') }}?id={{ $item->id_animal }}">
									   <i class="dw dw-pencil"></i> Editar</a>
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
@endsection