<?php 
session_start();

if(!isset($_SESSION["login"]) ){
	echo "<script>
	document.location.href='login.php';
	</script>";
	exit;
}

require 'functions.php';
$pelajar = query("SELECT * FROM pelajar");

// jika tombol cari di klik
if(isset($_POST["cari"])){
	$pelajar = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
		.loader{
			width:50px;
			position:absolute;
			top:110px;
			z-index: -1;
			margin-left:10px;
			display:none;
				}
	</style>
</head>
<body style="diplay:flex;justify-content:center;align-items:center;">

<h1>Daftar Mahasiswa</h1>
<a href="tambah.php">Tambah data</a> 
<a href="logout.php">logout</a>
<br><br>
<form action="" method="post">
	<input type="text" name='keyword' size="25" autofocus placeholder="masukan keyword pencarian" autocomplete="off" id="keyword"/>
	<button type="submit" name="cari" id="tombol-cari">cari!!</button>

	<img src="img/Loading.gif" class="loader"/>
</form>
<br><br>
<div class="container">
<table border="1" cellpadding="10" cellspacing="0">

	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Nama</th>
		<th>jurusan</th>
		<th>kelas</th>
		<th>Gambar</th>
	</tr>

	<?php $i = 1; ?>
	<?php foreach( $pelajar as $pjr ) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubah.php?id=<?= $pjr["id"]?>">ubah</a> |
			<a href="hapus.php?id=<?= $pjr["id"]?>" onclick="return confirm('yakin?');">hapus</a>
		</td>
		<td><?= $pjr["nama"]?></td>
		<td><?= $pjr["jurusan"]?> </td>
		<td><?= $pjr["kelas"]?></td>
		<td><img src="img/<?= $pjr["gambar"];?>" alt=<?= $pjr["gambar"];?> width="70" height="40"/></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
	
</table>
</div>
<script src="js/jquery-3.7.0.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>