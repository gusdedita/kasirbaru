<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$iduserlogin = $data_seluser['id_user'];
	$idcabang = $_SESSION[cabang_kasiralpaka];

	$qu_selcabang = "SELECT * FROM cabang WHERE id_cabang='$idcabang'";
	$sql_selcabang = mysqli_query($conn, $qu_selcabang);
	$data_selcabang = mysqli_fetch_assoc($sql_selcabang);

	$qu_cekjumtrans = "SELECT COUNT(*) AS JUMLAH FROM penjualan WHERE datecreated='$datenow'";
	$data_cekjumtrans= mysqli_fetch_assoc(mysqli_query($conn, $qu_cekjumtrans));
	$codetrans = $iduserlogin."-".$datecode."-".($data_cekjumtrans['JUMLAH']+1);



?>
<div class="content">
    <div class="container-fluid">
        <div class="row">

			<form method="post" action="?view=transaction-action" enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="card">

						<!--<form method="post" action="">-->
							<div class="card-header" data-background-color="green">
								<h4 class="title">
									Transaksi Penjualan

									<button type="submit" name="btn_jadwaldok" id="btn_jadwaldok"  class="btn btn-primary pull-right" style="zoom:85%">New Transaksi</button>
									<button href="?view=transaction-data"  class="btn btn-info pull-right" style="zoom:85%">History Transaksi</button>
								</h4>
								<p class="category">Home > Billing > Transaksi Penjualan</p>
							</div>
						<!--</form>-->


						<div class="card-content">
							   <input type="hidden" name="txt_userlogin" id="txt_userlogin" value="<?PHP echo $iduserlogin;?>" >
							   <input type="hidden" name="txt_idcabang" id="txt_idcabang" value="<?PHP echo $idcabang;?>" >

								<div class="row">
									<!--<form method="post" action="">-->
									<div class="col-md-6" style="padding-top:0px;padding-bottom:0px;">
										<div class="form-group label-floating">
											<label class="control-label">No. Transaksi</label>
											<input type="text" class="form-control" id="txt_notrans" name="txt_notrans" value="<?PHP echo $codetrans;?>">
										</div>
									</div>
									<!--</form>-->

									<div class="col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">Tanggal Transaksi</label>
											<input type="date" class="form-control" id="txt_tgltrans" name="txt_tgltrans" value="<?PHP echo $datenow;?>">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group label-floating">
											<label class="control-label">Nama Customer</label>
											<input type="text" class="form-control" id="txt_namacust" name="txt_namacust">
										</div>
									</div>

									<!--<hr></hr>
									<div class="col-md-6">
										<button type="submit" name="btn_editpas" id="btn_editpas" class="btn btn-warning" style="zoom:85%">Edit Biodata</button>
										<button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-success" style="zoom:85%">Simpan</button>
									</div>
									<div class="col-md-6">
										<button type="submit" name="btn_cetakkartu" id="btn_cetakkartu" class="btn btn-info" style="zoom:85%">Cetak Kartu</button>
										<button type="submit" name="btn_formrm" id="btn_formrm" class="btn btn-info" style="zoom:85%">Form Rekam Medik</button>
										<button type="submit" name="btn_ri" id="btn_simpan" class="btn btn-info" style="zoom:85%">Rawat Inap</button>
										<button type="submit" name="btn_booking" id="btn_booking" class="btn btn-info" style="zoom:85%">Booking Kamar</button>
									</div>-->
								</div>


						</div>

					</div>
				</div>

				<div class="col-md-6">
					<div class="card" style="margin:1px;">

						<div class="col-md-9">
							<div class="form-group label-floating">
								<label class="control-label">Code Product</label>
								<input type="text" class="form-control" id="txt_codeproduct" name="txt_codeproduct" value="exam. DA-1">
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group label-floating">
								<!--<label class="control-label">Code Product</label>-->
								<a data-toggle="modal" data-target="#myModalCariProduct" class="btn btn-warning" style="zoom:85%">Cari</a>
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group label-floating">
								<label class="control-label">Product Name</label>
								<input type="text" class="form-control" id="txt_product" name="txt_product" value="exam. Sirkon">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group label-floating">
								<label class="control-label">Stok</label>
								<input type="text" class="form-control" id="txt_stok" name="txt_stok" value="000">
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group label-floating">
								<label class="control-label">Harga</label>
								<input type="text" class="form-control" id="txt_harga" name="txt_harga" value="000">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group label-floating">
								<label class="control-label">Jumlah</label>
								<input type="text" class="form-control" id="txt_jumlah" name="txt_jumlah">
							</div>
						</div>

						<script>
							var htmlobjek;
							$(document).ready(function(){
								//apabila terjadi event onchange terhadap object txt_codeproduct
								$("#txt_jumlah").change(function(){
									var stok  = $("#txt_stok").val();
									var jum   = $("#txt_jumlah").val();
									var harga = $("#txt_harga").val();

									var subtotal = jum * harga;
									document.getElementById("txt_subtotal").value = subtotal;

								});
							});
						</script>

						<div class="col-md-9">
							<div class="form-group label-floating">
								<label class="control-label">Sub Total</label>
								<input type="text" class="form-control" id="txt_subtotal" name="txt_subtotal" value="000">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group label-floating">
								<!--<label class="control-label">Code Product</label>-->
								<button name="btn_addtochart" id="btn_addtochart" class="btn btn-primary" style="zoom:85%">Add</button>
							</div>
						</div>

					</div>
				</div>

				<div class="col-md-6">
					<div class="card" style="margin:1px;">

						<div class="col-md-12">
							<div class="form-group label-floating">
								<label class="control-label">Total</label>
								<input type="text" class="form-control" id="txt_totalbayar" name="txt_totalbayar">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group label-floating">
								<label class="control-label">Bayar</label>
								<input type="text" class="form-control" id="txt_jumbayar" name="txt_jumbayar">
							</div>
						</div>

						<script>
							var htmlobjek;
							$(document).ready(function(){
								//apabila terjadi event onchange terhadap object txt_codeproduct
								$("#txt_jumbayar").change(function(){
									var totbayar  = $("#txt_totalbayar").val();
									var jumbayar  = $("#txt_jumbayar").val();

									var kembalian = jumbayar - totbayar;
									document.getElementById("txt_kembalian").value = kembalian;

								});
							});
						</script>

						<div class="col-md-7">
							<div class="form-group label-floating">
								<label class="control-label">Kembali</label>
								<input type="text" class="form-control" id="txt_kembalian" name="txt_kembalian" value="0000">
							</div>
						</div>

						<div class="col-md-5">
							<div class="form-group label-floating">
								<label class="control-label">Payment Method</label>
								<label class="radio-inline"><input type="radio" name="rb_paymentmethod" value="Cash">Cash</label>
								<label class="radio-inline"><input type="radio" name="rb_paymentmethod" value="Transfer">Transfer</label>
							</div>
						</div>

						<script>
							var htmlobjek;
							$(document).ready(function(){
								//apabila terjadi event onchange terhadap object txt_codeproduct
								$('input:radio[name=rb_paymentmethod]').change(function() {
									if (this.value == 'Transfer') {
										//alert("Cash");
										document.getElementById("cb_trfvia").disabled=false;
									} else {
										document.getElementById("cb_trfvia").disabled=true;
									}
								});
							});
						</script>

						<div class="col-md-6">
							<div class="form-group label-floating">
								<label class="control-label">Transfer Via</label>
								<select class="form-control js-example-responsive" id="cb_trfvia" name="cb_trfvia" disabled>
									<?PHP
										$qu_selbank = "SELECT * FROM bank WHERE status='Active'";
										$sql_selbank = mysqli_query($conn, $qu_selbank);
										while($data_selbank = mysqli_fetch_array($sql_selbank)){
									?>
											<option value="<?PHP echo $data_selbank['id_bank'];?>" ><?PHP echo $data_selbank['nama_bank']." | ".$data_selbank['atas_nama'];?></option>
									<?PHP
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group label-floating">
								<!--<label class="control-label">Code Product</label>-->
								<button name="btn_save" id="btn_save" class="btn btn-warning" style="zoom:85%">Save</button>
								<button name="btn_saveprint" id="btn_saveprint" class="btn btn-info" style="zoom:85%">Save & Print</button>
							</div>
						</div>

					</div>
				</div>
			</form>


			<div class="col-md-12">
                <div class="card">

					<div class="card-content">

							<div class="row">

								<table class="table table-bordered" name="tbl_detailbelanja" id="tbl_detailbelanja">
									<thead class="text-primary">
										<th align="center">No</th>
										<th></th>
										<th align="center">Product</th>
										<th align="center">Price (Rp.)</th>
										<th align="center">Quantity </th>
										<th align="center">Sub-Total</th>
										<th align="center">Action</th>
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

											<!--Modal Konfirmasi Delete===================================================================================================================================-->
											<div class="modal fade" id="myModalDelProduk<?PHP echo $no_seltransdetail;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document" style="width:40%">
													<div class="modal-content">
														<form method="post" action="?view=transaction-action" enctype="multipart/form-data">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Batal Beli Produk</h4>
															</div>

															<hr></hr>

															<div class="modal-body">
																<p align="center">
																	<input type="hidden" id="txt_idprodukbelanja" name="txt_idprodukbelanja" value="<?PHP echo $data_seltransdetail['id_produk'];?>">
																	<input type="hidden" id="txt_iduserbelanja" name="txt_iduserbelanja" value="<?PHP echo $iduserlogin;?>">
																	<img src="assets/img/product/<?PHP echo $data_seltransdetail['picture'];?>" style="width:80px" style="align:center">
																	<br>
																	<?PHP echo $data_seltransdetail['nama_produk'];?>
																	<br>
																	Apakah produk ini batal dibeli?
																</p>
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
											$no_seltransdetail++;
										}
									?>
									</tbody>

								</table>
								<script>
									var htmlobjek;
									$(document).ready(function(){
											document.getElementById("txt_totalbayar").value = "<?PHP echo $total;?>";
									});
								</script>

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
