<?php
	session_start();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	if (!isset($_SESSION['level'])) 
	{
		header("Location: ../keamanan.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Restoran A</title>
	<link rel="stylesheet" type="text/css" href="../Style/Utama/HAF.css">
	<link rel="stylesheet" type="text/css" href="../Style/pengembalian.css">
	<link rel='stylesheet' href="../Style/Utama/opensans.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="../Style/Bootstrap/bootstrap.min.css">
	<script src="../JS/jquery-3.3.1.slim.min.js"></script>
	<script src="../JS/popper.min.js" ></script>
	<script src="../JS/bootstrap.min.js" ></script>
	<script src='../JS/jquery-3.3.1.min.js'></script>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
		<!-- Header & Navigasi -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-image: url('Image/back.jpg');">
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border:2px solid white;">
		    <i class="fas fa-bars" style="color: white;"></i>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    	<ul class="navbar-nav ml-auto" style="margin-right: 10px;">
					<li class="nav-item">
					<li class="nav-item">
						<a class="nav-link" href="transaksi.php" style="color: #ff0040">Daftar Transaksi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="laporanexcel.php" style="color: white">Cetak Laporan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../keluar.php" style="color: white">Logout</a>
					</li>
					<li class="nav-item">
						<h3 id="selamat">| Selamat Datang <?php echo $_SESSION['nama']; ?> </h3>
					</li>
		    	</ul>
		  	</div>
		</nav>

		<!-- Content -->
		<div class="container-fluid">
			<div class="col-lg-12">
		    	<h2>Daftar Transaksi Pemesanan Makanan & Minuman</h2>
		    	<h3><a href="tambahtransaksi.php" class="btn btn-success" role="button"><i class="fas fa-plus"></i> Tambah Transaksi</a></h3>

			    <div class="col-sm-12" style="background-image: url('Image/back.jpg'); margin-bottom: 20px;">
		    		<form action="" method="post" enctype="multipart/form-data">
					  <div class="input-group mb-3" style="margin-top: 20px;">
						  <input type="text" class="form-control" placeholder="Cari Data Transaksi. . . ." aria-label="Recipient's username" aria-describedby="basic-addon2" name="cari" required autocomplete="off" oninvalid="this.setCustomValidity('Tolong Masukan Data Transaksi Yang Akan Di Cari')">
						  <div class="input-group-append">
						    <button type="submit" class="btn btn-success" type="button">Cari Data</button>
						  </div>
					   </div>
					</form>
					<div id="myAlert" class="alert alert-danger collapse">
						<a id="linkClose" href="" class="close">&times;</a>
						<strong>Data transaksi yang di cari tidak di temukan !!!</strong>
					</div>
		    	</div>

					<div class="table-responsive">
		    		<table class="table table-striped table-bordered table-hover" style="text-align: center;">
						 <tr class="rwh-tr">
						 	<th style="text-align: center;">No</th>
						    <th style="text-align: center;">No. Pemesanan</th>
						    <th style="text-align: center;">Pelayan/Kasir</th>
						    <th style="text-align: center;">No. Meja</th>
						    <th style="text-align: center;">Nama Pelanggan</th>
						    <th style="text-align: center;">Isi Pesanan</th>
						    <th style="text-align: center;">Keterangan</th>
						 </tr>
						 <?php 
							include '../koneksi.php';
							$batas = 10;
							$hal = @$_GET['hal'];
							if (empty($hal)) 
							{
								$posisi = 0;
								$hal = 1;
							}
							else
							{
								$posisi = ($hal - 1)* $batas;
							}

							$no = 1;
							if ($_SERVER['REQUEST_METHOD'] == "POST")
							{
								$cari = trim(mysqli_real_escape_string($conn, $_POST['cari']));
								if ($cari != '') 
								{
									$sql = "SELECT * FROM db_transaksi WHERE 
											pemesanan LIKE '%$cari%' OR 
											pelayan LIKE '%$cari%' OR
											nomer LIKE '%$cari%' OR
											nama LIKE '%$cari%'";
									$query = $sql;
									$queryJML = $sql;
								}
								else
								{
									$query = "SELECT * FROM db_transaksi LIMIT $posisi, $batas";
									$queryJML = "SELECT * FROM db_transaksi";
									$no = $posisi + 1;
								}
							}
							else
							{
								$query = "SELECT * FROM db_transaksi ORDER BY id DESC LIMIT $posisi, $batas ";
								$queryJML = "SELECT * FROM db_transaksi WHERE status = 'Ready'";
								$no = $posisi + 1;
							}
							
							$sql_buku = mysqli_query($conn, $query);
							if (mysqli_num_rows($sql_buku) > 0) 
							{
								while ($hasil = mysqli_fetch_array($sql_buku)) {?>
						 <tr class="rwd-tr">
						 	<td><?php echo $no++; ?>.</td>
						  	<td><?php echo $hasil ['pemesanan']; ?></td>
						    <td><?php echo $hasil ['pelayan']; ?></td>
						    <td><?php echo $hasil ['nomer']; ?></td>
						    <td><?php echo $hasil ['nama']; ?></td>
						    <td><?php echo $hasil ['isi']; ?></td>
						    <td><a href="edittransaksi.php?id=<?php echo $hasil['id']?>" class="btn btn-primary" role="button"><i class="far fa-edit"></i> Edit Pesanan</a>
								<a href="bayar.php?id=<?php echo $hasil['id']?>" class="btn btn-danger" role="button" ><i class="far fa-trash-alt"></i> Bayar</a></td>
						 </tr>
						 <?php } 
						} 
						else
						{
							echo "<tr><td colspan=\"8\" align=\"center\" style=\"color: red; font-weight: bold;\" >Data transaksi tidak di temukan / Data transaksi belum ada</tr>";
						}
						?>	
					</table>
		    		</div>
		    		<?php  
					if ($_POST['cari'] == '') { ?>
						<div style="float: left;">
							<ul class="pagination pagination-sm" style="margin: 0;">
								<?php 
								$jml = mysqli_num_rows(mysqli_query($conn, $queryJML));
								$jml_hal = ceil($jml / $batas);
								for ($i=1; $i <= $jml_hal; $i++) 
								{ 
									 if ($i != $hal) 
									 	{
									 		echo "<li class=\"page-item\"><a href=\"?hal=$i\" class=\"page-link\">$i</a></li>";
									 	}
									 	else
									 	{
									 		echo "<li class=\"page-item active\"><a class=\"page-link\">$i</a></li>";
									 	}	
									} 
								?>
							</ul>
						</div>
					<?php
					}
					else
					{
						echo "<div style=\"float: left; background-color: #1e90ff; padding: 10px; color: white;\">";
						$jml = mysqli_num_rows(mysqli_query($conn, $queryJML));
						echo "Data transaksi yang di temukan : <b>$jml</b> transaksi";
						echo "</div>";
					}
					?>
			</div>
		</div>
		
</body>
</html>