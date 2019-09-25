<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'].'/gp-printing';
include($path.'/controller/config/linken.php');
include($path.'/controller/login/loginsession.php');
include($path.'/controller/config/asset.php');
?>
<!DOCTYPE html>
<html>
<title>GP PRINTING</title>
<body>
		<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">GP Printing</a>

			</div>
		</div>
	</div>
<div class="col-md-2">
		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Dashboard</a></li>
            <li><a href="view/obat.php"><span class="glyphicon glyphicon-filter"></span>&nbsp;&nbsp;Obat</a></li>
			<li><a href="view/sample.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Sample</a></li>
			<li><a href="view/pengerjaan.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Pengerjaan</a></li>
            <li><a href="view/revisi.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Perbaikan</a></li>
            <li><a href="view/gudang.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Gudang</a></li>
            <li><a href="view/posisi.php"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Posisi</a></li>
            <li><a style="color:red;" href="controller/login/logout.php"><span class="glyphicon glyphicon-remove"></span >  Logout</a></li>
		
		</ul>
	</div>
	<div class="col-md-10">
</body>
</html>
