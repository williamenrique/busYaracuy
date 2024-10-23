<?= head($data)?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>DATA DEL PERSONAL</h1>x -->
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
		
		<?php if($_SESSION['userData']['departamento'] == 'INFORMATICA' OR $_SESSION['userData']['rol_id'] == '1'){?>
			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">AGREGAR PERSONAL</h3>
						</div>
						<div class="card-body">
							<form id="formUser">
								<div class="form-row align-items-center">
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">ID PERSONAL</label>
										<input type="text" class="form-control" placeholder="ID Personal" id="txtIdPersonal"
											name="txtIdPersonal">
									</div>
									<div class="col-sm-3 my-1">
										<select class="form-control" data-live-search="true" data-style="btn-outline-primary" data-size="5"  name="listDep" id="listDep">
										</select>
									</div>
									<div class="col-sm-3 my-1">
										<select class="form-control" data-live-search="true" data-style="btn-outline-primary" data-size="5" name="listRolId" id="listRolId">
										</select>
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">NOMBRE</label>
										<input type="text" class="form-control" placeholder="NOMBRE" id="txtNombre" name="txtNombre">
									</div>
									<div class="col-sm-3 my-1">
										<label class="sr-only" for="inlineFormInputName">APELLIDO</label>
										<input type="text" class="form-control" placeholder="APELLIDO" id="txtApellido" name="txtApellido">
									</div>
								
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
		<?php }?>
			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-body">
							<table id="tableUser" class="data-table table stripe hover nowrap" style="width:100%">
								<thead>
									<tr>
										<th scope="col">ID</th>
										<th scope="col">Nick</th>
										<th scope="col">Nombres</th>
										<th scope="col">Apellidos</th>
										<th scope="col">Email</th>
										<th scope="col">Telefono</th>
										<th scope="col">Rol</th>
										<th scope="col">Status</th>
										<th scope="col">Acciones</th>
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