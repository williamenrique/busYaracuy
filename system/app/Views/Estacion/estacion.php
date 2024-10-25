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
				<div class="col-8">
					<div class="card">
						<form id="formVenta" name="form_reloj">
							<div class="card-header ">
								<div class="row ">
									<div class="form-group col-lg-6">
										<label for="txtTasa">TASA DEL DIA</label>
										<input type="text" class="form-control tasa" id="txtTasa" name="txtTasa" placeholder="EJ 00.00"
											onkeypress="return soloNumeros(event);">
										<buton class="btn btn-primary mt-2 btnUpdateTasa" type="button">ACTUALIZAR</buton>
									</div>
								</div>
							</div>
							<input type="hidden" id="txtNombreOperador" name="txtNombreOperador"
								value="<?= $_SESSION['userData']['user_nombres']?>">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-lg-3">
										<label for="txtNombre">NOMBRE</label>
										<input type="text" class="form-control" id="txtNombre" name="txtNombre"
											placeholder="Nombre de la persona" onkeypress="return soloLetras(event);">
									</div>
									<div class="form-group col-lg-3">
										<label for="txtCI">CI</label>
										<input type="text" class="form-control" id="txtCI" name="txtCI" placeholder="Cedula"
											onkeypress="return soloNumeros(event);">
									</div>
									<div class="form-group col-lg-3">
										<label>TIPO VEHICULO</label>
										<select id="txtListTipoVehiculo" name="txtListTipoVehiculo" class="form-control">
											<option value="0" selected>SELECCIONE</option>
											<option value="1">CARRO</option>
											<option value="2">CAMION</option>
											<option value="3">MOTO</option>
										</select>
									</div>
									<div class="form-group col-lg-2">
										<label for="txtPlaca">PLACA</label>
										<input type="text" class="form-control" id="txtPlaca" name="txtPlaca" placeholder="Placa">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-2">
										<label for="txtLTS">LITROS</label>
										<input type="text" class="form-control" id="txtLTS" name="txtLTS" placeholder="Litros"
											onkeypress="return soloNumeros(event);">
									</div>
									<div class="form-group col-sm-3">
										<label>TIPO PAGO</label>
										<select id="txtListTipoPago" id="txtListTipoPago" name="txtListTipoPago" class="form-control">
											<option value="0" selected>SELECCIONE</option>
											<option value="4">DIVISA</option>
											<option value="5">EFECTIVO</option>
											<option value="6">PUNTO DE VENTA</option>
										</select>
									</div>
									<div class="form-group col-lg-2">
										<label for="txtMonto">Monto</label>
										<input type="text" class="form-control" id="txtMonto" name="txtMonto" placeholder="Monto a pagar">
									</div>
									<div class="form-group col-lg-2">
										<label for="txtFecha">FECHA</label>
										<input type="text" class="form-control" id="txtFecha" name="txtFecha" readonly
											value="<?= date('d-m-y')?>">
									</div>
									<div class="form-group col-lg-2">
										<label for="txtHora">HORA</label>
										<input type="text" class="form-control" id="txtHora" name="txtHora" readonly value="">
									</div>
								</div>
								<a href="#" class="card-link">Atendido por : <?= $_SESSION['userData']['user_nombres']?></a>
								<a href="#" class="card-link">E/S Tachira</a><br>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary" type="submit">ACEPTAR</button>
								<button class="btn btn-danger " onclick="fntCancelar()" type="button">CANCELAR</button>
							</div>

						</form>
					</div>
					<!-- TODO: mostrar una seccion si esta un cierre pendiente -->
					<section id="cierrePendiente"></section>
					<div class="card">
						<div class="card-header ">
							<h4>Detalle de ventas</h4>
						</div>
						<div class="card-body">
							<section class="list" id="listDetal">
							</section>
							<!-- TODO: coloar un boton para imprimir-->
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<a href="<?= base_url()?>fpdf/reporte.php" target="_blank" class="btn btn-primary"
								style=" margin-top: 8px" id="irReporte" onclick="fntIraReporte('<?= date('d-m-y')?>')">REPORTE</a>
							
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title m-0">Tickets recientes</h5>
						</div>
						<div class="card-body">
							<table id="listTickets" class="table table-bordered table-striped display" style="width:100%">
								<thead>
									<tr>
										<th>TICKETS RECIENTES</th>
									</tr>
								</thead>
								<tbody></tbody>
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