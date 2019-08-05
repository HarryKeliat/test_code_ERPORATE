<?php 
	include '../koneksi.php';
	$id = $_GET['id'];
	$delete = mysqli_query($conn, "DELETE FROM db_minuman WHERE id = '".$_GET['id']."'");
	if ($delete)
	{
	echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=minuman.php">';
	 }
	else
	{
	echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=minuman.php">';
	}
 ?>