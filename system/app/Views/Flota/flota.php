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
            <?php if($_SESSION['userData']['user_rol'] == '1' OR $_SESSION['userData']['user_rol'] == '2'){?>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">AGREGE NUEVA UNIDAD</h3>
                        </div>
                        <div class="card-body">
                            <form id="formUnidad">
                                <input type="hidden" name="idUnidad" id="idUnidad" value="">
                                <div class="form-row align-items-center">
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">Id Unidad</label>
                                        <input type="text" class="form-control" placeholder="Id de unidad" id="txtIdUnidad" name="txtIdUnidad">
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <select class="custom-select" name="listMarcaUnidad" id="listMarcaUnidad">
                                            <option selected>MARCA UNIDAD</option>
                                            <option value="1">YUTONG</option>
                                            <option value="2">INTERNATIONAL</option>
                                            <option value="3">FREITHLINE</option>
                                            <option value="4">ENCAVA</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <select id="listModelo" data-live-search="true" name="listModelo" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <option value="0">Seleccione modelo</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">VIM UNIDAD</label>
                                        <input type="text" class="form-control" placeholder="VIM UNIDAD" id="txtVimUnidad" name="txtVimUnidad">
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">FECHA UNIDAD</label>
                                        <input type="text" class="form-control" placeholder="FECHA UNIDAD ej: 2015" id="txtFechaUnidad" name="txtFechaUnidad">
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">CAPACIDAD</label>
                                        <input type="text" class="form-control" placeholder="CAPACIDAD" id="txtCapacidad" name="txtCapacidad" onkeypress="return soloNumeros(event);">
                                    </div>
                                    <div class="col-sm-2 my-1">
                                        <select id="txtTipoCombustible" data-live-search="true" name="txtTipoCombustible" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <option value="0">COMBUSTIBLE</option>
                                            <option value=">G.L.P">G.L.P</option>
                                            <option value="DIESEL">DIESEL</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 my-1">
                                        <select id="listTransmision" data-live-search="true" name="listTransmision" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <option value="0">TRANSMISION</option>
                                            <option value="SINCRONICO">SINCRONICO</option>
                                            <option value="AUTOMATICO">AUTOMATICO</option>
                                        </select>
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="submit" id="btnActionForm" class="btn btn-primary btn-sm ml-3"> <i
                                            class="fas fa-plus"></i><span id="btnText">Agregar</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php }?>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DATA COMPLETA DE LA FLOTA</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableFlota" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>MARCA</th>
                                        <th>MODELO</th>
                                        <th>TRANSMISION</th>
                                        <th>VIM</th>
                                        <th>FECHA</th>
                                        <th>TIPO</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>MARCA</th>
                                        <th>MODELO</th>
                                        <th>TRANSMISION</th>
                                        <th>VIM</th>
                                        <th>FECHA</th>
                                        <th>TIPO</th>
                                        <th>STATUS</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
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