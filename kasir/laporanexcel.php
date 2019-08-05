<?php
	
	include '../koneksi.php';

	$filename = "Laporan Data Transaksi Pemesenan (".date("d-m-Y").").xls";

	  header("Content-Disposition: attachment; filename='$filename'");
  		header("Content-Type: application/vnd.ms-excel");

?>

<h2>Laporan Data Transaksi Pemesenan </h2>

<table border="2">
	<tr style="font-size: 20px;">
		<th style="text-align: center;">No</th>
			<th style="text-align: center;">No. Pemesanan</th>
			<th style="text-align: center;">Pelayan/Kasir</th>
			<th style="text-align: center;">No. Meja</th>
			<th style="text-align: center;">Nama Pelanggan</th>
			<th style="text-align: center;">Isi Pesanan</th>
	</tr>
		<?php 
			include '../koneksi.php';
			$no = 1;
			
			$poster = mysqli_query($conn, "SELECT * FROM db_transaksi ORDER BY nama ASC");
			while ($hasil = mysqli_fetch_array($poster)) {
			?>
			<tr style="font-size: 15px;">
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $hasil ['pemesanan']; ?></td>
				<td><?php echo $hasil ['pelayan']; ?></td>
				<td><?php echo $hasil ['nomer']; ?></td>
				<td><?php echo $hasil ['nama']; ?></td>
				<td><?php echo $hasil ['isi']; ?></td>
			</tr>
		<?php } ?>
</table>