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
                        <div class="card-body">

                            <table id="tableArticulo" class="data-table table stripe hover nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">COD</th>
                                        <th scope="col">ARTICULO</th>
                                        <th scope="col">MODELO</th>
                                        <th scope="col">PROVEEDOR</th>
                                        <th scope="col">UBICACION</th>
                                        <th scope="col">STOCK</th>
                                        <th scope="col">ACCION</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                </tbody>
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