<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'].'/gp-printing';
include($path.'/controller/config/linken.php');
include($path.'/controller/login/loginsession.php');
include($path.'/controller/config/asset.php');
?>
<!DOCTYPE html>
<html>

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
            <li><a href="view/obat.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Obat</a></li>
			<li><a href="view/sample.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Sample</a></li>
			<li><a href="view/pengerjaan.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Pengerjaan</a></li>
            <li><a href="view/revisi.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Perbaikan</a></li>
            <li><a href="view/gudang.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Gudang</a></li>
<!--         <li><a href="view/detailTransaksi.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Detail Transaksi</a></li>-->
            <!-- <li><a href="vendors.php"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Data Vendor</a></li>
			<li><a href="penjualan.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Penjualan Sparepart</a></li>
			<li><a href="service.php"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Service</a>
            <li><a href="goodsReceipt.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Penerimaan Barang</a></li>
            <li><a href="detailTransaksi.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Detail Transaksi</a></li>
            <li><a href="pemasukan.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Pemasukan</a></li>
            <li><a href="pengeluaran.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Pengeluaran</a></li>
            <li><a href="addPemasukan.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Tambah Pemasukan Baru</a></li>
            <li><a href="laporanLabaRugi.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Laporan Laba Rugi</a></li>
            <li><a href="piutang.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Piutang</a></li>
            <li><a href="keuangan.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Keuangan</a></li>
            <li><a href="transfer.php"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Transfer Saldo</a></li> -->
            <li><a style="color:red;" href="controller/login/logout.php"><span class="glyphicon glyphicon-remove"></span >  Logout</a></li>
			<!-- <li><a href="transaksiHarian.php"><span class="glyphicon glyphicon-shopping-cart"></span>  Transaksi berdasarkan Tanggal</a> </li> -->

			<!-- <li><a href="pembayaran.php"><span class="glyphicon glyphicon-usd"></span>  Pembayaran</a></li> -->

			<!-- <li><a href="ganti_foto.php"><span class="glyphicon glyphicon-picture"></span>  Ganti Foto</a></li> -->

<!-- 			<li><a href="utilitas.php"><span class="glyphicon glyphicon-briefcase"></span>  Utilitas</a>
			</li>
			<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>

			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li> -->
		</ul>
	</div>
	<div class="col-md-10">
</body>
</html>
