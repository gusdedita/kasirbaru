<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$iduserlogin = $data_seluser['id_user'];
	$idcabang 	 = $_SESSION[cabang_kasiralpaka];
	
	$qu_selcabang = "SELECT * FROM cabang WHERE id_cabang='$idcabang'";
	$sql_selcabang = mysqli_query($conn, $qu_selcabang);
	$data_selcabang = mysqli_fetch_assoc($sql_selcabang);

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">

			<form method="post" action="<?PHP $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="card">

						<!--<form method="post" action="">-->
							<div class="card-header" data-background-color="green">
								<h4 class="title">
									Laporan Penjualan Kasir

									<!--<a href="?view=transaction" class="btn btn-primary pull-right" style="zoom:85%">Laporan Penjualan Detail</a>-->
								</h4>
								<p class="category">Home > Report > Laporan Penjualan Kasir</p>
							</div>
						<!--</form>-->


						<div class="card-content">
							   <input type="hidden" name="txt_userlogin" id="txt_userlogin" value="<?PHP echo $iduserlogin;?>" >
							   <input type="hidden" name="txt_idcabang" id="txt_idcabang" value="<?PHP echo $idcabang;?>" >

								<div class="row">
									<div class="col-md-6" style="padding-top:0px;padding-bottom:0px;">
										<div class="form-group label-floating">
											<label class="control-label">Cabang Penjualan</label>
											<input type="text" class="form-control" value="<?PHP echo $data_selcabang['nama_cabang'];?>" disabled>
											<input type="hidden" id="txt_cabang" name="txt_cabang" value="<?PHP echo $data_selcabang['nama_cabang'];?>">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">User/Kasir</label>
											<input type="text" class="form-control" value="<?PHP echo $data_seluser['nama'];?>" disabled>
											<input type="hidden" id="txt_kasir" name="txt_kasir" value="<?PHP echo $data_seluser['nama'];?>">
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">Tgl. Mulai Laporan</label>
											<input type="date" class="form-control" id="txt_datemulai" name="txt_datemulai" value="<?PHP echo $datenow;?>">
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">S/D Tanggal</label>
											<input type="date" class="form-control" id="txt_dateakhir" name="txt_dateakhir" value="<?PHP echo $datenow;?>">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group label-floating">
											<label class="control-label"></label>
											<button class="btn btn-primary btn-round" style="zoom:80%" name="btn_lapdetail" id="btn_lapdetail">Laporan Detail</button>
											<button class="btn btn-info btn-round" style="zoom:80%" name="btn_lapringkas" id="btn_lapringkas">Laporan Ringkas</button>
										</div>
									</div>

								
								</div>


						</div>

					</div>
				</div>

				
			</form>


			<div class="col-md-12">
                <div class="card">

					<div class="card-content">

						<div class="row">
						
							<?PHP 
								if (isset($_POST['btn_lapringkas']) {
									
									$tglstart = $_POST['txt_datemulai'];
									$tglend   = $_POST['txt_dateakhir'];
							?>

									<table class="table table-bordered" name="tbl_detailbelanja" id="tbl_detailbelanja">
										<thead class="text-primary">
											<th align="center">No</th>
											<th>No. Trans.</th>
											<th>Tgl. Trans.</th>
											<th align="center">Member</th>
											<th align="center">Jenis Pembayaran</th>
											<th align="center">Jumlah Produk</th>
											<th align="center">Total Bayar</th>
										</thead>

										<tbody>
											<?PHP
												$qu_ceknotrans = "SELECT * FROM penjualan WHERE id_penjualan='$codetrans'";
												$sql_ceknotrans = mysqli_query($conn, $qu_ceknotrans);
												if (mysqli_num_rows($sql_ceknotrans) >= 1){
													$qu_seltransdetail = "SELECT * FROM
																				penjualan_detail AS pd
																				JOIN produk AS P ON pd.id_produk=p.id_produk
																			WHERE
																				pd.id_penjualan='$codetrans' AND pd.id_user='$iduserlogin'";
												} else {
													$qu_seltransdetail = "SELECT * FROM
																				penjualan_detail AS pd
																				JOIN produk AS P ON pd.id_produk=p.id_produk
																			WHERE
																				pd.id_penjualan IS NULL AND pd.id_user='$iduserlogin'";
												}
												$no_seltransdetail=1;
												$total = 0;
												$sql_seltransdetail = mysqli_query($conn, $qu_seltransdetail);
												while($data_seltransdetail=mysqli_fetch_array($sql_seltransdetail)){
														$total = $total + $data_seltransdetail['tot_harga'];
											?>
													<tr>
														<td><?PHP echo $no_seltransdetail;?></td>
														<td>
															<img src="assets/img/product/<?PHP echo $data_seltransdetail['picture'];?>" style="width:80px" >
														</td>
														<td><?PHP echo $data_seltransdetail['nama_produk'];?></td>
														<td><?PHP echo $data_seltransdetail['harga_jual'];?></td>
														<td><?PHP echo $data_seltransdetail['quantity'];?></td>
														<td><?PHP echo $data_seltransdetail['tot_harga'];?></td>
														<td><a data-toggle="modal" data-target="#myModalDelProduk<?PHP echo $no_seltransdetail;?>" class="btn btn-danger" name="btn_delbelanja" id="btn_delbelanja" style="zoom:70%">Delete</a></td>
													</tr>

													


											<?PHP
													$no_seltransdetail++;
												}
											?>
										</tbody>

									</table>
							<?PHP
								}
							?>

						</div>
					</div>
				</div>
			</div>



        </div>
    </div>
</div>




<!--Modal Cari Produk===================================================================================================================================-->
<div class="modal fade" id="myModalCariProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:80%">
		<div class="modal-content" style="zoom:110%">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Search Product</h4>
			</div>


			<div class="modal-body">
				<table class="table table-bordered" name="tbl_productinput" id="tbl_productinput">
                    <thead class="text-primary">
						<th align="center" width="5%">No.</th>
						<th align="center" width="12%">Code Product</th>
						<th align="center" colspan="2">Product</th>
						<th align="center"><?PHP echo "Stok ".$data_selcabang['nama_cabang'];?></th>
						<th align="center">Action</th>
					</thead>

					<?PHP
						$no_selproduct =1;
						$qu_selproduct = "SELECT
											p.picture,
											p.id_produk,
											p.nama_produk,
											sc.stok,
											p.harga_jual
										FROM produk AS p JOIN stok_cabang AS sc ON p.id_produk=sc.id_produk WHERE p.statusdel='N' AND sc.id_cabang='$idcabang' ORDER BY p.id_produk DESC";
						$sql_selproduct = mysqli_query($conn, $qu_selproduct);
						while($data_selproduct = mysqli_fetch_array($sql_selproduct)){
					?>
							<tr>
								<td align="center"><?PHP echo $no_selproduct;?></td>
								<td><?PHP echo $data_selproduct['id_produk'];?></td>
								<td align="center"><img src="assets/img/product/<?PHP echo $data_selproduct['picture'];?>" width="70px" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid"></td>
								<td><?PHP echo $data_selproduct['nama_produk'];?></td>
								<td align="center"><?PHP echo $data_selproduct['stok'];?></td>
								<td><button name="btn_inpro<?PHP echo $no_selproduct;?>" id="btn_inpro<?PHP echo $no_selproduct;?>" class="btn btn-warning" style="zoom:70%" data-dismiss="modal" aria-label="Close">Input</button></td>
							</tr>

							<script type="text/javascript">
								$(document).ready(function(){
									$("#btn_inpro<?PHP echo $no_selproduct;?>").click(function(){
										document.getElementById("txt_codeproduct").value = "<?PHP echo $data_selproduct['id_produk']; ?>";
										document.getElementById("txt_product").value = "<?PHP echo $data_selproduct['nama_produk']; ?>";
										document.getElementById("txt_harga").value = "<?PHP echo $data_selproduct['harga_jual']; ?>";
										document.getElementById("txt_stok").value = "<?PHP echo $data_selproduct['stok']; ?>";
									});
								});
							</script>

					<?PHP
							$no_selproduct++;
						}
					?>

				</table>
			</div>


			<div class='modal-footer'>
				<button name="btn_cancel" id="btn_cancel" class="btn btn-warning" style="zoom:85%" data-dismiss="modal" aria-label="Close">Cancel</button>
			</div>

		</div>
	</div>
</div>



<!--Modal Tambah Customer===================================================================================================================================-->
<div class="modal fade" id="myModalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:80%">
		<div class="modal-content" style="zoom:110%">

			<form method="post" action="?view=customer-action" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add Customer/Member</h4>
				</div>

				<div class="modal-body">

					<div class="col-md-12">
						<div class="form-group label-floating">
							<label class="control-label">Nama Customer</label>
							<input type="text" class="form-control" id="txt_namacust" name="txt_namacust" >
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
							<label class="control-label">Alamat</label>
							<textarea type="text" class="form-control" id="txt_alamat" name="txt_alamat" rows="3"></textarea>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group label-floating">
							<label class="control-label">Keterangan</label>
							<textarea type="text" class="form-control" id="txt_keterangan" name="txt_keterangan" rows="3"></textarea>
						</div>
					</div>

				</div>

				<div class='modal-footer'>
					<button name="btn_savecusttrans" id="btn_savecusttrans" class="btn btn-info" style="zoom:85%" >Save</button>
					<button class="btn btn-warning" style="zoom:85%" data-dismiss="modal" aria-label="Close">Cancel</button>
				</div>
			</form>

		</div>
	</div>
</div>



<script>
	$('#tbl_productinput').dataTable();
	$('#tbl_detailbelanja').dataTable();
</script>

<!--<script>
	$(document).ready(function() {
		var table = $('#tbl_detailbelanja').DataTable( {

			"ajax": "transaction-belanja-json.php?notrans=<?PHP echo $codetrans;?>",
			"columns": [
				{
					"className"	:	'details-control text-center',
					"data"		:   'no',
					"width"		: 	'5%'
				},
				{
					"className" :	'details-control text-center',
					"data"		:	'picture',
					"width"		: 	'5%'
				},
				{
					"className"	:	'details-control text-center',
					"data"		: 	"product"
				},
				{
					"className"	:	'details-control text-center',
					"data"		:   "price"
				},
				{
					"className"	:	'details-control text-center',
					"data"		:   "quantity"
				},
				{
					"data"		:   "subtotal",
					"className" :	"text-center"
				},
				{
					"data"		:   "action",
					"className"	:	'details-control text-center'
				}
			]
		} );

		// Add event listener for opening and closing details
		$('#tbl_detailbelanja tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );

			if ( row.child.isShown() ) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			} else {
				// Open this row
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		} );
	} );

</script>-->
