<div class="menu-icon dw dw-menu"></div>
<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
<div class="header-search">
	<div class="form-group mb-0">
		<i class="dw dw-search2 search-icon"></i>
		<input type="text" class="form-control search-input" onkeyup="Buscar(this.value)" placeholder="Consulta aquí">
		<div class="dropdown">
			<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
				<i class="ion-arrow-down-c"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" id="content_search">
				<a class="link_search" href="">Bovino - 100659384728</a><hr>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function Buscar(caracteres) {
		if(caracteres.length >= 3){
			let url	= "{{ config('global.url_servidor') }}sitio/buscar_tercero_animal/"+caracteres
			let cont = 0
			$.get(url, (response) => {
				let resultados = ""
				response.forEach((item) => {
					cont++
					let url_item = item.tipo == "animal" ? "{{ config('global.url_servidor') }}animal/vista/"+item.id : "{{ config('global.url_servidor') }}tercero/vista/"+item.id; 

					resultados += '<a class="link_search" href="'+url_item+'">'+item.nombre+'</a>'
					if(cont != response.length) resultados += '<hr>'
				})
				$("#content_search").html(resultados)
				$("#content_search").fadeIn()
			})
		}else{
			$("#content_search").html("")
			$("#content_search").fadeOut()
		}
	}

</script>