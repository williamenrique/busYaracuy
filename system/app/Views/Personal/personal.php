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

            <div class="col-12">
                <!-- Default box -->
        <?php if($_SESSION['userData']['id_departamento'] == '1'){?>
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Agrege una nuevo personal </h3>
                    </div>
                    <div class="card-body">
                        <form id="formPersonal">
                            <!-- <input type="hidden" name="idUnidad" id="idUnidad" value=""> -->
                            <div class="form-row align-items-center">
                                <div class="col-sm-2 my-1">
                                    <label class="sr-only" for="inlineFormInputName">Cedula</label>
                                    <input type="text" class="form-control" placeholder="Id personal" id="txtCedula" name="txtCedula">
                                </div>

                                <div class="col-sm-3 my-1">
                                    <select id="listCargo" data-live-search="true" name="listCargo" class="form-control"
                                        data-style="btn-outline-primary" data-size="5">
                                        <option value="0">Seleccione cargo</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 my-1">
                                    <label class="sr-only" for="inlineFormInputName">Nombre completo</label>
                                    <input type="text" class="form-control" placeholder="Nombre y apellido" id="txtNombre"
                                        name="txtNombre" onkeypress="return soloLetras(event);">
                                </div>
                                <div class="col-sm-2 my-1">
                                    <label class="sr-only" for="inlineFormInputName">Telefono</label>
                                    <input type="text" class="form-control" placeholder="Ingrese N telefono" id="txtTelefono"
                                        name="txtTelefono" onkeypress="return soloNumeros(event);">
                                </div>
                                <div class="col-sm-2 my-1">
                                    <select id="listTagPersonal" data-live-search="true" name="listTagPersonal" class="form-control"
                                        data-style="btn-outline-primary" data-size="5">
                                        <option value="0">SELECCIONE ENLACE</option>
                                        <option value="1">INFORMATICA</option>
                                        <option value="2">ALMACEN</option>
                                    </select>
                                </div>
                                <div class="col-auto my-1">
                                    <button type="submit" id="btnActionForm" class="btn btn-primary btn-sm"> <i
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
                        <h3 class="card-title">Data completa del personal</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablePersonal" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>CEDULA</th>
                                    <th>NOMBRE Y APELLIDO</th>
                                    <th>CARGO</th>
                                    <th>TELEFONO</th>
                                    <th>STATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>CEDULA</th>
                                    <th>NOMBRE Y APELLIDO</th>
                                    <th>CARGO</th>
                                    <th>TELEFONO</th>
                                    <th>STATUS</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="modalEditPersonal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EDTAR DATOS DE PERSONAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formEditPersonal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                             <input type="hidden" name="idPersonal" id="idPersonal">
                            <div class="form-group">
                                <label class="sr-only" for="inlineFormInputName">Cedula</label>
                                <input type="text" class="form-control" placeholder="Id personal" id="txtCedulaEdit" name="txtCedulaEdit" onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select id="listCargoEdit" data-live-search="true" name="listCargoEdit" class="form-control"
                                    data-style="btn-outline-primary" data-size="5">
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="sr-only" for="inlineFormInputName">Nombre completo</label>
                                <input type="text" class="form-control" placeholder="Nombre y apellido" id="txtNombreEdit"
                                name="txtNombreEdit" onkeypress="return soloLetras(event);">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="sr-only" for="inlineFormInputName">Telefono</label>
                                <input type="text" class="form-control" placeholder="Ingrese N telefono" id="txtTelefonoEdit" name="txtTelefonoEdit" onkeypress="return soloNumeros(event);">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select id="listTagPersonalEdit" data-live-search="true" name="listTagPersonalEdit" class="form-control"
                                    data-style="btn-outline-primary" data-size="5">
                                
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="btnClose" data-dismiss="modal">CANCELAR</button>
                    <button type="submit" class="btn btn-primary">EDITAR</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= footer($data)?>

