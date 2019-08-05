<?php
	session_start();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	if (!isset($_SESSION['level'])) 
	{
		header("Location: ../keamanan.php");
		exit();
	}

	include "../koneksi.php";
	$id = $_GET['id'];
	$data_edit = mysqli_query($conn, "SELECT * FROM db_minuman WHERE id = '".$id."'");
	$row = mysqli_fetch_array($data_edit);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Restoran A</title>
	<link rel="stylesheet" type="text/css" href="../Style/Utama/HAF.css">
	<link rel="stylesheet" type="text/css" href="../Style/editmakanan.css">
	<link rel='stylesheet' href="../Style/Utama/opensans.css">
	<link rel="stylesheet" href="../Style/font-awesome-4.7.0/css/font-awesome.min.css">
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
						<a class="nav-link" href="makanan.php" style="color: white">Daftar Makanan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="minuman.php" style="color: #ff0040">Daftar Minuman</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="transaksi.php" style="color: white">Daftar Transaksi</a>
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
		<div class="col-lg-12">
		    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto" 
		    	style=" margin-top: 150px; background-image: url('Image/back.jpg');">
		    		<h3 style="font-size: 35px; font-weight: bold;color: white;">Edit Data Minuman</h3>
		    		<div id="myAlert" class="alert alert-success collapse">
						<a id="linkClose" href="" class="close">&times;</a>
						<strong>Daftar Minuman berhasil di rubah !!!</strong>
					</div>
					<div id="myAlert2" class="alert alert-danger collapse">
						<a id="linkClose" href="" class="close">&times;</a>
						<strong>Daftar Minuman gagal di rubah !!!</strong>
					</div>
		    		<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
						    <label style="color: white;">Nama Minuman</label>
						    <input type="text" class="form-control" required name="minuman" value="<?php echo $row['minuman'] ?>" autocomplete="off" oninvalid="this.setCustomValidity('Wajib Masukan Nama Minuman')">
						</div>
					  	<div class="form-row">
						    <div class="form-group col-md-6">
						      <label style="color: white;">Harga</label>
						      <input type="text" class="form-control" required name="harga" value="<?php echo $row['harga'] ?>" autocomplete="off" oninvalid="this.setCustomValidity('Wajib Masukan Harga')">
						    </div>
						    <div class="form-group col-md-6">
						      <label style="color: white;">Status</label>
							    <select class="form-control" name="status">
							      <option value="Ready" <?php if ($row['status']=='Ready') {echo "selected";} ?>>Ready</option>
							      <option value="Not Ready" <?php if ($row['status']=='Not Ready') {echo "selected";} ?>>Not Ready</option>
							    </select>
						    </div>
						</div>
					  	<button type="submit" name="masuk" class="btn btn-success" style="width: 100%; margin-bottom: 20px;">Edit Minuman</button>
					  	<?php 
							if (isset($_POST['masuk'])) {
								$edit = mysqli_query ($conn, "UPDATE db_minuman SET  
								minuman= '".$_POST['minuman']."',
								harga= '".$_POST['harga']."',
								status= '".$_POST['status']."'
								WHERE id= '".$id."'LIMIT 1"); 
								if($edit)
								{  
									echo '<script language="javascript">';
									echo '$(document).ready(function () {';
									echo '$(\'#myAlert\').show(\'fade\');';
									echo '})';
									echo '</script>';        
								}

								else
								{ 
									echo '<script language="javascript">';
									echo '$(document).ready(function () {';
									echo '$(\'#myAlert2\').show(\'fade\');';
									echo '})';
									echo '</script>';
								} 
							}
						?>
					</form>
		    </div>
		</div>	
</body>
</html>