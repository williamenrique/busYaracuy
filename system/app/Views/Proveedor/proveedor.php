<?= head($data)?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>PROVEEDORES</h1> -->
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
							<h3 class="card-title">AGREGAR PROVEEDOR</h3>
						</div>
						<div class="card-body">
							<form id="formProveedor">
								<div class="form-row align-items-center">
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">ID PROVEEDOR</label>
										<input type="text" class="form-control" placeholder="RIF" id="txtIdProveedor"
											name="txtIdProveedor">
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">EMPRESA</label>
										<input type="text" class="form-control" placeholder="EMPRESA" id="txtEmpresa" name="txtEmpresa">
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">NOMBRE</label>
										<input type="text" class="form-control" placeholder="NOMBRE" id="txtNombre" name="txtNombre">
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">APELLIDO</label>
										<input type="text" class="form-control" placeholder="APELLIDO" id="txtApellido" name="txtApellido">
									</div>
								</div>
								<div class="form-row align-items-center">
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">TELEFONO</label>
										<input type="text" class="form-control" placeholder="TELEFONO" id="txtTelefono" name="txtTelefono">
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">EMAIL</label>
										<input type="text" class="form-control" placeholder="EMAIL" id="txtEmail" name="txtEmail">
									</div>
								</div>
								<div class="col-auto my-1">
								</div>
								<button type="submit" id="btnActionForm" class="btn btn-primary btn-sm "> <i
										class="fas fa-plus"></i><span id="btnText" class="ml-1">Agregar</span>
								</button>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-body">
							<table id="tableProveedor" class="data-table table stripe hover nowrap" style="width:100%">
								<thead>
									<tr>
										<th scope="col">COD</th>
										<th scope="col">RIF</th>
										<th scope="col">EMPRESA</th>
										<th scope="col">NOMBRE, APELLIDO</th>
										<th scope="col">TELEFONO</th>
										<th scope="col">EMAIL</th>
										<th scope="col">STATUS</th>
										<th scope="col">ACCIONES</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
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