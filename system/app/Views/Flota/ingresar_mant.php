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
						<li class="breadcrumb-item"><a href="<?=  base_url()?>flota">Flota</a></li>
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
					<div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">INGRESE UNIDAD A MANTENIMIENTO</h3>
                        </div>
                        <div class="card-body">
                            <form id="formIngMantUnidad">
                                <input type="hidden" name="idUnidad" id="idUnidad" value="">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-2 my-1">
                                        <select id="listUnidad" data-live-search="true" name="listUnidad" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">RUTA DE LA UNIDAD</label>
                                        <input type="text" class="form-control" placeholder="RUTA DE LA UNIDAD" id="txtRutaUnidad" name="txtRutaUnidad" onkeypress="return soloLetras(event);">
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <!-- <label class="sr-only" for="inlineFormInputName">OPERADOR</label> -->
                                        <!-- <input type="text" class="form-control" placeholder="OPERADOR" id="txtOperador" name="txtOperador" onkeypress="return soloLetras(event);"> -->
                                        <select id="listOperador" data-live-search="true" name="listOperador" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <!-- <label class="sr-only" for="inlineFormInputName">MECANICO</label> -->
                                        <!-- <input type="text" class="form-control" placeholder="MECANICO" id="txtMecanico" name="txtMecanico" onkeypress="return soloLetras(event);"> -->
                                        <select id="listMecanico" data-live-search="true" name="listMecanico" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                        </select>
                                    </div>
                                    <div class="col-sm-2 my-1">
                                        <label class="sr-only" for="inlineFormInputName">KM</label>
                                        <input type="text" class="form-control" placeholder="KILOMETRAJE" id="txtKilometraje" name="txtKilometraje" onkeypress="return soloNumeros(event);">
                                    </div>
                                    <div class="col-auto statusRol form-check-inline">
                                        <div class="form-check ml-1">
                                            <input class="form-check-input" type="radio" name="radioTipo" id="preventivo" value="p" checked>
                                            <label class="form-check-label" for="preventivo">PREVENTIVO</label>
                                        </div>
                                        <div class="form-check ml-2">
                                            <input class="form-check-input" type="radio" name="radioTipo" id="correctivo" value="c">
                                            <label class="form-check-label" for="correctivo">CORRECTIVO</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 my-1">
                                        <label class="sr-only" for="inlineFormInputName">FECHA ENTRADA</label>
                                        <input type="date" class="form-control" placeholder="FECHA ENTRADA" id="txtFechaEntrada" name="txtFechaEntrada">
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <label class="sr-only" for="inlineFormInputName">OBSERVACION OPERADOR</label>
                                        <input type="text" class="form-control" placeholder="OBSERVACION OPERADOR" id="txtObsOper" name="txtObsOper">
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <label class="sr-only" for="inlineFormInputName">OBSERVACION SUPERVISOR</label>
                                        <input type="text" class="form-control" placeholder="OBSERVACION SUPERVISOR" id="txtObsSuper" name="txtObsSuper">
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <label class="sr-only" for="inlineFormInputName">DIAGNOSTICO</label>
                                        <input type="text" class="form-control" placeholder="DIAGNOSTICO" id="txtDiagnostico" name="txtDiagnostico">
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <label class="sr-only" for="inlineFormInputName">RECOMENDACION</label>
                                        <input type="text" class="form-control" placeholder="RECOMENDACION" id="txtRecomendacion" name="txtRecomendacion">
                                    </div>
                                </div>
                                <button type="submit" id="btnActionForm" class="btn btn-primary btn-sm">
                                    </i><span id="btnText">Ingresar mantenimiento</span>
                                </button>
                            </form>
                        </div>
                    </div>
					<!-- /.card -->
                     <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <table class="table stripe hover nowrap table-sm" id="tableMantenimiento" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">ENTRADA</th>
                                        <th scope="col">MECANICO</th>
                                        <th scope="col">KM</th>
                                        <th scope="col">TIPO</th>
                                        <th scope="col">DIAGNOSTICO</th>
                                        <th scope="col">RECOMENDACION</th>
                                        <th scope="col">SALIDA</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">ENTRADA</th>
                                        <th scope="col">MECANICO</th>
                                        <th scope="col">KM</th>
                                        <th scope="col">TIPO</th>
                                        <th scope="col">DIAGNOSTICO</th>
                                        <th scope="col">RECOMENDACION</th>
                                        <th scope="col">SALIDA</th>
                                    </tr>
                                </tfoot>
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