<?= head($data)?>
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
						<li class="breadcrumb-item"><a href="<?=  base_url()?>">Home</a></li>
						<li class="breadcrumb-item active"><?= $data['page_name']?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">

		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">MANTENIMIENTO DE DATA </h3>
						</div>
                        <div class="card-body">
                            <table class="table stripe hover table-sm" id="tableDataMant" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">UNIDAD</th>
                                        <th scope="col">ENTRADA</th>
                                        <th scope="col">SALIDA</th>
                                        <th scope="col">DIAGNOSTICO</th>
                                        <th scope="col">RECOMENDACION</th>
                                        <th scope="col">ENCARGADO</th>
                                        <th scope="col">BORRAR</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>