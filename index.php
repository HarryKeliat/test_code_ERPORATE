<!DOCTYPE html>
<html>
<head>
	<title>Restoran A</title>
	<link rel="stylesheet" type="text/css" href="Style/Utama/HAF.css">
	<link rel="stylesheet" type="text/css" href="Style/login.css">
	<link rel='stylesheet' href="Style/Utama/opensans.css">
	<link rel="stylesheet" href="Style/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="Style/Bootstrap/bootstrap.min.css">
	<script src="JS/jquery-3.3.1.slim.min.js"></script>
	<script src="JS/popper.min.js" ></script>
	<script src="JS/bootstrap.min.js" ></script>
	<script src='JS/jquery-3.3.1.min.js'></script>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
		<!-- Content -->
		<div class="col-lg-12">
		    <div class="col-sm-9 col-md-7 col-lg-3 mx-auto" id="utama">
		    	<h3 id="judul">Login Kasir/Pelayan</h3>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label style="color: white;">Username</label>
						<input type="text" name="username" class="form-control" required autocomplete="off"/>
					</div>
					<div class="form-group">
						<label style="color: white;">Password</label>
						<input type="password" name="pass" class="form-control" required autocomplete="off"/>
					</div>  
					<button type="submit" name="masuk" class="btn btn-success" style="width: 100%; margin-bottom: 30px;">Login</button>
							<?php
				                  include "koneksi.php";
				                  if (isset($_POST['masuk'])) {
				                    $cek = mysqli_query($conn, "SELECT * FROM db_profil WHERE  username = '".$_POST['username']."' AND password = '".$_POST['pass']."' ");
				                    $hasil = mysqli_fetch_array($cek);
				                    $count = mysqli_num_rows($cek);
				                    $level = $hasil['level'];
				                    $nama = $hasil['nama'];
				                    $admin = $hasil['level'];
				                    $kasir = $hasil['level'];
				                	$pelayan = $hasil['level'];
				                    if ($count > 0)
				                    {
				                    	session_start();
				                    	$_SESSION['nama'] = $nama;
				                        if ($level == 'kasir') 
					                	{
						                    $_SESSION ['level'] = $kasir;
						                    header("Location: kasir/transaksi.php");
					                	}
				                		elseif ($level == 'pelayan') 
					                	{
						                    $_SESSION ['level'] = $pelayan;
						                    header("Location: pelayan/transaksi.php");
					                	}
					                elseif ($level == 'admin') 
					                	{
						                    $_SESSION ['level'] = $pelayan;
						                    header("Location: admin/makanan.php");
					                	}
				                    }
				                    else
				                    {
				                      echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Username atau Password yang anda masukan salah!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>"; 
				                    }
				                  }
				            ?>
					</form>
			</div>
		</div>
</body>
</html>