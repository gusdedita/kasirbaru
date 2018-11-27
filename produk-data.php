<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$iduserlogin = $data_seluser['id_user'];

?>
<div class="content" style="zoom:110%">
    <div class="container-fluid">
        <div class="row">


				<div class="col-md-12">
					<div class="card">

						<!--<form method="post" action="">-->
							<div class="card-header" data-background-color="green">
								<h4 class="title">
									Data Produk
									<a data-toggle="modal" data-target="#myModalAddProduct" class="btn btn-primary pull-right" style="zoom:85%">Add Product</a>
								</h4>
								<p class="category">Home > Produk > Data Produk</p>
							</div>
						<!--</form>-->


						<div class="card-content">
							   <input type="hidden" name="txt_userlogin" id="txt_userlogin" value="<?PHP echo $iduserlogin;?>" >

								 <table class="table table-bordered" name="tbl_dataproduk" id="tbl_dataproduk">
 									<thead class="text-primary">
										<tr>
											<th rowspan="2">No</th>
											<th rowspan="2" colspan="2">Nama Produk</th>
											<th rowspan="2">Harga Jual</th>
											<th colspan="4">Stok</th>
											<th rowspan="2">Kategori</th>
											<th rowspan="2">Action</th>
										</tr>
										<tr>
											<?PHP
												$no_selcabang = 1;
												$qu_selcabang = "SELECT * FROM cabang WHERE statusdel='N' ORDER BY id_cabang";
												$sql_selcabang = mysqli_query($conn, $qu_selcabang);
												while($data_selcabang=mysqli_fetch_array($sql_selcabang)){
											?>
													<td><?PHP echo $data_selcabang['nama_cabang'];?></td>
											<?PHP
													$no_selcabang++;
												}
											?>
											<td>Total</td>
										</tr>
 									</thead>

 									<tbody>
 									<?PHP
										$no_selpro = 1;
 										$qu_selpro = "SELECT * FROM produk AS p JOIN produk_kategori AS pk on p.id_kategori=pk.id_kategori WHERE p.statusdel='N' ORDER BY dateupdated DESC";
 										$sql_selpro = mysqli_query($conn, $qu_selpro);
 										while($data_selpro = mysqli_fetch_array($sql_selpro)){
 									?>
 											<tr>
 												<td><?PHP echo $no_selpro;?></td>
 												<td>
 													<img src="assets/img/product/<?PHP echo $data_selpro['picture'];?>" style="width:80px" >
 												</td>
 												<td><?PHP echo $data_selpro['nama_produk'];?></td>
 												<td><?PHP echo $data_selpro['harga_jual'];?></td>
												<?PHP 
													$totstokcab = 0;
													$idpro_selpro   = $data_selpro['id_produk'];
													$qu_selstokcab  = "SELECT * FROM stok_cabang WHERE id_produk='$idpro_selpro' ORDER BY id_cabang";
													$sql_selstokcab = mysqli_query($conn, $qu_selstokcab);
													while($data_selstokcab=mysqli_fetch_array($sql_selstokcab)){
												?>
														<td><?PHP echo $data_selstokcab['stok'];?></td>
												<?PHP
														$totstokcab = $totstokcab + $data_selstokcab['stok'];
													}
												?>
 												<td><?PHP echo $totstokcab;?></td>
 												<td><?PHP echo $data_selpro['kategori'];?></td>
												<td>
													<a data-toggle="modal" data-target="#myModalEditProduk<?PHP echo $no_selpro;?>" class="btn btn-warning" style="zoom:70%">Edit</a>
													<a data-toggle="modal" data-target="#myModalHapusProduk<?PHP echo $no_selpro;?>" class="btn btn-danger" style="zoom:70%">Delete</a>
												</td>
 											</tr>

 											<!--Modal Edit Product===================================================================================================================================-->
											<div class="modal fade" id="myModalEditProduk<?PHP echo $no_selpro;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document" style="width:60%">
													<div class="modal-content">
														
														<form method="post" action="?view=produk-action" enctype="multipart/form-data">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Edit Product</h4>
															</div>


															<div class="modal-body">
																
																<input type="hidden" id="txt_iduser" name="txt_iduser" value="<?PHP echo $data_seluser['id_user'];?>">
																
																<div class="modal-body">
																
																	<div class="col-md-6">
																		<div class="form-group label-floating">
																			<label class="control-label">ID Product</label>
																			<input type="text" class="form-control" id="txt_idpro" name="txt_idpro" value="<?PHP echo $data_selpro['id_produk'];?>" >
																		</div>
																	</div>
																	
																	<div class="col-md-6">
																		<div class="form-group label-floating">
																			<label class="control-label">Nama Product</label>
																			<input type="text" class="form-control" id="txt_namapro" name="txt_namapro" value="<?PHP echo $data_selpro['nama_produk'];?>">
																		</div>
																	</div>
																	
																	<div class="col-md-6">
																		<div class="form-group label-floating">
																			<label class="control-label">Harga Beli (Rp.)</label>
																			<input type="number" class="form-control" id="txt_hargabeli" name="txt_hargabeli" value="<?PHP echo $data_selpro['harga_beli'];?>">
																		</div>
																	</div>
																	
																	<div class="col-md-6">
																		<div class="form-group label-floating">
																			<label class="control-label">Harga Jual (Rp.)</label>
																			<input type="number" class="form-control" id="txt_hargajual" name="txt_hargajual" value="<?PHP echo $data_selpro['harga_jual'];?>">
																		</div>
																	</div>
																	
																	<?PHP
																		$qu_selcabang_edit = "SELECT * FROM cabang AS c JOIN stok_cabang AS sc ON c.id_cabang=sc.id_cabang WHERE c.statusdel='N' AND sc.id_produk='$idpro_selpro'";
																		$sql_selcabang_edit=mysqli_query($conn, $qu_selcabang_edit);
																		while($data_selcabang_edit=mysqli_fetch_array($sql_selcabang_edit)){
																	?>
																			<div class="col-md-2">
																				<div class="form-group label-floating">
																					<label class="control-label">Stok <?PHP echo $data_selcabang_edit['nama_cabang'];?></label>
																					<input type="number" class="form-control" id="txt_stok_<?PHP echo $data_selcabang_edit['nama_cabang'];?>" name="txt_stok_<?PHP echo $data_selcabang_edit['nama_cabang'];?>" value="<?PHP echo $data_selcabang_edit['stok'];?>">
																				</div>
																			</div>
																	<?PHP
																		}
																	?>
																	
																	<div class="col-md-6">
																		<div class="form-group label-floating">
																			<label class="control-label">Kategori</label>
																			<select class="form-control js-example-responsive" id="cb_kategori" name="cb_kategori">
																				<?PHP 
																					$qu_selkate = "SELECT * FROM produk_kategori WHERE statusdel='N'";
																					$sql_selkate= mysqli_query($conn, $qu_selkate);
																					while($data_selkate=mysqli_fetch_array($sql_selkate)){
																				?>
																						<option value="<?PHP echo $data_selkate['id_kategori'];?>" <?PHP if ($data_selkate['id_kategori']==$data_selpro['id_kategori']){echo "selected";}?>><?PHP echo $data_selkate['kategori'];?></option>
																				<?PHP
																					}
																				?>
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-md-6">
																		<div class="form-group label-floating">
																			<label class="control-label">Picture</label>
																		</div>
																		<input type="file"  id="inp_picture" name="inp_picture" >
																	</div>
																	
																	<div class="col-md-12">
																		<div class="form-group label-floating">
																			<label class="control-label">Keterangan</label>
																			<input type="text" class="form-control" id="txt_keterangan" name="txt_keterangan" value="<?PHP echo $data_selpro['keterangan'];?>">
																		</div>
																	</div>
																	
																	
																
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
 											$no_selpro++;
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




<!--Modal Add Product===================================================================================================================================-->
<div class="modal fade" id="myModalAddProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:50%">
		<div class="modal-content">
			
			<form method="post" action="?view=produk-action" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add New Product</h4>
				</div>


				<div class="modal-body">
				
					<input type="hidden" id="txt_iduser" name="txt_iduser" value="<?PHP echo $data_seluser['id_user'];?>">
					
					<?PHP
						$qu_cekjumproduk = "SELECT * FROM produk";
						$sql_cekjumproduk= mysqli_query($conn, $qu_cekjumproduk);
						
						$jumproduk = mysqli_num_rows($sql_cekjumproduk);
						$idpro_new = "DA-".($jumproduk + 1);
					?>
				
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">ID Product</label>
							<input type="text" class="form-control" id="txt_idpro" name="txt_idpro" value="<?PHP echo $idpro_new;?>" >
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Nama Product</label>
							<input type="text" class="form-control" id="txt_namapro" name="txt_namapro" >
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Harga Beli (Rp.)</label>
							<input type="number" class="form-control" id="txt_hargabeli" name="txt_hargabeli" >
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Harga Jual (Rp.)</label>
							<input type="number" class="form-control" id="txt_hargajual" name="txt_hargajual" >
						</div>
					</div>
					
					<?PHP
						$qu_selcabang = "SELECT * FROM cabang WHERE statusdel='N'";
						$sql_selcabang=mysqli_query($conn, $qu_selcabang);
						while($data_selcabang=mysqli_fetch_array($sql_selcabang)){
					?>
							<div class="col-md-2">
								<div class="form-group label-floating">
									<label class="control-label">Stok <?PHP echo $data_selcabang['nama_cabang'];?></label>
									<input type="number" class="form-control" id="txt_stok_<?PHP echo $data_selcabang['nama_cabang'];?>" name="txt_stok_<?PHP echo $data_selcabang['nama_cabang'];?>" value="0">
								</div>
							</div>
					<?PHP
						}
					?>
					
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Kategori</label>
							<select class="form-control js-example-responsive" id="cb_kategori" name="cb_kategori">
								<?PHP 
									$qu_selkate = "SELECT * FROM produk_kategori WHERE statusdel='N'";
									$sql_selkate= mysqli_query($conn, $qu_selkate);
									while($data_selkate=mysqli_fetch_array($sql_selkate)){
								?>
										<option value="<?PHP echo $data_selkate['id_kategori'];?>" ><?PHP echo $data_selkate['kategori'];?></option>
								<?PHP
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Picture</label>
						</div>
						<input type="file"  id="inp_picture" name="inp_picture" >
					</div>
					
					<div class="col-md-12">
						<div class="form-group label-floating">
							<label class="control-label">Keterangan</label>
							<input type="text" class="form-control" id="txt_keterangan" name="txt_keterangan" >
						</div>
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
	$('#tbl_dataproduk').dataTable();
</script>
