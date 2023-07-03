<?php 
session_start();

if(!isset($_SESSION["login"]) ){
	echo "<script>
	document.location.href='login.php';
	</script>";
	exit;
}

require 'functions.php';

//pagination
//konfigurasi
$jumlahDataPerhalaman = 4;
//hitung jumlah data yang ada di database
$jumlahData = count(query("SELECT * FROM pelajar "));
//tentukan jumlah halaman dengan membagi jumlah data yang ada dengan jumlah data perhalaman
$jumlahHalaman = ceil($jumlahData/$jumlahDataPerhalaman);
//mencari halaman aktif halaman brpa
$halamanAKtif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
//mencari awal data pada setaip halaman 
// misalkan halaman= 1 , berarti indeks 0-3
$awalData = ($jumlahDataPerhalaman * $halamanAKtif) - $jumlahDataPerhalaman;
var_dump($awalData); 


$pelajar = query("SELECT * FROM pelajar LIMIT $awalData,$jumlahDataPerhalaman");

// jika tombol cari di klik
if(isset($_POST["cari"])){
	$pelajar = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body style="diplay:flex;justify-content:center;align-items:center;">

<h1>Daftar Mahasiswa</h1>
<a href="tambah.php">Tambah data</a>
<a href="logout.php">logout</a>
<form action="" method="post">
	<input type="text" name='keyword' size="25" autofocus placeholder="masukan keyword pencarian" autocomplete="off"/>
	<button type="submit" name="cari">cari!!</button>
</form>
<br><br>

<?php if($halamanAKtif > 1):?>
	<a href="?halaman=<?= $halamanAKtif - 1 ;?>">&laquo;</a>
<?php endif;?>

<?php for($i = 1;$i < $jumlahDataPerhalaman ; $i++) :?>
	<?php if($i == $halamanAKtif):?>
		<a href="?halaman=<?= $i; ?>" style="font-weight:bold;color:red;"><?= $i; ?></a>
	<?php else :?>
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
	<?php endif;?>
<?php endfor ;?>	

<?php if($halamanAKtif < $jumlahHalaman):?>
	<a href="?halaman=<?= $halamanAKtif + 1 ;?>">&raquo;</a>
<?php endif;?>

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

<a href=""></a>
<a href=""></a>
<a href=""></a>

</body>
</html>