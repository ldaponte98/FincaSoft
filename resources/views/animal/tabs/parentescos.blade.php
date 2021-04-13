<div class="pd-30 profile-task-wrap">
	<div class="container pd-0">
		<div class="row">
			<div class="col-sm-6">
				<div class="contact-directory-box">
					<div class="contact-dire-info text-center">
						<div class="contact-avatar">
							<span>
								<img src="{{ $animal->padre ? $animal->padre->url_imagen() : config('global.sin_imagen') }}" style="height: 100%;" alt="">
							</span>
						</div>
						<div class="contact-name">
							<h4>{{ $animal->padre ? $animal->padre->referencia : "No definido" }}</h4>
							<p>{{  $animal->padre ? $animal->padre->tipo->nombre : "Tipologia no definida" }}</p>
						</div>
					</div>
					<br>
					<div class="view-contact mt-2">
						<a href="{{ $animal->padre ? route("animal/vista", $animal->padre->id_animal) : "#" }}" @if($animal->padre) target="_blank" @endif>Padre</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="contact-directory-box">
					<div class="contact-dire-info text-center">
						<div class="contact-avatar">
							<span>
								<img src="{{ $animal->madre ? $animal->madre->url_imagen() : config('global.sin_imagen') }}" style="height: 100%;" alt="">
							</span>
						</div>
						<div class="contact-name">
							<h4>{{ $animal->madre ? $animal->madre->referencia : "No definido" }}</h4>
							<p>{{  $animal->madre ? $animal->madre->tipo->nombre : "Tipologia no definida" }}</p>
						</div>
					</div>
					<br>
					<div class="view-contact mt-2">
						<a href="{{ $animal->madre ? route("animal/vista", $animal->madre->id_animal) : "#" }}" @if($animal->madre) target="_blank" @endif>Madre</a>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>