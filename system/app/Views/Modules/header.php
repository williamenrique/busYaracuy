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

	<body class="hold-transition sidebar-mini layout-fixed">
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
							<a href="#" class="d-block"><?= $_SESSION['userData']['user_nombres']?></a>
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
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- comienza el menu lateral -->
							<li class="nav-item">
								<a href="<?= base_url() ?>" class="nav-link active-home">
									<i class="nav-icon fas fa-th"></i>
									<p>INCIO</p>
								</a>
							</li>
							<!-- enlaces combinados -->
							<li class="nav-item menu-open-user">
								<a href="#" class="nav-link active-user">
									<i class="nav-icon fas fa-users"></i>
									<p> PERSONAL
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
								<?php if($_SESSION['userData']['departamento'] == 'INFORMATICA' OR $_SESSION['userData']['rol_id'] == '1'){?>
									<li class="nav-item link-user">
										<a href="<?= base_url()?>usuarios" class="nav-link usuarios">
											<i class="far fa-circle nav-icon"></i>
											<p>USUARIOS</p>
										</a>
									</li>
								<?php }?>
									<li class="nav-item link-personal">
										<a href="<?= base_url()?>personal" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>PERSONAL</p>
										</a>
									</li>
								</ul>
							</li>
							<!-- enlaces solos -->
					<?php if($_SESSION['userData']['departamento'] == 'OPERACIONES' OR $_SESSION['userData']['id_departamento'] == '1'){?>
							<li class="nav-item">
								<a href="<?= base_url() ?>flota" class="nav-link active-flota">
									<i class="nav-icon fas fa-bus"></i>
									<p>FLOTA</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url()?>flota/ingresar_mant" class="nav-link active-ingresar_mant">
									<i class="nav-icon fas fa-wrench"></i>
									<p>MANTENIMIENTO</p>
								</a>
							</li>
					<?php }?>
					<?php if($_SESSION['userData']['departamento'] == 'ALMACEN' OR $_SESSION['userData']['id_departamento'] == '1'){?>
							<li class="nav-item">
								<a href="<?= base_url() ?>producto" class="nav-link active-producto">
									<i class="nav-icon fab fa-product-hunt"></i>
									<p>PRODUCTOS</p>
								</a>
							</li>
							</li>
					<?php if($_SESSION['userData']['user_rol'] == 1 OR $_SESSION['userData']['user_rol'] == 2){?>
							<li class="nav-item">
								<a href="<?= base_url() ?>proveedor" class="nav-link active-proveedor">
									<i class="nav-icon fas fa-truck-moving"></i>
									<p>PROVEEDOR</p>
								</a>
							</li>
					<?php }?>
							<li class="nav-item">
								<a href="<?= base_url() ?>orden/despacho" class="nav-link active-despacho">
									<i class="nav-icon fas fa-box-open"></i>
									<p>DESPACHO</p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="<?= base_url() ?>Orden/listaordenes" class="nav-link active-listOrden">
									<i class="nav-icon far fa-list-alt"></i>
									<p>LISTA DE ORDENES</p>
								</a>
							</li>
							<!-- fin de los enlaces -->
					<?php }?>
							<!-- enlaces combinados -->
					<?php if($_SESSION['userData']['id_departamento'] == '1'){?>
							<li class="nav-item menu-open-data">
								<a href="#" class="nav-link active-data">
									<i class="nav-icon fas fa-database"></i>
									<p>DATA
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item link-clean">
										<a href="<?= base_url()?>datamant/clean" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>CLEAN</p>
										</a>
									</li>
									<li class="nav-item link-data">
										<a href="<?= base_url()?>datamant" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>UNIDAD MANT</p>
										</a>
									</li>
								</ul>
							</li>
					<?php }?>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>

		</div>