<!DOCTYPE html>
<html lang="es">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
		<link rel="icon" type="image/png" href="<?= IMG ?>favicon.ico">
		<title><?= $data['page_tag'] ?></title>
		<!-- azia CSS -->
		<link rel="stylesheet" href="<?= PLUGINS ?>css/sweetalert2.css">
		<link rel="stylesheet" href="<?= CSS ?>azia.css">
	</head>

	<body class="az-body">

		<div class="az-signin-wrapper">
			<div class="az-card-signin">
				<div class="az-signin-header">
					<h2 class="text-center">Bienvenido de vuelta!</h2>
					<h4>Por favor inicie para continuar</h4>
					<form id="formLogin">
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="txtUser" name="txtUser" class="form-control" autofocus
								placeholder="Coloque su usurio o  email">
						</div><!-- form-group -->
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="txtPass" name="txtPass" class="form-control" placeholder="Ingresesu password">
						</div><!-- form-group -->
						<button type="submit" class="btn btn-az-primary btn-block btnLogin">Ingresar</button>
					</form>
				</div><!-- az-signin-header -->
			</div><!-- az-card-signin -->
		</div><!-- az-signin-wrapper -->
		<script>
		const base_url = "<?= base_url()?>";
		</script>
		<script src="<?= PLUGINS ?>js/jquery.min.js"></script>
		<script src="<?= PLUGINS ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?= PLUGINS ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?= PLUGINS ?>js/sweetalert2@10.js"></script>
		<script src="<?= JS.$data['page_functions'] ?>"></script>
		<script>
		$(function() {
			'use strict'

		});
		</script>
	</body>

</html>