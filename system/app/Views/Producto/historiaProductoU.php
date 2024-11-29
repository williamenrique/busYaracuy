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
    <input type="hidden" id="idGetArticulo" value= "<?php echo $_GET['articulo']?>">
		<div class="container-fluid">
			<div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title"><strong id="strArticulo"></strong> con una disponibilidad de  <span id="strDisponible"></span> y se ha entregado <strong id="strEntregado"></strong> desde <span id="strDesde"></span> hasta <span id="strHasta"></span></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableHproductoU" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>UNIDAD</th>
                                        <th>ENTREGADO</th>
                                        <th>FECHA</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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