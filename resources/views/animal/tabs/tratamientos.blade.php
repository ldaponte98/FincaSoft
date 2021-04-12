<div class="pd-20">
	<div class="row">
		<div class="col-sm-12">
			<a href="{{ route('tratamiento/registrar') }}?animal={{ $animal->id_animal }}" class="btn btn-primary pull-right">+ Nuevo tratamiento</a>
		</div>
		@if(count($tratamientos_por_mes) == 0)
		<div class="col-sm-12">
			<br><br>
			<center>
				<h6 style="color: #dedede;"><i>No tiene tratamientos registradas</i></h6><br>
				<img src="{{ asset('images/vacuna.png') }}">
			</center>
		</div>
		
			
		@endif
	</div>
	<div class="profile-timeline">

	@foreach($tratamientos_por_mes as $mes => $tratamiento_por_mes)
		<div class="timeline-month">
			<h5>{{ $mes }}</h5>
		</div>
		@foreach($tratamiento_por_mes['tratamientos'] as $tratamiento)
		<div class="profile-timeline-list">
			<ul>
				<li>
					<div class="date">{{ $tratamiento->dia_mes }}</div>
					<div class="task-name" 
						@if($tratamiento->id_dominio_estado == 23) 
						style="color: #dc3545;" 
						@endif
						@if($tratamiento->id_dominio_estado == 22) 
						style="color: #28a745;" 
						@endif>
						@if($tratamiento->id_dominio_estado == 22)
						<i class="ion-android-alarm-clock"></i>
						@endif <span class="cursor-pointer" onclick="location.href = '{{ route('tratamiento/editar') }}?tratamiento={{ $tratamiento->id_tratamiento }}'"><b>{{ strtoupper($tratamiento->_estado->nombre) }}</b></span></div>
					<p><b>{{ $tratamiento->tipo->nombre }}: </b>{{ $tratamiento->nombre }}</p>
					@if($tratamiento->soporte)
						<p><a target="_blank" href="{{ config('global.url_servidor')."files/".$tratamiento->soporte }}">Ver soporte</a></p>
					@endif
					
					<div class="task-time">{{ date('H:i', strtotime($tratamiento->fecha)) }}</div>
				</li>
			</ul>
		</div>
		@endforeach
	@endforeach
	</div>
</div>