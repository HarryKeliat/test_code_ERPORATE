<?php 
	include '../koneksi.php';
	$id = $_GET['id'];

	$delete = mysqli_query($conn, "DELETE FROM db_transaksi WHERE id = '$id'");

	echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=transaksi.php">';
	
 ?>

