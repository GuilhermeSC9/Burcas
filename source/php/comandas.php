<?php
session_start();
$logged = $_SESSION['logged'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/comandas.css">
    <title>comandas</title>
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
            <li><a class="cart" href="/cart.php"><img src="/source/img/cart30x30.png"></a>
            </div>
        </div>
    </header>
    <section class="search-section">
        <div><input type="text" name="search" id="search"></div>
        <img src="/source/img/search.png" width="30px" heigth="15px">
    </section>
    <section class="tables-section">
        <div class="tables">
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
            <div class="table">
            
            </div>
        </div>
    </section>
</body>
</html>