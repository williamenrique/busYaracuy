<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<title>Acceso al sistema</title>
	<!-- MDB icon -->
	<link rel="icon" href="<?= IMG ?>favicon.png" type="image/x-icon" />
	<!-- Google Fonts Roboto -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" /> -->
	<!-- <link rel="stylesheet" href="<?= PLUGINS ?>fontawesome-free/css/all.min.css"> -->
	<link rel="stylesheet" href="<?= PLUGINS ?>css/sweetalert2.css">
	<!-- <link rel="stylesheet" href="<?= PLUGINS ?>bootstrap/icheck-bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?= CSS ?>adminlte.min.css">
    <style>
        body{
            background-image: url(<?= IMG ?>bg.jpg);
            background-repeat : no-repeat;
            background-size: cover;

        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="#"><b>BUS YARACUY</a> -->
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresé sus datos para iniciar sesion</p>

                <form id="formLogin" name="formLogin" autocomplete="off">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="txtUser" name="txtUser" autofocus placeholder="Email o usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="txtPass" name="txtPass" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                Remember Me
                                </label>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-6 my-3">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesion</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <!-- <a href="forgot-password.html">Olvidaste la contraseña</a> -->
                </p>
                <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
        <!-- /.login-card-body -->
        </div>
    </div>

    <script>
	    const base_url = "<?= base_url()?>";
	</script>
	<script src="<?= PLUGINS ?>js/jquery.min.js"></script>
	<script src="<?= PLUGINS ?>js/bootstrap.bundle.min.js"></script>
	<script src="<?= PLUGINS ?>js/sweetalert2@10.js"></script>
    <script src="<?= PLUGINS ?>js/adminlte.min.js"></script>
	<script src="<?= JS.$data['page_functions'] ?>"></script>
	<!-- Custom scripts -->
</body>
</html>