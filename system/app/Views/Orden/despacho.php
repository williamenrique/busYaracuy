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
            <form id="formDespacho">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">CREAR ORDEN DE DESPACHO</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="idUnidad" id="idUnidad" value="">
                                <div class="form-row align-items-center">
                                    
                                    <div class="col-sm-3 my-1">
                                    <select id="listUnidad" data-live-search="true" name="listUnidad" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <!-- <option value="0">UNIDAD</option> -->
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <select id="listOperador" data-live-search="true" name="listOperador" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <!-- <option value="0">OPERADOR</option> -->
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <select id="listMecanico" data-live-search="true" name="listMecanico" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <!-- <option value="0">MECANICO</option> -->
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <select id="listDespachador" data-live-search="true" name="listDespachador" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <!-- <option value="0">DESPACHADOR</option> -->
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <select id="listArticulo" data-live-search="true" name="listArticulo" class="form-control"
                                            data-style="btn-outline-primary" data-size="5">
                                            <!-- <option value="0">ARTICULO</option> -->
                                        </select>
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">CANTIDAD</label>
                                        <input type="hidden" class="form-control" id="cantDispo">
                                        <input type="text" class="form-control" placeholder="CANTIDAD" id="txtCant" name="txtCant" onkeyup="cantProducto()">
                                    </div>
                                    <div class="col-sm-6 my-1">
                                        <label class="sr-only" for="inlineFormInputName">OBSERVACION</label>
                                        <input type="text" class="form-control" placeholder="OBSERVACION" id="txtObsDespacho" name="txtObsDespacho" onkeyup="cantProducto()">
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="button" id="btnAgrega" class="btn btn-primary btn-sm"> <i
                                            class="fas fa-plus mr-2"></i><span id="btnText">AGREGAR</span>
                                        </button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- cuerpo de la orden -->
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                    <!-- <i class="fas fa-globe"></i> AdminLTE, Inc. -->
                                        ORDEN DE DESPACHO
                                        <small class="float-right">FECHA: <span id="fechaDespacho"> 08/10/2024</span></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info del personal y unidad para el despacho -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    UNIDAD
                                    <address>
                                        <strong id="id_unidad"></strong><br>
                                        <strong>MODEL :</strong> <span id="modelo_unidad"></span><br>
                                        <strong>MARCA :</strong> <span id="marca_unidad"></span><br>
                                        <strong>VIM :</strong> <span id="vim_unidad"></span><br>
                                        <strong>CONBUSTIBLE :</strong> <span id="tipo_combustible"></span><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    PERSONAL
                                    <address>
                                        <strong>OPERADOR :</strong> <span id="operador"></span><br>
                                        <strong>MECANICO :</strong> <span id="mecanico"></span><br>
                                        <strong>DESPACHADO :</strong> <span id="despachador"></span><br>
                                    </address>
                                </div>
                            </div>
                            <!-- /.row -->
                            <!-- Table con los articulos generados para el despacho -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped" id="tableDesp">
                                        <thead>
                                            <tr>
                                                <th>COD</th>
                                                <th>ARTICULO</th>
                                                <th>CANT</th>
                                                <th>ACCION</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lista">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- botones -->
                            <div class="row no-print">
                                <div class="col-12">
                                <input type="hidden" id="txtOper" name="txtOper">
                                <input type="hidden" id="txtMec" name="txtMec">
                                <input type="hidden" id="txtDesp" name="txtDesp">
                                <button type="submit" class="btn btn-primary float-right" id="btnGenerar" style="margin-right: 5px;">
                                    <i class="fas fa-save"></i> GENERAR
                                </button>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div>
                </div>
            </form>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>