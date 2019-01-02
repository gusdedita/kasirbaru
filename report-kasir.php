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
								if (isset($_POST['btn_lapringkas'])) {
									
									$tglstart = $_POST['txt_datemulai'];
									$tglend   = $_POST['txt_dateakhir'];
							?>
									
									<br></br>
										<p align="center"><font><b>LAPORAN HARIAN KASIR POS DAYU ALPAKA</b></font></p>
										<p align="center"><font><b>Tanggal Laporan <?PHP echo $tglstart;?> s/d <?PHP echo $tglend;?></b></font></p>
									<br>
									<table class="table table-bordered" name="tbl_lapringkas" id="tbl_lapringkas">
										<tr>
											<td align="center"><b>No</b></td>
											<td align="center"><b>No. Trans.</b></td>
											<td align="center"><b>Tgl. Trans.</b></td>
											<td><b>Member</b></td>
											<td align="center"><b>Jenis Pembayaran</b></td>
											<td align="center"><b>Jumlah Produk</b></td>
											<td align="center"><b>Total Bayar</b></td>
										</tr>

										<tbody>
											<?PHP
												$no_selpenjualan  = 1;
												$total = 0;
												$total_quantity = 0;
												
												$qu_selpenjualan  = "SELECT 
																		p.id_penjualan,
																		p.datecreated,
																		c.nama_customer,
																		p.jenis_bayar,
																		p.total
																	FROM 
																		penjualan AS p
																		LEFT JOIN customer AS c ON p.id_customer=c.id_customer
																	WHERE 
																		(p.datecreated BETWEEN '$tglstart' AND '$tglend') 
																		AND p.dateclose IS NULL
																		AND id_cabang='$idcabang'";
												$sql_selpenjualan = mysqli_query($conn, $qu_selpenjualan);
												while($data_selpenjualan = mysqli_fetch_array($sql_selpenjualan)){
													$total = $total + $data_selpenjualan['total'];
													$idpenjualan = $data_selpenjualan['id_penjualan'];
													
													$qu_seljumproduk = "SELECT SUM(quantity) AS JUMPRO FROM penjualan_detail WHERE id_penjualan='$idpenjualan'";
													$sql_seljumproduk = mysqli_query($conn, $qu_seljumproduk);
													$data_seljumproduk = mysqli_fetch_assoc($sql_seljumproduk);
													
													$total_quantity = $total_quantity + $data_seljumproduk['JUMPRO'];
											?>
													<tr>
														<td align="center"><?PHP echo $no_selpenjualan;?></td>
														<td align="center"><?PHP echo $data_selpenjualan['id_penjualan'];?></td>
														<td align="center"><?PHP echo $data_selpenjualan['datecreated'];?></td>
														<td><?PHP if ($data_selpenjualan['nama_customer']==""){echo " - ";} else {echo $data_selpenjualan['nama_customer'];}?></td>
														<td align="center"><?PHP echo $data_selpenjualan['jenis_bayar'];?></td>
														<td align="center"><?PHP echo $data_seljumproduk['JUMPRO'];?></td>
														<td align="right"><?PHP echo rupiah($data_selpenjualan['total']);?></td>
													</tr>

											<?PHP
													$no_selpenjualan++;
												}
											?>
											
											<tr>
												<td colspan="5" align="right"><b>Total Penjualan</b></td>
												<td align="center"><?PHP echo $total_quantity;?> Pcs Produk</td>
												<td align="right">Rp. <?PHP echo rupiah($total);?></td>
											</tr>
											
										</tbody>

									</table>
									
									<?PHP
										$qu_seljumjenisbayar = "SELECT 
																	p.jenis_bayar,
																	SUM(p.total) AS JUMJENISBAYAR
																FROM 
																	penjualan AS p
																WHERE 
																	(p.datecreated BETWEEN '$tglstart' AND '$tglend') 
																	AND p.dateclose IS NULL
																	AND id_cabang='$idcabang'
																GROUP BY 
																	p.jenis_bayar";
										$sql_seljumjenisbayar = mysqli_query($conn, $qu_seljumjenisbayar);
										while($data_seljumjenisbayar = mysqli_fetch_array($sql_seljumjenisbayar)){
											if ($data_seljumjenisbayar['jenis_bayar']=="Cash"){
												$jumcash = $data_seljumjenisbayar['JUMJENISBAYAR'];
											} else if ($data_seljumjenisbayar['jenis_bayar']=="Transfer"){
												$jumtrf = $data_seljumjenisbayar['JUMJENISBAYAR'];
											}
										}
									
									?>
									
									<br></br>
									
									<form method="post" action="?view=report-kasir-action" >
									
										<input type="hidden" name="txt_userlogin" id="txt_userlogin" value="<?PHP echo $iduserlogin;?>" >
										<input type="hidden" name="txt_idcabang" id="txt_idcabang" value="<?PHP echo $idcabang;?>" >
										<input type="hidden" name="txt_tglstart" id="txt_tglstart" value="<?PHP echo $tglstart;?>" >
										<input type="hidden" name="txt_tglend" id="txt_tglend" value="<?PHP echo $tglend;?>" >
										<input type="hidden" name="txt_jumtot" id="txt_jumtot" value="<?PHP echo $total;?>" >
										
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Jumlah Fisik Cash</label>
												<input type="number" class="form-control" id="txt_jumfisik" name="txt_jumfisik" value="<?PHP echo $jumcash;?>">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Jumlah Transfer</label>
												<input type="number" class="form-control" id="txt_jumtrf" name="txt_jumtrf" value="<?PHP echo $jumtrf;?>">
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group label-floating">
												<label class="control-label">Catatan</label>
												<textarea class="form-control" id="txt_catatanclose" name="txt_catatanclose" ></textarea>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group label-floating">
												<label class="control-label"></label>
												<button class="btn btn-info btn-round" style="zoom:80%" name="btn_saveprint" id="btn_saveprint">Save & Print</button>
											</div>
										</div>
										
									</form>
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








