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
									<a href="?view=transaction" class="btn btn-primary pull-right" style="zoom:85%">Billing</a>
								</h4>
								<p class="category">Home > Billing > Data Billing</p>
							</div>
						<!--</form>-->


						<div class="card-content">
							   <input type="hidden" name="txt_userlogin" id="txt_userlogin" value="<?PHP echo $iduserlogin;?>" >

								 <table class="table table-bordered" name="tbl_dataproduk" id="tbl_dataproduk">
 									<thead class="text-primary">
										<tr>
											<th>No</th>
											<th>Tgl. Transaksi</th>
											<th>No. Transaksi</th>
											<th>Total Belanja</th>
											<th>Pembayaran</th>
											<th>Jenis Bayar</th>
											<th>Cabang</th>
											<th>Action</th>
										</tr>
 									</thead>

 									<tbody>
 									<?PHP
										$no_seltrans = 1;
 										$qu_seltrans = "SELECT * FROM penjualan AS p JOIN cabang AS c ON p.id_cabang=c.id_cabang WHERE p.statusdel='N' ORDER BY p.datecreated DESC";
 										$sql_seltrans = mysqli_query($conn, $qu_seltrans);
 										while($data_seltrans = mysqli_fetch_array($sql_seltrans)){
 									?>
 											<tr>
 												<td align="center"><?PHP echo $no_seltrans;?></td>
 												<td align="center"><?PHP echo $data_seltrans['datecreated'];?></td>
 												<td><?PHP echo $data_seltrans['id_penjualan'];?></td>
 												<td align="right"><?PHP echo rupiah($data_seltrans['total']);?></td>
 												<td align="right"><?PHP echo rupiah($data_seltrans['bayar']);?></td>
 												<td align="center"><?PHP echo $data_seltrans['jenis_bayar'];?></td>
 												<td><?PHP echo $data_seltrans['nama_cabang'];?></td>
												<td>
													<a data-toggle="modal" data-target="#myModalEditProduk<?PHP echo $no_seltrans;?>" class="btn btn-warning" style="zoom:70%">Detail</a>
													<a href="transaction-print.php?idpenjualan=<?PHP echo $data_seltrans['id_penjualan'];?>" target="_blank" class="btn btn-info" style="zoom:70%">Print</a>
												</td>
 											</tr>

 											

 									<?PHP
 											$no_seltrans++;
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
