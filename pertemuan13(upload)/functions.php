<?php 
//koneksi ke database
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query){
    //ambil variabel conn dari luar function tapi kalo di js pake keyword this untuk akses variabel global
    global $conn;
    //ambil data (fetch) ada dua paramete
    $result =mysqli_query($conn,$query);
    //siapkan array kosong untuk menammpung nilai nya
    $rows=[];
    //looping array
    while( $row = mysqli_fetch_assoc($result) ) {
        //kemudian tampung nilai nya ke array rows
		$rows[] = $row;
	}
    //kembalikan nilai yang sudah di pindahkan dari data ke array
	return $rows;
}

function tambah($data){
     //ambil variabel conn dari luar function
    global $conn;
    // ambil data dari tiap element dalam form
	$nama = htmlspecialchars($data["nama"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$kelas = htmlspecialchars($data["kelas"]);

    // upload gambar
    $gambar =  upload();
    if(!$gambar){
        return false;
    }

    // query insert data 
	$query ="INSERT INTO pelajar (`id`, `nama`, `jurusan`, `kelas`,`gambar`) 
    VALUES (NULL, '$nama', '$jurusan', '$kelas' ,'$gambar')";

    //lalu query
    mysqli_query($conn,$query);

    //mengembalikan data berupa angka dari response si $conn
    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    //cek apakah tidak ada gambar yang di upload
    if($error === 4){
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    //pilih ekstensi yang hanya di perbolehkan
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    //pisahkan nama gambar dan ekstensi nya menggunakan fungsi explode dari php
    $ekstensiGambar = explode(".",$namaFile);
    //ambil element array terakhir dari string gambar ex=['sandika','jpg'] maka yang diambil 
    //yang paling akhir karena tujuannya mengambil ekstensi nya dan ubah ekstensi nya ke huruf kecil semua;
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    //cek apakah yang diupload adalah gambar
    //mencari jarum di dalam jerami ceritanya (ekstensiGambar,ekstensiGambarValid) parameter pertama jarumnya ,kedua jeraminya
    if(!in_array($ekstensiGambar,$ekstensiGambarValid) ){
        echo "<script>
        alert('yang anda upload bukan gambar');
        </script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000){
        echo "<script>
        alert('maaf yang anda upload ukurannya terlalu besar : max = 1mb')
        </script>";
        return false;
    }

    //generate nama gambar baru
        // uniq id munculin seperti ini ="6484881009fa0" 
    $namaFileBaru = uniqid();
    //uniq id nya di rangkai/disambungin dengan titik "." jadi =6484881009fa0.;
    $namaFileBaru .= ".";
    //di sambungin/di rangkai lagi dengan ekstensi gambar nya jadi =6484881009fa0.png/jpg.jpeg;
    $namaFileBaru .= $ekstensiGambar; 
    var_dump($namaFileBaru);

    //jika lolos pengecekan ,gambar siap di upload
    move_uploaded_file($tmpName ,'img/' . $namaFileBaru );

    return $namaFileBaru;
}

function hapus($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM pelajar WHERE `pelajar`.`id` = $id");

    return mysqli_affected_rows($conn);
}


function ubah($edit){
   //ambil variabel conn dari luar function
   global $conn;
   // ambil data dari tiap element dalam form
   $id = $edit["id"];
   $nama = htmlspecialchars($edit["nama"]);
   $jurusan = htmlspecialchars($edit["jurusan"]);
   $kelas = htmlspecialchars($edit["kelas"]);
   $gambarLama = htmlspecialchars($edit["gambarLama"]);

   //cek apakah user pilih gambar baru atau tidak
   if($_FILES["gambar"]["error"] === 4){
    $gambar = $gambarLama;
   }else{
       $gambar = upload();
   }

   // query insert data 
   $query ="UPDATE pelajar SET 
                     nama = '$nama',
                     jurusan = '$jurusan',  
                     kelas = '$kelas',
                     gambar = '$gambar' 
                     WHERE id = $id ";
  
   //lalu query
   mysqli_query($conn,$query);

   //mengembalikan data berupa angka dari response si $conn
   return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM pelajar 
            WHERE 
    nama LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' OR
    kelas LIKE '%$keyword%' OR
    gambar LIKE '%$keyword%'
    ";
    return query($query);
}

?>