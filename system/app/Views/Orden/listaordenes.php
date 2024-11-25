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
						<li class="breadcrumb-item"><a href="<?=  base_url()?>despacho">Ordenes</a></li>
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
					<!-- Main content -->
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Nota:</h5>
                        Filtro para lista de ordenes despachadas mostradas en tarjeta con su información
						<form id="formBuscarDesp">
							<div class="form-row align-items-center">
								<div class="col-sm-2 my-1">
									<label class="sr-only" for="inlineFormInputName">COD</label>
									<input type="text" class="form-control" placeholder="COD DESPACHO" id="txtCodDespacho" name="txtCodDespacho">
								</div>
								<div class="col-sm-2 my-1">
									<label class="sr-only" for="inlineFormInputName">UNIDAD</label>
									<input type="text" class="form-control" placeholder="UNIDAD" id="txtUnidad" name="txtUnidad">
								</div>
								<div class="col-sm-2 my-1">
									<label class="sr-only" for="inlineFormInputName">ARTICULO</label>
									<input type="text" class="form-control" placeholder="ARTICULO" id="txtArt" name="txtArt">
								</div>
								<div class="col-sm-2 my-1">
									<label class="sr-only" for="inlineFormInputName">DESDE</label>
									<input type="date" class="form-control" placeholder="DESDE" id="txtDesde" name="txtDesde">
								</div>
								<div class="col-auto my-1">
									<button type="submit" id="btnActionForm" class="btn btn-primary btn-sm"> <i
										class="fas fa-plus mr-2"></i><span id="btnText">BUSCAR</span>
									</button>
									<input class="btn btn-outline-light btn-sm" type="reset" value="Reset">
								</div>
							</div>
						</form>
                    </div>
                    <div id="boxInvoce"></div>
                    
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>