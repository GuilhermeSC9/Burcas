<?php 
session_start();
include_once("db.php");

$pass = $_POST['password'];
$user = $_SESSION['user'];
$email = $_post['email'];



//cript password

$secure_pass = password_hash($pass,PASSWORD_BCRYPT);




/// inserindo no banco de dados

$query = mysqli_query($con,"INSERT INTO users (username,password,email) VALUES('$user','$secure_pass','$email')");


?>

