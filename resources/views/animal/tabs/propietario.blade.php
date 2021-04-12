<div class="pd-30 profile-task-wrap">
	<div class="container pd-0">
		<div class="contact-directory-box">
			<div class="contact-dire-info text-center">
				<div class="contact-avatar">
					<span>
						<img src="{{ $animal->propietario->url_imagen() }}" style="height: 100%;" alt="">
					</span>
				</div>
				<div class="contact-name">
					<h4>{{ $animal->propietario->nombre_completo() }}</h4>
					<p>{{ $animal->propietario->identificacion }}</p>
					<div class="work text-success"><i class="ion-android-person"></i> {{ $animal->propietario->email }}</div>
				</div>
			</div>
			<br>
			<div class="view-contact mt-2">
				<a href="{{ route("tercero/vista", $animal->id_tercero_propietario) }}" target="_blank">Ver mas</a>
			</div>
		</div>
	</div>
</div>