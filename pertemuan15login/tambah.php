<?php 

require 'functions.php';


//cek apakah tombol submit sudah pernah ditekan atau belum
if(isset($_POST["submit"])){
//    var_dump($_FILES);die;
	// cek apakah data berhasil ditambahkan atau tidak.
	if( tambah($_POST)){
		echo "Data Berhasil Di tambahkan
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
    <title>tambah</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nama">nama : </label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="jurusan">jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" required>
			</li>
			<li>
				<label for="kelas">kelas :</label>
				<input type="text" name="kelas" id="kelas" required>
			</li>
			<li>
				<label for="gambar">gambar :</label>
				<input type="file" name="gambar" id="gambar" >
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data!</button>
			</li>
		</ul>

	</form>
</body>
</html>