<?php 

require 'functions.php';
// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id nya;
$pjr = query("SELECT * FROM pelajar WHERE id = $id")[0];
var_dump($pjr);


//cek apakah tombol submit sudah pernah ditekan atau belum
if(isset($_POST["submit"])){
	// cek apakah data berhasil diubah atau tidak.
	if( ubah($_POST) > 0 ){
		echo "Data Berhasil Di ubah
		<script>
		alert('berhasil');
		document.location.href='index.php';
		</script>";
	}else{
		echo"gagal a";
	}
}

?>

<!-- <!DOCTYPE html> -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit data pelajar</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
		<ul>
            <input type="hidden" name='id' value=<?= $id?>>
			<input type="hidden" name='gambarLama' value=<?= $pjr["gambar"]?>>
			<li>
				<label for="nama">nama : </label>
				<input type="text" name="nama" id="nama" required value=<?= $pjr["nama"];?>>
			</li>
			<li>
				<label for="jurusan">jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" required value=<?= $pjr["jurusan"];?>>
			</li>
			<li>
				<label for="kelas">kelas :</label>
				<input type="text" name="kelas" id="kelas" required value=<?= $pjr["kelas"];?>>
			</li>
			<li>
				<label for="gambar" >gambar :</label>
				<img src="img/<?= $pjr["gambar"];?>" alt="<?= $pjr["gambar"];?>" height="200px" width="200px">
				<input type="file" name="gambar" id="gambar"  />
			</li>
			<li>
				<button type="submit" name="submit">edit Data!</button>
			</li>
		</ul>

	</form>
</body>
</html>