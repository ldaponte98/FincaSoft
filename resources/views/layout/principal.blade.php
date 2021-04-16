<!DOCTYPE html>
<html>
<head>
	<html lang="es">
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>FincaSoft</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/src/plugins/jquery-steps/jquery.steps.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/vendors/styles/style.css') }}">
	<link rel="stylesheet" href="{{ asset('loader/css-loader.css') }}">
	<link rel="stylesheet" href="{{ asset('toastr/build/toastr.css') }}">
	<script src="{{ asset('plantilla/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('plantilla/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('plantilla/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('plantilla/vendors/scripts/layout-settings.js') }}"></script>
	
	<script src="{{ asset('plantilla/vendors/scripts/dashboard.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/jquery-steps/jquery.steps.js') }}"></script>
	<script src="{{ asset('toastr/toastr.js') }}"></script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		function loading(open = true,message = "Por favor espere...", timeout = null) {
			if(timeout){
				$("#loader").html('<div class="loader loader-default is-active" data-text="'+message+'"></div>')
				setTimeout(function() {
					$("#loader").html('')
				}, timeout);
				return true
			}
			if(open) $("#loader").html('<div class="loader loader-default is-active" data-text="'+message+'"></div>')
			if(!open) $("#loader").html('')
		}

		toastr.options = {
		  "positionClass": "toast-bottom-right"
		}
	</script>
	<style>
		.brand-logo{
			padding-top: 3px;
   		    padding-left: 40px;
		}
		.brand-logo a {
		    align-items: normal !important;
		}


		@media (max-width: 600px) {
			.brand-logo {
			    padding-top: 0px;
			    padding-left: 60px;
			}
		}
		.custom-file-label::after {
		    content: "Examinar";
		}
		.cursor-pointer{
			cursor: pointer;
		}

		.contact-directory-box {
		    min-height: auto;
		}

		.fa-trash{
			font-size: 20px;
		    color: red;
		    cursor: pointer;
		}

		.fa-bars{
			font-size: 20px;
		    color: blue;
		    cursor: pointer;
		}
		.icon-table{
			font-size: 20px;
		    color: blue;
		    cursor: pointer;
		}
		.img-table {
		    width: 50px;
		    height: 50px;
		    border-radius: 10px;
		    -webkit-box-shadow: 1px 2px 13px rgb(0 0 0 / 20%);
		    box-shadow: 1px 2px 13px rgb(0 0 0 / 20%);
		}
		.icon-card{
			font-weight: bold;
		    font-size: 50px;
		    color: #e6eaee;
		}
		.widget-style1{
			padding: 30px;
		}
	</style>
</head>
<body onclick='
		$("#content_search").html("")
		$("#content_search").fadeOut()'>
		
	<div id="loader"></div>
	{{ view('layout.loader') }}

	<div class="header">
		<div class="header-left"> {{ view('layout.buscador') }} </div>
		<div class="header-right"> {{ view('layout.navbar') }}</div>
	</div>

	<div class="left-side-bar">{{ view('layout.menu') }}</div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		@yield('header_content','')
		
        @yield('content','')


		<div class="footer-wrap pd-20 mb-20 card-box">
			Desarrolado por Luis Aponte <a href="ldaponte98@gmail.com" target="_blank">ldaponte98@gmail.com</a>
		</div>
	</div>
	<!-- js -->
	<script src="{{ asset('plantilla/vendors/scripts/steps-setting.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('plantilla/src/plugins/datatables/js/vfs_fonts.js') }}"></script>

	
	<!-- Datatable Setting js -->
	<script src="{{ asset('plantilla/vendors/scripts/datatable-setting.js') }}"></script>
</body>
</html>