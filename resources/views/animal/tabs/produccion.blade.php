<div class="pd-20">
	<div class="row">
		<div class="col-sm-12">
			<a href="{{ route('produccion/registrar') }}?animal={{ $animal->id_animal }}" class="btn btn-primary pull-right">+ Nueva producción</a>
		</div>
		@if(count($producciones_por_mes) == 0)
		<div class="col-sm-12">
			<br><br>
			<center>
				<h6 style="color: #dedede;"><i>No tiene producciones registradas</i></h6><br>
				<img src="{{ asset('images/vacuna.png') }}">
			</center>
		</div>
		@endif
	</div>
	<div class="profile-timeline">

	@foreach($producciones_por_mes as $mes => $produccion_por_mes)
		<div class="timeline-month">
			<h5>{{ $mes }}</h5>
		</div>
		@foreach($produccion_por_mes['producciones'] as $produccion)
		<div class="profile-timeline-list">
			<ul>
				<li>
					<div class="date">{{ $produccion->dia_mes }}</div>
					<div class="task-name" style="color: #1b00ff;">
						<span class="cursor-pointer" onclick="location.href = '{{ route('produccion/editar') }}?produccion={{ $produccion->id_animal_produccion }}'"><b>{{ strtoupper($produccion->concepto->nombre) }}</b></span></div>
					<p><b>Producción: </b>{{ $produccion->valor_produccion }} {{ $produccion->unidad_medida->nombre }}</p>

					<div class="task-time">{{ date('d/m/Y', strtotime($produccion->fecha_inicio)) }} - {{ date('d/m/Y', strtotime($produccion->fecha_fin)) }}</div>
				</li>
			</ul>
		</div>
		@endforeach
	@endforeach
	</div>
</div>