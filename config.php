<?php

// $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

$username = "root";
$password = "";
try {
$conn = new PDO("mysql:host=localhost;dbname=book_store", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
// echo 'HI';
// echo '<pre>';
// print_r($_POST);
//var_dump($_POST);

} 

catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}


?>