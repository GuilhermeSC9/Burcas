<?php 
session_start();
include("source/php/db.php");


function fetchProducts($category){
    include("source/php/db.php");
    mysqli_select_db($con,'menu');
    try {
        $sql = mysqli_query($con, "SELECT * FROM products WHERE category = '$category' ");
        $products = array(); // Initialize an array to store fetched products
        
        while ($row = mysqli_fetch_assoc($sql)) {
            $products[] = $row; // Add each product to the array
        }
        
        return $products; // Return the array of products
    }
    catch (Exception $e){
        $msg = $e->getMessage();
        mysqli_query($con,"CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT NOT NULL,
            product VARCHAR(255) NOT NULL,
            category VARCHAR(255) NOT NULL,
            description VARCHAR(255),
            price DOUBLE,
            image VARCHAR(255),
            PRIMARY KEY (id))");
    }
}

if(isset($_POST['logoff'])){
    header("location: menu.php");
    $_SESSION['logged'] = false;
    session_destroy();
    exit();
};


try{
    if(mysqli_select_db($con,"menu")){
        $sql = mysqli_query($con,"SELECT * FROM products");
        $result = mysqli_fetch_assoc($sql);
    };
}
catch (Exception $e){
    $msg = $e->getMessage();
    if($msg == "Unknown database 'menu'"){
        $run = mysqli_query($con,"CREATE DATABASE IF NOT EXISTS `menu`");
        if($run){
            mysqli_select_db($con,'menu');
        }
    }
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/menu.css">
    <link rel="icon" type="image/x-icon" href="source/img/burcas-fivecon.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
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
    <section class="Lanches">
        <h1>LANCHES</h1>
        <?php
        $fetchedProducts = fetchProducts('lanches'); // Fetch the products using the function
    
        foreach ($fetchedProducts as $product) {
            echo '<div class="product">';
            echo '<img src="' . $product['image'] . '" height="120px" width="120px" alt="lanche">';
            echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
            echo '<div class="LanchesText">';
            echo '<h3>' . $product['product'] . ' - <span class="price">' ."R$". $product['price'] . '</span></h3>'; // Display product name and price together
            echo '<p>' . $product['description'] . '</p>'; // Display product description
            echo '</div>';
            echo '<div class="order">';
            echo '<a href="menu.php?id=' . $product['id'] . '"><img src="source/img/cart 30x30.png" width="40px" alt="shopping-cart"></a>';
            echo '</div>';
            echo '</div>';
        }
        
        ?>
    </section>

    <section class="Porcoes">
        <br>
        <h1>Porções</h1>
        <br>
        <?php
        $fetchedProducts = fetchProducts('Porcoes'); // Fetch the products using the function
    
        foreach ($fetchedProducts as $product) {
            echo '<div class="product">';
            echo '<img src="' . $product['image'] . '" height="120px" width="120px" alt="lanche">';
            echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
            echo '<div class="LanchesText">';
            echo '<h3>' . $product['product'] . ' - <span class="price">' ."R$". $product['price'] . '</span></h3>'; // Display product name and price together
            echo '<p>' . $product['description'] . '</p>'; // Display product description
            echo '</div>';
            echo '<div class="order">';
            echo '<a href="menu.php?id=' . $product['id'] . '"><img src="source/img/cart 30x30.png" width="40px" alt="shopping-cart"></a>';
            echo '</div>';
            echo '</div>';
        }
        
        ?>
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
<script src="source/js/menu.js"></script>
</html>