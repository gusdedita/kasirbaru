<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$iduserlogin = $data_seluser['id_user'];

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">


				<div class="col-md-12">
					<div class="card">

						<!--<form method="post" action="">-->
							<div class="card-header" data-background-color="green">
								<h4 class="title">
									Data User & Pegawai

									<button type="submit" name="btn_jadwaldok" id="btn_jadwaldok"  class="btn btn-primary pull-right" style="zoom:85%">New Transaksi</button>
									<button type="submit" name="btn_tambahpas" id="btn_tambahpas"  class="btn btn-info pull-right" style="zoom:85%">History Transaksi</button>
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
 										$qu_seluser = "SELECT * FROM user WHERE status_del='N'";
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
												<td><a data-toggle="modal" data-target="#myModalDelProduk<?PHP echo $no_seluser;?>" class="btn btn-warning" name="btn_delbelanja" id="btn_delbelanja" style="zoom:70%">Edit</a></td>
 											</tr>

 											<!--Modal Konfirmasi Delete===================================================================================================================================-->
 											<div class="modal fade" id="myModalDelProduk<?PHP echo $no_seluser;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 												<div class="modal-dialog" role="document" style="width:40%">
 													<div class="modal-content">
 														<form method="post" action="?view=transaction-action" enctype="multipart/form-data">
 															<div class="modal-header">
 																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 																<h4 class="modal-title" id="myModalLabel">Batal Beli Produk</h4>
 															</div>

 															<hr></hr>

 															<div class="modal-body">

 															</div>

 															<hr></hr>

 															<div class='modal-footer'>
 																<button name="btn_yes_delbelanja" id="btn_yes_delbelanja" class="btn btn-danger" style="zoom:85%" >Yes</button>
 																<button name="btn_cancel" id="btn_cancel" class="btn btn-warning" style="zoom:85%" data-dismiss="modal" aria-label="Close">No</button>
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




<!--Modal Cari Produk===================================================================================================================================-->
<div class="modal fade" id="myModalCariProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:80%">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Search Product</h4>
			</div>


			<div class="modal-body">

			</div>


			<div class='modal-footer'>
				<button name="btn_cancel" id="btn_cancel" class="btn btn-warning" style="zoom:85%" data-dismiss="modal" aria-label="Close">Cancel</button>
			</div>

		</div>
	</div>
</div>



<script>
	$('#tbl_datauser').dataTable();
</script>
