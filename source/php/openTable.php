<?php
session_start();
include("db.php");
global $con;
$table_number = $_GET['tableNumber'];

$tableDB = "Table " . $tableNumber;
mysqli_query($con,"CREATE DATABASE IF NOT EXISTS $tableDB");
if(mysqli_errno($con)){
    
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/source/js/openTable.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/openTable.css">
    <title>MESA <?php echo $table_number; ?></title>
</head>
<body>
    <header>
        <a href="main.html" class="logo">
            <img src="/source/img/BurcasLogo.png" width="50px" height="50px" alt="Burca's">
            <span>Burca's</span>
        </a>
        <ul class="navbar">
            <?php 
            if($logged){
                echo "<li><a href='/source/php/comandas.php'>COMANDAS</a></li>";
            }
            ?>
            <li><a href="#">Serviços</a></li>
            <li><a href="#">Contato</a></li>
            <li><a class="menu" href="menu.php">Cardápio</a></li>
        </ul>
        <div class="main">
            <ul>
                <li><a class="cart" href="/cart.php"><img src="/source/img/cart30x30.png"></a></li>
            </ul>
        </div>
    </header>
    <section class="search-section">
        <div><input type="text" name="search" id="search"></div>
        <img src="/source/img/search.png" width="30px" heigth="15px">
    </section>
    <section class="tables-section">
        <div class="tables" id="table">
            <div class="no-results" id="no-results" style="display:none">NADA FOI ENCONTRADO !!</div>
            <?php
                echo "<button onclick='addProduct()' + </button>"
            ?>
        </div>
    </section>
</body>
</html>
