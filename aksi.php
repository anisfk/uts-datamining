<?php
session_start();
require 'koneksi.php';

if (isset($_GET['opsi'])) :

	$opsi = $_GET['opsi'];

if($opsi=="input") { //opsi input

	if (isset($_POST['x'])) { $x = $_POST['x']; } else { echo "x tidak ditemukan"; }
	if (isset($_POST['y'])) { $y = $_POST['y']; } else { echo "y tidak ditemukan"; }
	if (isset($_POST['kategori'])) { $kategori = $_POST['kategori']; } else { echo "kategori tidak ditemukan"; }

	$query = "INSERT INTO badan_ideal (x, y, kategori) VALUES ('$x', '$y', '$kategori')";

	$insert = mysqli_query($koneksi,$query);

	if ($insert == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else {
		?>
		<script type='text/javascript'>
			alert('Sukses Menambah Data');
			window.location.href="index.php";
		</script>
		<?php
	}

} elseif($opsi=="edit") { //opsi update

	if (isset($_POST['id'])) {$id = $_POST['id']; } else {echo "id tidak ditemukan"; }
	if (isset($_POST['x'])) { $x = $_POST['x']; } else { echo "x tidak ditemukan"; }
	if (isset($_POST['y'])) { $y = $_POST['y']; } else { echo "y tidak ditemukan"; }
	if (isset($_POST['kategori'])) { $kategori = $_POST['kategori']; } else { echo "kategori tidak ditemukan"; }

	$query = "UPDATE badan_ideal SET x='$x', y='$y', kategori='$kategori' WHERE id= '$id'";

	$update = mysqli_query($koneksi,$query);
	
	if ($update == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else {
		?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data');
			window.location.href="index.php";
		</script>
		<?php
	}	

} elseif($opsi=="delete") { //opsi delete
	if (isset($_GET['id'])) {$id = $_GET['id']; } else {echo "id tidak ditemukan";}

	// hapus data
	$query = "DELETE FROM badan_ideal WHERE id = $id";
	$delete = mysqli_query($koneksi,$query);

	// panggil data id paling terakhir
	$query = "SELECT id FROM badan_ideal ORDER BY id DESC";
	$result = mysqli_query($koneksi,$query);
	$id_desc = mysqli_fetch_assoc($result);
	// jumlahkan data id terakhir
	$ai = $id_desc['id']+1;

	// tetapkan auto incremet baru agar kembali terurut dari data sembelumnya
	$query = "ALTER TABLE badan_ideal auto_increment=$ai";
	$alter = mysqli_query($koneksi,$query);

	if ($delete == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menghapus Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else {
		?>
		<script type='text/javascript'>
			alert('Sukses Menghapus Data');
			window.location.href="index.php";
		</script>
		<?php
	}
}

endif;
?>