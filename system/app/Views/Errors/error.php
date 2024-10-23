<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
	<title>404</title>

	<style>
	body {
		background-color: #e7eaed;
	}

	.box-404 {
		width: 100%;
		text-align: center;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		-webkit-transform: translate(-50%, -50%);
	}

	.box-404 h1 {
		font-family: 'Black Ops One', cursive;
		font-size: 175px;
	}

	.box-404 p a {
		color: #37517e;
		text-decoration: none;
		letter-spacing: 1px;
	}

	.footer {
		color: black;
		position: absolute;
		right: 10px;
		bottom: 10px;
	}

	.footer a {
		color: #37517e;
		text-decoration: none;
		letter-spacing: 1px;
	}
	</style>

<body>
	<div class="container">
		<div class="row">
			<div class="col box-404">
				<h1 class="404">404</h1>

				<h3 class="404sub">Lo sentimos pagina solicitada no encontrada</h3>
				<p class="link">
					<a href="<?= base_url().$data['page_name']?>">Volver al inicio</a>
				</p>
			</div>
			<div class="footer">
				© 2020 Oops 404 . All Rights Reserved | Design by <a href="<?= BASE_URL?>">Work solution</a>
			</div>
		</div>
	</div>

</body>

</html>