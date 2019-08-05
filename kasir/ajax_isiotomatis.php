<?php
include "../koneksi.php";
$minuman = $_GET['makanan'];
$query = mysqli_query($conn, "SELECT * from db_buku where makanan = '".$minuman."'");
$kuku = mysqli_fetch_array($query);
$data = array('harga'=>$kuku['status']);
echo json_encode($data);
?>