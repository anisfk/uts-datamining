<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Mining K-NN</title>
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/sytle.css">
</head>
<body>
	<div id="bungkus" class="d-flex justify-content-center">
		<div class="card mt-3 col-6">
			<div class="card-body col-12">
				<h3 class="card-title text-center">Data Pengukuran Berat Badan Ideal Wanita Dengan Metode K-NN</h3><br>
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
					Tambah Data
				</button>&nbsp
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hitungModal">
					Hitung
				</button>
				<table class="table table-bordered mt-3 text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>X (TB/cm)</th>
							<th>Y (BB/kg)</th>
							<th>Kategori</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$query = "SELECT * FROM badan_ideal";
						$result = mysqli_query($koneksi, $query);

						$queryid = "SELECT * FROM badan_ideal WHERE id IN (SELECT MAX(id) FROM badan_ideal)";
						$resultid = mysqli_query($koneksi, $queryid);
						$id_desc = mysqli_fetch_assoc($resultid);
						$i=1;

						foreach ($result as $data) { ?>
							<tr>
								<td><?php echo $i++?></td>
								<td><?php echo $data['x']?></td>
								<td><?php echo $data['y']?></td>
								<td <?php echo ($data['kategori']=="Ideal") ? "style='background-color: #ADFFA7; color: #20982C;'" : "style='background-color: #FFAEAE; color: #B53030'" ?>><?php echo $data['kategori']?></td>
								<td class="aksi">
									<!-- Button trigger modal -->
									<a class="text-decoration-none text-success pe-2" data-bs-toggle="modal" data-target="#editModal<?php echo $data['id'] ?>" href="#editModal<?php echo $data['id'] ?>">Edit</a>
									<?php
									if($data['id']==$id_desc['id']) : ?>
										|<a class="text-decoration-none text-danger ps-2" data-bs-toggle="modal" data-target="#hapusModal<?php echo $data['id'] ?>" href="#hapusModal<?php echo $data['id'] ?>">Hapus</a>
									<?php endif; ?>
								</td>

								<!-- Edit Modal -->
								<div class="modal fade" id="editModal<?php echo $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal<?php echo $data['id'] ?>Label" aria-hidden="true">
									<div class="modal-dialog modal-dialog-scrollable">
										<form action="aksi.php?opsi=edit" method="POST">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="editModal<?php echo $data['id'] ?>Label">Edit Data</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="row mb-3">
														<label for="x" class="col-sm-4 col-form-label">X (TB/cm)</label>
														<div class="col-sm-8">
															<input type="text" id="x" name="x" class="form-control" value="<?php echo $data['x'] ?>">
														</div>
													</div>
													<div class="row mb-3">
														<label for="y" class="col-sm-4 col-form-label">Y (BB/kg)</label>
														<div class="col-sm-8">
															<input type="text" id="y" name="y" class="form-control" value="<?php echo $data['y'] ?>">
														</div>
													</div>
													<div class="row mb-3">
														<label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
														<div class="col-sm-8">
															<select id="kategori" name="kategori" class="form-select" value="">
																<option value="Ideal" <?php echo ($data['kategori'] == "Ideal") ? "selected" : "" ?> >Ideal</option>
																<option value="Tidak Ideal" <?php echo ($data['kategori'] == "Tidak Ideal") ? "selected" : "" ?> >Tidak Ideal</option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer justify-content-center">

													<input type="submit" name="submit" value="Edit" class="btn btn-primary text-white col-12 col-lg p-2">

												</div>
											</div>
										</form>
									</div>
								</div>
								<!-- Hapus Modal -->
								<div class="modal fade" id="hapusModal<?php echo $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusModal<?php echo $data['id'] ?>Label" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title fw-bolder" id="hapusModal<?php echo $data['id'] ?>Label">Konfirmasi</h5>
											</div>
											<div class="modal-body">
												<h5>Yakin Menghapus Data ke <?php echo $i-1?>?</h5>
											</div>
											<div class="modal-footer justify-content">

												<button type="button" class="btn btn-secondary pe-3" data-bs-dismiss="modal" aria-label="Close">Batal</button>

												<a class="btn btn-danger px-4 text-decoration-none text-danger text-white" href="index.php?id=<?php echo $data['id']?>&opsi=delete">Ya</a>

											</div>
										</div>
									</div>
								</div>
							</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<!--  Tambah Modal -->
		<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="aksi.php?opsi=input" method="POST">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="row mb-3">
								<label for="x" class="col-sm-4 col-form-label">X (TB/cm)</label>
								<div class="col-sm-8">
									<input type="text" id="x" name="x" class="form-control" value="">
								</div>
							</div>
							<div class="row mb-3">
								<label for="y" class="col-sm-4 col-form-label">Y (BB/kg)</label>
								<div class="col-sm-8">
									<input type="text" id="y" name="y" class="form-control" value="">
								</div>
							</div>
							<div class="row mb-3">
								<label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
								<div class="col-sm-8">
									<select id="kategori" name="kategori" class="form-select" value="">
										<option>Ideal</option>
										<option>Tidak Ideal</option>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-center">

							<input type="submit" name="submit" value="Simpan" class="btn btn-primary text-white col-12 col-lg-11 p-2">

						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- Tambah Modal -->
		<!--  Hitung Modal -->
		<div class="modal fade" id="hitungModal" tabindex="-1" aria-labelledby="hitungModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="index.php?opsi=hitung" method="POST">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="hitungModalLabel">Hitung Data Testing</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="row mb-3">
								<label for="x1" class="col-sm-4 col-form-label">X1 (TB/cm)</label>
								<div class="col-sm-8">
									<input type="text" id="x1" name="x1" class="form-control" value="">
								</div>
							</div>
							<div class="row mb-3">
								<label for="y1" class="col-sm-4 col-form-label">Y1 (BB/kg)</label>
								<div class="col-sm-8">
									<input type="text" id="y1" name="y1" class="form-control" value="">
								</div>
							</div>
							<div class="row mb-3">
								<label for="k" class="col-sm-4 col-form-label">Nilai K</label>
								<div class="col-sm-8">
									<input type="text" id="k" name="k" class="form-control" value="">
								</div>
							</div>
						</div>
						<div class="modal-footer justify-content-center">

							<input type="submit" name="submit" value="Hitung" class="btn btn-primary text-white col-12 col-lg-11 p-2">

						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- Hitung Modal -->
	</div>
	<div id="bungkus" class="d-flex justify-content-center">
		<div class="card mt-3 col-6 col-lg-6 mb-3">
			<div class="card-body col-12">
				<h4 class="fw-bolder" style="margin-top: 10px !important;">Klasifikasi Data</h4><br>
				<a class="btn btn-primary mb-3" href="index.php">Reset</a>
				<table class="table table-bordered mt-3 text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th scope="col">X1 (TB/cm)</th>
							<th scope="col">Y1 (BB/kg)</th>
							<th scope="col">Nilai Jarak</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if(isset($_GET['opsi'])) :
							$opsi = $_GET['opsi'];

							if ($opsi=="hitung") : ?> 
								<p>X1 (TB/cm) = <b><?php echo $_POST['x1']?></b> &nbsp&nbsp&nbsp&nbsp Y1 (BB/kg) = <b><?php echo $_POST['y1']?></b>  &nbsp&nbsp&nbsp&nbsp Nilai K = <b><?php echo $_POST['k']?></b> </p>
								<?php
								if (isset($_POST['x1'])){ $x1 = $_POST['x1']; }
								if (isset($_POST['y1'])){ $y1 = $_POST['y1']; }
								$query= "SELECT * FROM badan_ideal";
								$result=mysqli_query($koneksi, $query);
								$i=1;
								foreach ($result as $dataolah) { ?>
									<tr>
										<td><?php echo $dataolah['x']?></td>
										<td><?php echo $dataolah['y']?></td>
										<?php 
										$jarak = sqrt(pow($dataolah['x']-$x1,2)+pow($dataolah['y']-$y1,2));
										$query = "UPDATE badan_ideal SET hitung = '$jarak' WHERE id = $i";
										$update = mysqli_query($koneksi,$query);
										$i++;
										?>
										<td><?php echo $jarak?></td>
									</tr>

								<?php } ?>
							</tbody>
						</table>
						<!-- hasil -->
						<h4 class="fw-bolder" style="margin-top: 60px !important;">Hasil Data K= <?php echo $_POST['k']?></h4>
						<table class="table table-bordered mt-3 text-center" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th scope="col">X1 (TB/cm)</th>
									<th scope="col">Y1 (BB/kg)</th>
									<th scope="col">Nilai Jarak</th>
									<th scope="col" class="col-4">Klasifikasi Data</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$arrayideal 	 = array();
								$arraytidakideal = array();

								$K = (int)$_POST['k'];
								$query = "SELECT * FROM badan_ideal ORDER BY hitung ASC LIMIT 0,$K";
								$k = mysqli_query($koneksi, $query);
								foreach ($k as $batask) { ?>
									<tr>
										<td><?php echo $batask['x']?></td>
										<td><?php echo $batask['y']?></td>
										<td><?php echo $batask['hitung']?></td>
										<td <?php echo ($batask['kategori']=="Ideal") ? "style='background-color: #ADFFA7; color: #20982C;'" : "style='background-color: #FFAEAE; color: #B53030'" ?> > <?php echo $batask['kategori']?></td>
									</tr>

									<?php
									if($batask['kategori']=="Ideal") :
										array_push($arrayideal, $batask['kategori']);
									endif;
									if($batask['kategori']=="Tidak Ideal") :
										array_push($arraytidakideal, $batask['kategori']);
									endif;
								} ?>
							</tbody>
						</table>

						<?php
						// hasil //
						$jumlahideal 	  = count($arrayideal);
						$jumlahtidakideal = count($arraytidakideal);
						$kategori 		  = ($jumlahideal>$jumlahtidakideal) ? "Ideal" : "Tidak Ideal";
						?>
						<h4 class="fw-bolder" style="margin-top: 60px !important;">Hasil Klasifikasi</h4>
						<table class="table table-bordered mt-3 text-center" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th scope="col">X1 (TB/cm)</th>
									<th scope="col">Y1 (BB/kg)</th>
									<th scope="col" class="col-4">Klasifikasi Data</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $_POST['x1']?></td>
									<td><?php echo $_POST['y1']?></td>
									<td <?php echo ($kategori=="Ideal") ? "style='background-color: #ADFFA7; color: #20982C;'" : "style='background-color: #FFAEAE; color: #B53030'" ?> ><?php echo $kategori?></td>
								</tr>
							</tbody>

						</div>
					</div>
				<?php endif; 
			endif; ?>
		</table>
	</div>
</div>
<script type="text/javascript" src="Bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
<?php
require('script.php');
?>
