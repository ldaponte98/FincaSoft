<!DOCTYPE html>
<html>
<head>
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
	<link rel="stylesheet" type="text/css" href="{{ asset('plantilla/vendors/styles/style.css') }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-119386393-1');
	</script>
	<style type="text/css">
		.login-wrap {
		    height: calc(100%);
		}
		.btn-primary {
		    color: #fff;
		    background-color: #0b132b;
		    border-color: #0b132b;
		}
		.text-primary {
		    color: #0b132b!important;
		}
	</style>
</head>
<body class="login-page">
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<center>
						<img src="{{ asset('images/logo_negro.png') }}" alt="">
					</center>
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Inicio de sesión</h2>
						</div>
						<form action="{{ route('validar_login') }}" method="post" id="form-login">
							@csrf
							<div class="input-group custom">
								<input name="usuario" type="text" class="form-control form-control-lg" placeholder="Usuario">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input name="clave" type="password" class="form-control form-control-lg" placeholder="Contraseña">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Recordarme</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="#">Olvide mi contraseña</a></div>
								</div>
							</div>
							@if ($errors->first('mensaje') != "")
								<div class="row mb-1" id="msg">
									<div class="col-sm-12">
										<center>
											<div class="alert alert-danger">
												<b><?= $errors->first('mensaje')?></b>
											</div>
										</center>
										<script>
											setTimeout(()=>{$("#msg").fadeOut()}, 5000)
										</script>
									</div>
								</div>
							@endif
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button class="btn btn-primary btn-lg btn-block" type="submit">Ingresar</button>
									</div>
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{ asset('plantilla/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('plantilla/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('plantilla/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('plantilla/vendors/scripts/layout-settings.js') }}"></script>
</body>
</html>