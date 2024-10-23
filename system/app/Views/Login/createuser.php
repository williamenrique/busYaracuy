<?= head($data)?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1 class="m-0">VENTAS Y <small>REPORTES</small></h1> -->
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<!-- <li class="breadcrumb-item"><a href="#">Layout</a></li>
						<li class="breadcrumb-item active">Top Navigation</li> -->
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Agregar nuevo operador</h5>
						</div>
						<form id="formNewOperador">
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="txtIdentificacion">Identificacion</label>
										<input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion"
											onkeypress="return soloNumeros(event);">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="txtNombres">Nombres</label>
										<input type="text" class="form-control" id="txtNombres" name="txtNombres"
											onkeypress="return soloLetras(event);">
									</div>
									<div class="form-group col-md-6">
										<label for="txtApellidos">Apellidos</label>
										<input type="text" class="form-control" id="txtApellidos" name="txtApellidos"
											onkeypress="return soloLetras(event);">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="txtTlf">Telefono</label>
										<input type="text" class="form-control" id="txtTlf" name="txtTlf"
											onkeypress="return soloNumeros(event);">
									</div>
									<div class="form-group col-md-8">
										<label for="txtEmail">Email</label>
										<input type="email" class="form-control" id="txtEmail" name="txtEmail">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="listStatus">Status</label>
										<select id="listStatus" name="listStatus" class="selectpicker form-control"
											data-style="btn-outline-primary" data-size="5">
											<option value="1">Activo</option>
											<option value="2">Inactivo</option>
										</select>
									</div>
									<div class="form-group col-md-8">
										<label for="listRolId">Tipo Usuario</label>
										<select id="listRolId" data-live-search="true" name="listRolId" class="form-control"
											data-style="btn-outline-primary" data-size="5">
											<option value="2">Operrador</option>
											<option value="3">Provicional</option>
											<option value="1">Administrador</option>
										</select>
									</div>
								</div>
								<button type="submit" id="btnActionForm" class="btn btn-primary"><span
										id="btnText">Guardar</span></button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>
							</div>

						</form>
					</div>
				</div>

				<!-- /.col-md-6 -->
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title m-0">Usuarios</h5>
						</div>
						<div class="card-body">
							<ul class="listUser">
								
							</ul>
						</div>
					</div>

					<!-- <div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0">Featured</h5>
						</div>
						<div class="card-body">
							<h6 class="card-title">Special title treatment</h6>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
					</div> -->
				</div>
			</div>
			<!-- /.col-md-6 -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>