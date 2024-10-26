<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= $data['page_tag']?></title>
		<link rel="icon" type="image/png" href="<?= IMG ?>favicon.ico">
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" href="<?= PLUGINS?>css/all.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/sweetalert2.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/bootstrap-select.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/OverlayScrollbars.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="<?= PLUGINS ?>css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
		<link rel="stylesheet" href="<?= CSS ?>style.admin.css">
		<link rel="stylesheet" href="<?= CSS ?>adminlte.min.css">
		<link rel="stylesheet" href="<?= CSS ?>custom.css">
	</head>

	<body class="hold-transition sidebar-mini layout-fixed" onload="mueveReloj()">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
					<!-- <li class="nav-item d-none d-sm-inline-block">
						<a href="../../index3.html" class="nav-link">Home</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="#" class="nav-link">Contact</a>
					</li> -->
				</ul>
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<!-- Notifications Dropdown Menu -->
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="fas fa-cog"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-header">Configuraciones</span>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url()?>usuarios/perfil" class="dropdown-item">
								<i class="far fa-user mr-2"></i>PERFIL
								<!-- <span class="float-right text-muted text-sm">3 mins</span> -->
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url()?>logout" class="dropdown-item">
								<i class="fas fa-sign-out-alt mr-2"></i>SALIR
								<!-- <span class="float-right text-muted text-sm">3 mins</span> -->
							</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
				<!-- Brand Logo -->
				<a href="<?= base_url()?>" class="brand-link text-center ">
					<span class="brand-text font-weight-light ">Bus Yaracuy</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex" data-toggle="tooltip" data-placement="bottom"
						title="Inf <?= $_SESSION['userData']['user_nick'].' '.$_SESSION['userData']['user_nombres']?>">
						<div class="image">
							<img src="<?= base_url(). $_SESSION['userData']['user_img'] ?>" class="img-circle elevation-2"
								alt="User Image">
						</div>
						<div class="info">
							<a href="<?= base_url()?>usuarios/perfil" class="d-block"><?= $_SESSION['userData']['user_nombres']?></a>
							<a href="#" class="d-block" style="font-size: 10px"><?= $_SESSION['userData']['user_email']?></a>
						</div>
					</div>
					<!-- SidebarSearch Form -->
					<div class="form-inline">
						<div class="input-group" data-widget="sidebar-search">
							<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
							<div class="input-group-append">
								<button class="btn btn-sidebar">
									<i class="fas fa-search fa-fw"></i>
								</button>
							</div>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<?php require_once 'aside.php'?>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>

		</div>