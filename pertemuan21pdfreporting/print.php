<?php 

  // Require composer autoload
require_once __DIR__ .'/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

require 'functions.php';
$pelajar = query("SELECT * FROM pelajar");
// Write some HTML code:
$html ='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>daftar pelajar</title>
</head>
<body>
<h1>daftar pelajar</h1>
<table border="1" cellpadding="10" cellspacing="0" width="80">
<tr>
    <th>No.</th>
    <th>Nama</th>
    <th>jurusan</th>
    <th>kelas</th>
    <th>Gambar</th>
</tr>';
$i=1;
foreach($pelajar as $pjr){
    $html .= '<tr>
    <td>'. $i++ .'</td>
    <td>'. $pjr["nama"].'</td>
    <td>'. $pjr["jurusan"].'</td>
    <td>'. $pjr["kelas"].'</td>
    <td> <img src="img/'. $pjr["gambar"] .'  " width="120" height="120"/></td>
    </tr>';
}

$html .= '</table>
</html>
';
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
// $mpdf->Output('data-pelajar.pdf',\Mpdf\Output\Destination::INLINE);
//LANGSUNG DONWLOAD TANP PREVIEW
$mpdf->Output('data-pelajar.pdf',\Mpdf\Output\Destination::DOWNLOAD);
?>
