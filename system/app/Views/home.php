<?= head($data)
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>Fixed Layout</h1> -->
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
		<?php if($_SESSION['userData']['departamento'] == 'ALMACEN'):?>
			<section id="almacen">
				<div class="row">
					<div class="col-12">
						<!-- Default box -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">ALMACEN</h3>
	
								<div class="card-tools">
	
								</div>
							</div>
							<div class="card-body">
							Un almacén de repuestos bien organizado: estantes alineados meticulosamente, cada uno con su propio sistema de etiquetado. Los estantes están divididos en categorías específicas: piezas de motor, elementos eléctricos, componentes de suspensión y más. Cada repuesto tiene su espacio asignado, facilitando el acceso rápido y eficiente. Este tipo de organización minimiza el tiempo de búsqueda, optimiza el inventario y asegura que cada cliente encuentre exactamente lo que necesita, cuando lo necesita. Es como si cada estante contara una historia de precisión y eficiencia.
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
						
					</div>
				</div>
			</section>
		<?php endif;
		 if($_SESSION['userData']['departamento'] == 'INFORMATICA' OR $_SESSION['userData']['departamento'] == 'OPERACIONES'):?>
			<section id="operaciones">
				<a href="<?= base_url()?>fpdf/operatividad.php" class="btn btn-primary mb-2 " id="btnImp" target="_blank">IMPRIMIR</a>
				<div class="row">
					<div class="col-12">
						<div class="panelFlota"></div>
					</div>
				</div>
			</section>
			<section>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body table-responsive p-0">
								<div class="operatividad"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif;?>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>