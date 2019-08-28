<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
	$username = $_POST['user'];
	$pass = $_POST['pass'];
if($username='kasir' && $pass == 'kasir123'){

			session_start();
			$_SESSION['login'] = 'login';
			echo "<script>alert('---------------------\\nLOGIN BERHASIL!\\n---------------------');
      location.replace('../../index.php');</script>";
		}
		else {
      echo "<script>alert('---------------------\\nLOGIN GAGAL!\\nUSERNAME/PASSWORD SALAH!\\n---------------------');
      location.replace('view/login/login.php');</script>";
		}

	?>
