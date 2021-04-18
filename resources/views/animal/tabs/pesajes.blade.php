<div class="pd-20">
	<div class="row">
		<div class="col-sm-12">
			@if ($animal->estado == 1)
				<a href="{{ route('pesaje/registrar') }}?animal={{ $animal->id_animal }}" class="btn btn-primary pull-right">+ Nuevo pesaje</a>
			@endif
		</div>
		@if(count($pesajes_por_mes) == 0)
		<div class="col-sm-12">
			<br><br>
			<center>
				<h6 style="color: #dedede;"><i>No tiene pesajes registrados</i></h6><br>
				<img src="{{ asset('images/vacuna.png') }}">
			</center>
		</div>
		@endif
	</div>
	<div class="profile-timeline">

	@foreach($pesajes_por_mes as $mes => $pesaje_por_mes)
		<div class="timeline-month">
			<h5>{{ $mes }}</h5>
		</div>
		@foreach($pesaje_por_mes['pesajes'] as $pesaje)
		<div class="profile-timeline-list">
			<ul>
				<li>
					<div class="date">{{ $pesaje->dia_mes }}</div>
					@php
						$estado = "Estable"
					@endphp
					<div class="task-name" 
						@if($pesaje->peso_anterior > $pesaje->peso_medido) 
						style="color: #dc3545;"
						@php $estado = "Bajo" @endphp 
						@endif
						@if($pesaje->peso_anterior == $pesaje->peso_medido) 
						style="color: #ffc107;" 
						@php $estado = "Estable" @endphp 
						@endif
						@if($pesaje->peso_anterior < $pesaje->peso_medido) 
						style="color: #28a745;"
						@php $estado = "Subio" @endphp  
						@endif>
						<span class="cursor-pointer" onclick="location.href = '{{ route('pesaje/editar') }}?pesaje={{ $pesaje->id_animal_pesaje }}'"><b>{{ strtoupper($estado) }}</b></span></div>
					<p class="mb-0"><b>Pesaje: </b>{{ $pesaje->peso_medido }} Kg</p>
					<small>Pesaje anterior: {{ $pesaje->peso_anterior }} Kg</small>
					<div class="task-time">{{ date('H:i', strtotime($pesaje->fecha)) }}</div>
				</li>
			</ul>
		</div>
		@endforeach
	@endforeach
	</div>
</div>