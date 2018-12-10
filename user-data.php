<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$iduserlogin = $data_seluser['id_user'];

?>
<div class="content" style="zoom:120%">
    <div class="container-fluid">
        <div class="row">


				<div class="col-md-12">
					<div class="card">

						<!--<form method="post" action="">-->
							<div class="card-header" data-background-color="green">
								<h4 class="title">
									Data User & Pegawai
									<a data-toggle="modal" data-target="#myModalnewuser" class="btn btn-primary pull-right" style="zoom:85%">New User</a>
								</h4>
								<p class="category">Home > Setting > Data User & Pegawai</p>
							</div>
						<!--</form>-->


						<div class="card-content">
							   <input type="hidden" name="txt_userlogin" id="txt_userlogin" value="<?PHP echo $iduserlogin;?>" >

								 <table class="table table-bordered" name="tbl_datauser" id="tbl_datauser">
 									<thead class="text-primary">
 										<th>No</th>
 										<th></th>
 										<th>Nama</th>
 										<th>Username</th>
 										<th>Otoritas </th>
 										<th>No. Hp</th>
										<th>E-Mail</th>
 										<th>Action</th>
 									</thead>

 									<tbody>
 									<?PHP
										$no_seluser = 1;
 										$qu_seluser = "SELECT * FROM user WHERE status_del='N' AND nama != 'Administrator'";
 										$sql_seluser = mysqli_query($conn, $qu_seluser);
 										while($data_seluser = mysqli_fetch_array($sql_seluser)){
 									?>
 											<tr>
 												<td><?PHP echo $no_seluser;?></td>
 												<td>
 													<img src="assets/img/user/<?PHP echo $data_seluser['picture'];?>" style="width:80px" >
 												</td>
 												<td><?PHP echo $data_seluser['nama'];?></td>
 												<td><?PHP echo $data_seluser['username'];?></td>
 												<td><?PHP echo $data_seluser['otoritas'];?></td>
 												<td><?PHP echo $data_seluser['nohp'];?></td>
												<td><?PHP echo $data_seluser['email'];?></td>
												<td><a data-toggle="modal" data-target="#myModalEditUser<?PHP echo $no_seluser;?>" class="btn btn-warning" name="btn_delbelanja" id="btn_delbelanja" style="zoom:70%">Edit</a></td>
 											</tr>

 											<!--Modal Edit User===================================================================================================================================-->
											<div class="modal fade" id="myModalEditUser<?PHP echo $no_seluser;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document" style="width:50%">
													<div class="modal-content">

														<form method="post" action="?view=user-action" enctype="multipart/form-data">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Add New User</h4>
															</div>


															<div class="modal-body">

																<input type="hidden" id="txt_iduser" name="txt_iduser" value="<?PHP echo $data_seluser['id_user'];?>">

																<div class="col-md-12">
																	<div class="form-group label-floating">
																		<label class="control-label">Nama</label>
																		<input type="text" class="form-control" id="txt_nama" name="txt_nama" value="<?PHP echo $data_seluser['nama'];?>">
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group label-floating">
																		<label class="control-label">Username</label>
																		<input type="text" class="form-control" id="txt_username" name="txt_username" value="<?PHP echo $data_seluser['username'];?>">
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group label-floating">
																		<label class="control-label">Password</label>
																		<input type="text" class="form-control" id="txt_password" name="txt_password" value="<?PHP echo $data_seluser['password'];?>">
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group label-floating">
																		<label class="control-label">No. Handphone</label>
																		<input type="text" class="form-control" id="txt_nohp" name="txt_nohp" value="<?PHP echo $data_seluser['nohp']?>">
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group label-floating">
																		<label class="control-label">E-Mail</label>
																		<input type="text" class="form-control" id="txt_email" name="txt_email" value="<?PHP echo $data_seluser['email'];?>">
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group label-floating">
																		<label class="control-label">Otoritas</label>
																		<select class="form-control js-example-responsive" id="cb_otoritas" name="cb_otoritas">
																			<option value="Owner" <?PHP if ($data_seluser['otoritas'] == "Owner"){echo "selected";}?>>Owner</option>
																			<option value="Pegawai" <?PHP if ($data_seluser['otoritas'] == "Pegawai"){echo "selected";}?>>Pegawai</option>
																		</select>
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group label-floating">
																		<label class="control-label">Picture</label>
																	</div>
																	<input type="file"  id="inp_picture" name="inp_picture" >
																</div>

															</div>

															<div class="modal-footer" style="padding:30px;">

																<div class="col-md-12">
																	<button name="btn_update" id="btn_update" class="btn btn-success" style="zoom:85%" >Update</button>
																	<button class="btn btn-warning" style="zoom:85%" data-dismiss="modal" aria-label="Close">Cancel</button>
																</div>

															</div>
														</form>

													</div>
												</div>
											</div>

 									<?PHP
 											$no_seluser++;
 										}
 									?>
 									</tbody>

 								</table>


						</div>

					</div>
				</div>



        </div>
    </div>
</div>




<!--Modal New User===================================================================================================================================-->
<div class="modal fade" id="myModalnewuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:50%">
		<div class="modal-content">

			<form method="post" action="?view=user-action" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add New User</h4>
				</div>


				<div class="modal-body">

					<div class="col-md-12">
						<div class="form-group label-floating">
							<label class="control-label">Nama</label>
							<input type="text" class="form-control" id="txt_nama" name="txt_nama" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Username</label>
							<input type="text" class="form-control" id="txt_username" name="txt_username" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Password</label>
							<input type="text" class="form-control" id="txt_password" name="txt_password" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">No. Handphone</label>
							<input type="text" class="form-control" id="txt_nohp" name="txt_nohp" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">E-Mail</label>
							<input type="text" class="form-control" id="txt_email" name="txt_email" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Otoritas</label>
							<select class="form-control js-example-responsive" id="cb_otoritas" name="cb_otoritas">
								<option value="Owner" >Owner</option>
								<option value="Pegawai" >Pegawai</option>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Picture</label>
						</div>
						<input type="file"  id="inp_picture" name="inp_picture" >
					</div>

				</div>

				<div class="modal-footer" style="padding:30px;">

					<div class="col-md-12">
						<button name="btn_save" id="btn_save" class="btn btn-success" style="zoom:85%" >Save</button>
						<button class="btn btn-warning" style="zoom:85%" data-dismiss="modal" aria-label="Close">Cancel</button>
					</div>

				</div>
			</form>

		</div>
	</div>
</div>



<script>
	$('#tbl_datauser').dataTable();
</script>
