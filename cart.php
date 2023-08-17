<?php

include("source/php/db.php");
session_start();

if($_SESSION['logged']){
    $user = $_SESSION['user'];
    mysqli_select_db($con,$user);
    $sql = mysqli_query($con,"SELECT * FROM cart");
    $result = mysqli_fetch_assoc($sql);
}

if(isset($_POST['logoff'])){
    header("location: menu.php");
    $_SESSION['logged'] = false;
    session_destroy();
    exit();
};
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/cart.css">
    <link rel="icon" type="image/x-icon" href="source/img/burcas-fivecon.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body>
<header>
        <a href="main.html" class="logo">
            <img src="source/img/BurcasLogo.png" width="50px" height="50px" alt="Burca's">
            <span>Burca's</span>
        </a>
        <ul class="navbar">
            <li><a href="#">Serviços</a></li>
            <li><a href="#">Contato</a></li>
            <li><a class="menu" href="menu.php">Cardápio</a></li>
        </ul>
        <div class="main">
            <li><a class="cart" href="cart.php"><img src="source/img/cart 30x30.png"></a>
            <?php
            if(isset($_SESSION['logged'])) {
                echo '<li>' . strtoupper($_SESSION['user']) . '</li>';
                echo "<form method='POST'>";
                echo '<li><button class="logoff" type="submit" name="logoff" id="logoff">LOGOFF</button></li>';
                echo '<li><a href="addlanche.php"> Adicionar lanche </a></li>';
            } 
            else{
            echo '<li><a href="source/php/register.php" class="user"><i class="ri-user-2-fill"></i>Sign in</a></li>';
            echo '<li><a href="source/php/login.php">Login</a></li>';
            echo '<div class="bx bx-menu" id="menu-icon">';

            }
            
            ?>
            </div>
        </div>
    </header>
    <div class="container">
        <section class="products">
            <?php
        if($_SESSION['logged']){
            $user = $_SESSION['user'];
            mysqli_select_db($con,$user);
            $total_query = mysqli_query($con,"SELECT SUM(total) as total FROM cart");
            $total_result = mysqli_fetch_assoc($total_query);
            $sql = mysqli_query($con,"SELECT * FROM cart");
            while ($product = mysqli_fetch_assoc($sql)) {
                echo '<div class="product">';
                echo '<img src="' . $product['image'] . '" height="120px" width="120px" alt="lanche">';
                echo '<div class="LanchesText">';
                echo '<h3>' . $product['product'] . ' - <span class="price">' ."R$". $product['price'] . '</span></h3>'; // Display product name and price together
                echo '</div>';
                echo '<h3>' . 'QUANTIDADE : ' . $product['qty'] . '<h3>';
                echo '<div class="order">';
                echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
                echo '<h1>'. 'TOTAL : ' . $product['total'] . '</h1>';
                echo '</div>';
                echo '</div>';

            }
            echo '<h3>' . $total_result['total'] . '</h3>';
        }
        else{
            echo "<li class='msgerror'>Seu Carrinho de compras esta vazio ou voce nao esta logado</li>";
        }
        ?>
        </section>
    </div>

    </section>
    </div>
    <div class="container-contact">
        <header class="About-us">
            <div class="navbar-contact">
                <li><a href="" class="whats">Whatsapp</a></li>
                <li><a href="https://www.instagram.com/beerburcas/" class="insta">Instagram</a></li>
            </div>

        </header>
    </div>
</body>
<script src="source/js/cart.js"></script>

</html>