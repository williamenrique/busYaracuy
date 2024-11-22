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
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">NUEVO ARTICULO</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">ARTICULO EXISTENTE</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-one-tabContent">
								<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
									<!-- formulario nuevo articulo -->
									<form id="formNewArticulo">
										<div class="form-row align-items-center">

											<div class="col-sm-3 my-1">
												<label class="sr-only" for="inlineFormInputName">ARTICULO</label>
												<input type="text" class="form-control" placeholder="NOMBRE ARTICULO" id="txtArticulo" name="txtArticulo">
											</div>
											<div class="col-sm-6">
												<input type="radio" class="btn-check" name="optionsArticulo" id="activo" value="1" autocomplete="off" checked>
												<label class="btn" for="activo">ACTIVOS</label>
												<input type="radio" class="btn-check" name="optionsArticulo" id="consumible" value="2" autocomplete="off">
												<label class="btn" for="consumible">CONSUMIBLES</label>
												<input type="radio" class="btn-check" name="optionsArticulo" id="descontinuado" value="0" autocomplete="off">
												<label class="btn" for="descontinuado">DESCONTINUADO</label>
											</div>
											<div class="col-sm-3 my-1">
												<select id="listEnlace" data-live-search="true" name="listEnlace" class="form-control"
													data-style="btn-outline-primary" data-size="5">
													<!-- <option value="0">SELECCIONE MODELO</option> -->
												</select>
											</div>

											<div class="col-sm-5">
												<input type="radio" class="btn-check" name="optionsPresentacion" id="unidad" value="unidad" autocomplete="off" checked>
												<label class="btn" for="unidad">UNIDAD</label>
												<input type="radio" class="btn-check" name="optionsPresentacion" id="litro" value="litro" autocomplete="off">
												<label class="btn" for="litro">LITROS</label>
												<input type="radio" class="btn-check" name="optionsPresentacion" id="kilo" value="kilo" autocomplete="off">
												<label class="btn" for="kilo">KILOS</label>
												<input type="radio" class="btn-check" name="optionsPresentacion" id="juego" value="juego" autocomplete="off">
												<label class="btn" for="juego">JUEGO</label>
											</div>
											<div class="col-sm-3 my-1">
												<select id="listProveedor" data-live-search="true" name="listProveedor" class="form-control"
													data-style="btn-outline-primary" data-size="5">
													<!-- <option value="0">SELECCIONE PROVEEDOR</option> -->
												</select>
											</div>
											<div class="col-sm-3 my-1">
												<select id="listUbicacion" data-live-search="true" name="listUbicacion" class="form-control"
													data-style="btn-outline-primary" data-size="5">
													<!-- <option value="0">SELECCIONES UBICACION</option> -->
												</select>
											</div>
											
											<div class="col-sm-2 my-1">
												<label class="sr-only" for="inlineFormInputName">CANTIDAD</label>
												<input type="text" class="form-control" placeholder="CANTIDAD" id="txtCantidad" name="txtCantidad">
											</div>
										</div>
										<button type="submit" id="btnActionForm" class="btn btn-primary btn-sm "> <i
												class="fas fa-plus"></i><span id="btnText" class="ml-1">Agregar</span>
										</button>
									</form>
									
								</div>
								<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
									<!-- formulario agregar cantidad al stock -->
									<form id="formArticuloExistnte">
										<div class="form-row align-items-center">
											<!-- <div class="col-sm-3 my-1">
												<label class="sr-only" for="inlineFormInputName">ARTICULO</label>
												<input type="text" class="form-control" placeholder="NOMBRE ARTICULO" id="txtArticulo"
													name="txtArticulo">
											</div> -->
											<div class="col-sm-3 my-1">
												<select id="listArticuloExistente" data-live-search="true" name="listArticuloExistente" class="form-control"
													data-style="btn-outline-primary" data-size="5">
													<!-- <option value="0">SELECCIONE ARTICULO</option> -->
												</select>
											</div>
								
											<div class="col-sm-1 my-1">
												<label class="sr-only" for="inlineFormInputName">CANTIDAD ACTUAL</label>
												<input type="text" class="form-control" placeholder="ACTUAL" id="txtCantidadActual" name="txtCantidadActual" readonly >
											</div>
											<div class="col-sm-1 my-1">
												<label class="sr-only" for="inlineFormInputName">CANTIDAD NUEVA</label>
												<input type="text" class="form-control" placeholder="CANTIDAD" id="txtCantidadMas" name="txtCantidadMas">
											</div>
											<div class="col-sm-3 my-1">
												<label class="sr-only" for="inlineFormInputName">PROVEEDOR</label>
												<input type="text" class="form-control" placeholder="PROVEEDOR" id="txtProveedor" name="txtProveedor" readonly>
											</div>
											<div class="col-sm-3 my-1">
												<label class="sr-only" for="inlineFormInputName">UBICACION</label>
												<input type="text" class="form-control" placeholder="UBICACION" id="txtUbicacion" name="txtUbicacion" readonly>
											</div>
											
										</div>
										<button type="submit" id="btnActionForm" class="btn btn-primary btn-sm "> <i
												class="fas fa-plus"></i><span id="btnText" class="ml-1">Agregar</span>
										</button>
									</form>
								</div>
							</div>
						</div>
						<!-- /.card -->
					</div>
				</div>
			</div>
			<!-- mostrar lista de articulos -->
			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-body">
							<table id="tableProducto" class="data-table table stripe hover nowrap" style="width:100%">
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
				</div>
			</div>
		</div>	

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>
