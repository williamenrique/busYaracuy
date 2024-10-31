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
						<li class="breadcrumb-item"><a href="#">Usuario</a></li>
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
					
					<!-- /.card -->
				</div>
			</div>


            <div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center" >
								<div id="preview-images" style=" background-image: url(<?= base_url().'/'. $_SESSION['userData']['user_img'] ?>);"></div>
								<!-- <img class="profile-user-img img-fluid img-circle" src="<?= IMG ?>default.png" alt="User profile picture"> -->
							</div>
							<h4 class="profile-username text-center">
								<?= $_SESSION['userData']['user_nombres'].' '.substr($_SESSION['userData']['user_apellidos'],0,1)?></h4>
							<p class="text-muted text-center mb-0"><?= $_SESSION['userData']['rol_name']?></p>
							<p class="text-muted text-center my-0"><small >DEP: <?= $_SESSION['userData']['departamento']?></small></p>
							<!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
						</div>
						<section class="box-form">
							<form  class="formImg">
								<span class="search">
									<img src="<?= IMG ?>camera.png" alt="">
								</span>
								<input type="file" id="file" name="file" accept="image/*">
								<button class="btn btnSubir" type="submit">SUBIR</button>
							</form>
							<!-- <div id="preview-images"></div> -->
						</section>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#datos" data-toggle="tab">Datos Personales</a>
								</li>
								<!-- <li class="nav-item"><a class="nav-link" href="#nick" data-toggle="tab">Usuario</a></li> -->
								<li class="nav-item"><a class="nav-link" href="#cambiarPass" data-toggle="tab">Cambiar password</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="datos">
									<form class="" id="formDatos" name="formDatos" novalidate>
										<input type="hidden" name="textCi" id="textCi" value="<?= $_SESSION['userData']['user_ci']?>">
										<input type="hidden" name="textId" id="textId" value="<?= $_SESSION['userData']['user_id']?>">
										<input type="hidden" name="textEmail" id="textEmail"
											value="<?= $_SESSION['userData']['user_email']?>">
										<input type="hidden" name="opcion" id="opcion" value="1">
										<div class="row mb-3">
											<div class="col">
												<!-- <?= dep( $_SESSION['userData'])?> -->
												<h4>
													<span class="badge badge-info">
														<strong>
															<?php
																if(empty($_SESSION['userData']['user_nick'])):
																	
																	echo 'No posee usuario';
																else:
																?><?= $_SESSION['userData']['user_nick']?>
														</strong>
													</span>
													<?php endif;?>
												</h4>
											</div>
											<div class="col">
												<h4>
													<span>Identificacion: </span>
													<span class="badge badge-info"
														id="userCi"><strong><?= $_SESSION['userData']['user_ci']?></strong>
													</span>
												</h4>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="textNombres">Nombres</label>
												<input type="text" class="form-control" id="textNombres" name="textNombres" required
													value="<?= $_SESSION['userData']['user_nombres']?>">
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="textApellidos">Apellidos</label>
												<input type="text" class="form-control" id="textApellidos" name="textApellidos" required
													value="<?= $_SESSION['userData']['user_apellidos']?>">
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="textTlf">Telefono</label>
												<input type="text" class="form-control" id="textTlf" name="textTlf" required
													value="<?= $_SESSION['userData']['user_tlf']?>">
												<div class="invalid-feedback">
													Please provide a valid city.
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-9 col-sm-9  ">
												<button type="submit" class="btn btn-success">Actualizar</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane 
								<div class="tab-pane" id="nick">
									<form class="needs-validation" id="formNick" name="formNick" novalidate>
										<input type="hidden" name="textCi" id="textCi" value="<?= $_SESSION['userData']['user_ci']?>">
										<input type="hidden" name="textId" id="textId" value="<?= $_SESSION['userData']['user_id']?>">
										<input type="hidden" name="textEmail" id="textEmail"
											value="<?= $_SESSION['userData']['user_email']?>">
										<input type="hidden" name="opcion" id="opcion" value="2">
										<div class="row mb-3">
											<div class="col">
												<h4>
													<span class="badge badge-info">
														<strong>
															<?php
                                                            if(empty($_SESSION['userData']['user_nick'])):
                                                                
                                                                echo 'No posee nick';
                                                            else:
                                                            ?><?= $_SESSION['userData']['user_nick']?>
														</strong>
													</span>
													<?php endif;?>
												</h4>
											</div>
											<div class="col">
												<h4>
													<span>Identificacion: </span>
													<span class="badge badge-info"
														id="userCi"><strong><?= $_SESSION['userData']['user_ci']?></strong></span>
												</h4>
											</div>
											<div class="clearfix"></div>
										</div>
										<p class="text-muted">Cree un usuario para que inicio sesion con mas facilidad</p>
										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="textNick">Usuario</label>
												<input type="text" class="form-control" id="textNick" name="textNick" required
													placeholder="Ingrese un usuario">
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-9 col-sm-9  ">
												<button type="submit" class="btn btn-success">Crear</button>
											</div>
										</div>
									</form>
								</div>
								/.tab-pane -->

								<div class="tab-pane" id="cambiarPass">
									<form class="" id="formPass" name="formPass" novalidate>
										<input type="hidden" name="textCi" id="textCi" value="<?= $_SESSION['userData']['user_ci']?>">
										<input type="hidden" name="textId" id="textId" value="<?= $_SESSION['userData']['user_id']?>">
										<input type="hidden" name="textEmail" id="textEmail"
											value="<?= $_SESSION['userData']['user_email']?>">
										<input type="hidden" name="opcion" id="opcion" value="3">
										<div class="row mb-3">
											<div class="col">
												<h4>
													<span class="badge badge-info">
														<strong>
															<?php
                                                            if(empty($_SESSION['userData']['user_nick'])):
                                                                
                                                                echo 'No posee nick';
                                                            else:
                                                            ?><?= $_SESSION['userData']['user_nick']?>
														</strong>
													</span>
													<?php endif;?>
												</h4>
											</div>
											<div class="col">
												<h4>
													<span>Identificacion: </span>
													<span class="badge badge-info"
														id="userCi"><strong><?= $_SESSION['userData']['user_ci']?></strong></span>
												</h4>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="textPass">Password</label>
												<!-- <input type="password" class="form-control" id="textPass" name="textPass" required
																	value="<?= decryption($_SESSION['userData']['user_pass'])?>"> -->
												<input type="password" class="form-control" id="textPass" name="textPass" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="textPassConfirm">Confirme Password</label>
												<input type="password" class="form-control" id="textPassConfirm" name="textPassConfirm">
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-9 col-sm-9  ">
												<button type="submit" class="btn btn-success">Cambiar password</button>
											</div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= footer($data)?>