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
							<form id="formScaner">
								<div class="form-row align-items-center">
									<div class="col-sm-3 my-1">
										<select class="form-control" name="unidadesList" id="unidadesList" data-live-search="true" data-style="btn-outline-primary" data-size="5">
										</select>
									</div>
									<div class="col-sm-6 my-1">
										<label class="sr-only" for="inlineFormInputName">OBSERVACION</label>
										<input type="text" class="form-control" placeholder="OBSERVACION" id="txtObsScaner" name="txtObsScaner">
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">FECHA</label>
										<input type="date" class="form-control" placeholder="FECHA SCANER" id="txtFechaScaner" name="txtFechaScaner">
									</div>
									<div class="col-auto my-1">
										<button type="submit" class="btn btn-primary">AGREGAR</button>
									</div>
									<!-- <div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">Id Unidad</label>
										<input type="text" class="form-control" placeholder="Id de unidad" id="txtIdUnidad" name="txtIdUnidad">
									</div> -->
								</div>
							</form>
						</div>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-header ">
							<div class="row align-items-center">
								<div class="col-sm-6">
									<h3 class="card-title">
										<i class="fas fa-list-ul mr-2"></i>
										REGISTRO SCANERr
									</h3>
								</div>
								
								<div class="col-sm-6 d-flex">
									<!-- <form id="formSearch" class="d-flex"> -->
										<input type="text" id="txtBuscar" class="form-control input-group input-group-sm"  placeholder="BUSCAR" style="float: right">
										<button type="button" id="btnBuscar" class="btn btn-info">BUSCAR</button>
									<!-- </form> -->
								</div>
							</div>
						</div>
						<div class="card-body">
							<div id="boxScaner"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>