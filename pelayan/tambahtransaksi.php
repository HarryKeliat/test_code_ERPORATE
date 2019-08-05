<?php
	session_start();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	if (!isset($_SESSION['level'])) 
	{
		header("Location: ../keamanan.php");
		exit();
	}

	$tgl = date("dmY");
	
	$carikode = mysqli_query($conn, "SELECT MAX(pemesenan) from db_transaksi");
	  $datakode = mysqli_fetch_array($carikode);
	  if ($datakode) {
	   $nilaikode = substr($datakode[0], 1);
	   $kode = (int) $nilaikode;
	   $kode = $kode + 1;
	   $kode_otomatis = "P".str_pad($kode, 4, "0", STR_PAD_LEFT);
	  } else {
	   $kode_otomatis = "001";
	  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Restoran A</title>
	<link rel="stylesheet" type="text/css" href="../Style/Utama/HAF.css">
	<link rel="stylesheet" type="text/css" href="../Style/tambahtransaksi.css">
	<link rel='stylesheet' href="../Style/Utama/opensans.css">
	<link rel="stylesheet" href="../Style/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../Style/Bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../Style/JQuery/jquery-ui.css">
	<script src="../JS/popper.min.js" ></script>
	<script src="../JS/bootstrap.min.js" ></script>
	<script src='../JS/jquery-1.12.4.js'></script>
	<script src='../JS/jquery-1.12.4.min.js'></script>
	<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
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
		<div class="col-lg-6">
		    <h2>Daftar Menu Makanan Available</h2>
		    <div class="table-responsive">
		    	<table class="table table-striped table-bordered table-hover" style="text-align: center;">
					<tr class="rwh-tr">
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">Nama Makanan</th>
						<th style="text-align: center;">Harga</th>
					</tr>
					<?php 
						include '../koneksi.php';
						$no = 1;
						$query = mysqli_query($conn,"SELECT * FROM db_makanan WHERE status = 'Ready'");
						while ($hasil = mysqli_fetch_array($query)) {
					?>
						<tr class="rwd-tr">
							<td><?php echo $no++; ?>.</td>
							<td><?php echo $hasil ['makanan']; ?></td>
							<td>Rp. <?php echo $hasil ['harga']; ?></td>
						</tr>
						<?php } ?>		
				</table>
			</div>
			<h2>Daftar Menu Minuman Available</h2>
		    <div class="table-responsive">
		    	<table class="table table-striped table-bordered table-hover" style="text-align: center;">
					<tr class="rwh-tr">
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">Nama Minuman</th>
						<th style="text-align: center;">Harga</th>
					</tr>
					<?php 
						include '../koneksi.php';
						$no = 1;
						$query = mysqli_query($conn,"SELECT * FROM db_minuman WHERE status = 'Ready'");
						while ($hasil = mysqli_fetch_array($query)) {
					?>
						<tr class="rwd-tr">
							<td><?php echo $no++; ?>.</td>
							<td><?php echo $hasil ['minuman']; ?></td>
							<td>Rp. <?php echo $hasil ['harga']; ?></td>
						</tr>
						<?php } ?>		
				</table>
			</div>
		</div>
		<div class="col-lg-6">
		    <div class="col-sm-9 col-md-7 col-lg-9 mx-auto" style=" margin-top: 50px; background-image: url('Image/back.jpg');">
		    		<h3 style="font-size: 35px; font-weight: bold;color: white;">Buat Pemesanan</h3>
		    		<form action="" method="post" enctype="multipart/form-data">
						<div class="form-row">
						    <div class="form-group col-md-6">
						      <label style="color: white;">No. Pemesanan</label>
							  <input type="text" class="form-control" required name="pemesanan" value="ERP<?php echo $tgl; ?>-<?php echo $kode_otomatis; ?>" readonly>
						    </div>
						    <div class="form-group col-md-3">
						      <label style="color: white;">Nama Pelayan</label>
						      <input type="text" class="form-control" required name="pelayan" autocomplete="off" value="<?php echo $_SESSION['nama']; ?>" readonly>
						    </div>
						    <div class="form-group col-md-3">
						      <label style="color: white;">Status</label>
						      <input type="text" class="form-control" required name="status" autocomplete="off" value="Ready" readonly>
						    </div>
						</div>
						<div class="form-row">
						    <div class="form-group col-md-3">
						      <label style="color: white;">No. Meja</label>
						      <input type="number" class="form-control" required name="nomer" autocomplete="off">
						    </div>
						    <div class="form-group col-md-9">
						      <label style="color: white;">Nama Pelanggan</label>
						      <input type="text" class="form-control" required name="nama" autocomplete="off">
						    </div>
						</div>

						<h3 style="font-size: 25px; font-weight: bold; text-align: left;color: white;"> Tulis Pesanan</h3>
						<div class="form-group">
					    	<textarea class="form-control" rows="10" name="isi" required autocomplete="off"oninvalid="this.setCustomValidity('Wajib Masukan Isi Berita')"></textarea>
					  	</div>

					  	<button type="submit" name="masuk" class="btn btn-success" style="width: 100%; margin-bottom: 20px;">Tambah Transaksi Pemesenan</button>
					  	<?php
			                if(isset($_POST['masuk'])){
			                include "../koneksi.php";
			                $insert = mysqli_query($conn, "INSERT INTO db_transaksi VALUES
			                    	(NULL, '".$_POST['pemesanan']."',
			                    		   '".$_POST['pelayan']."',
			                    		   '".$_POST['status']."',
			                    		   '".$_POST['nomer']."',
			                    		   '".$_POST['nama']."',
			                               '".$_POST['isi']."')" );
			                    if ($insert) 
			                    {
			                      echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=transaksi.php">';
			                    }
			                    else
			                    {
			                       echo '<script language="javascript">';
									echo 'alert("Gagal Menambahkan Data Transaksi")';
									echo '</script>';
									echo  '<META HTTP-EQUIV="Refresh"; Content="0; URL=tambahtransaksi.php">';
			                    }
			                }
			            ?>
					</form>
					<script>
		                CKEDITOR.replace( 'isi' );
		            </script>
		    </div>
		</div>
</body>
</html>


