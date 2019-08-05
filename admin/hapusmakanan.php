<?php 
	include '../koneksi.php';
	$id = $_GET['id'];
	$delete = mysqli_query($conn, "DELETE FROM db_makanan WHERE id = '".$_GET['id']."'");
	if ($delete)
	{
	echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=makanan.php">';
	 }
	else
	{
	echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=makanan.php">';
	}
 ?>