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
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#menuSub" data-toggle="tab">ASOCIAR MENU</a>
								</li>
								<li class="nav-item"><a class="nav-link" href="#asignar" data-toggle="tab">ASIGNAR MENU</a></li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="menuSub">
									<form class="formMenu">
										<div class="form-row">
											<div class="col-md-3 mb-3">
												<label for="listMenu">SELECCIONE MENU</label>
												<div class="form-group listMenu">
												</div>
											</div>
											<div class="col-md-4 mb-3">
												<label for="listRolId">SELECCIONE SUBMENU</label>
												<div class="form-group listSubmenu">

												</div>
											</div>
										</div>
										<div class="form-row">
											<button type="submit" id="btnActionForm" class="btn btn-primary">
												<span id="btnText">GUARDAR</span>
											</button>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="asignar">
									<form class="formMenuAsignar" id="formMenuAsignar">
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<label for="listDep">SELECCIONE DEPARTAMENTO</label>
												<div class="form-group listDep">
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<label for="listMenuAsignar">Seleccione Menu</label>
												<!-- cargar los radios con los menu -->
												<div class="form-group listMenuAsignar">
												</div>
											</div>
											<div class="col-md-4 mb-3 listSubmenuAsignar">
											</div>
										</div>
										<div class="form-row">
											<button type="submit" id="btnActionForm" class="btn btn-primary">
												<span id="btnText">Asignar</span>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div><!-- /.card-body -->
					</div>
				</div>
			</div>
		

			<section class="row" id="listAllMenu"></section>
		
				
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>