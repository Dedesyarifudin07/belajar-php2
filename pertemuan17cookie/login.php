<?php 
session_start();
require 'functions.php';

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   //ambil username berdasarkan idnya
   $result = mysqli_query($conn,"SELECT username from user WHERE id = $id");
   $row = mysqli_fetch_assoc($result);

   //cek cookie dan username
   if($key === hash('sha384',$row["username"]) ){
    $_SESSION["login"] = true;
   }
}

///cek session
if(isset($_SESSION["login"]) ){
	echo "<script>
	document.location.href='index.php';
	</script>";
	exit;
}

if( isset($_POST["login"]) ){

    //tangkap inputan yang diketik oleh user
    $username = $_POST["username"];
    $password =$_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username' ");

    //cek username atau cek apakah ada baris yang dikembalikan dari baris query  $result
    if(mysqli_num_rows($result) === 1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        //password verify
      if(password_verify($password , $row["password"]) ){
       //set session
       $_SESSION["login"] = true;

       //cek remember me
       if(isset($_POST['remember'])){
         setcookie('id',$row["id"],time() + 60 );
         setcookie('key',hash('sha384',$row["username"]),time() + 60 );
       }

        // header('location : index.php');
        // exit;
        echo "<script>
        document.location.href='index.php';
        </script>";
        exit;
      }

    }

    $error ="true";
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman login</title>
    <style>
        form{
            display:block;
        }
    </style>
</head>
<body>
    <h1>halaman login</h1>
    <?php  if(isset($error)) :?>
        <p style="color:red; font-style:italic;"> username atau password salah</p>
    <?php  endif ;?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username :</label>
                <input type="text" name="username" id="username"/>
            </li>
            <li>
                <label for="password">password :</label>
                <input type="password" name="password" id="password"/>
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember"/>
                <label for="remember">Remember me</label>
            </li>
            <li>
               <button type="submit" name="login">Login!</button>
            </li>
        </ul>
    </form>
</body>
</html>