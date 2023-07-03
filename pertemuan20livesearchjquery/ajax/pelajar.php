<?php 
require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM pelajar 
            WHERE 
        nama LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' OR
        kelas LIKE '%$keyword%' OR
        gambar LIKE '%$keyword%'
";
$pelajar = query($query);

?>

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