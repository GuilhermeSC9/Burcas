<?php 
session_start();
include("source/php/db.php");
mysqli_select_db($con,'menu');

if (isset($_GET['clicked']) && $_GET['clicked'] == 1) {
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if (mysqli_query($con, "CREATE DATABASE IF NOT EXISTS $user")) {
            mysqli_select_db($con,$user);
            if (mysqli_query($con, "CREATE TABLE IF NOT EXISTS `cart` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `product` VARCHAR(255) NOT NULL,
                `price` DOUBLE,
                `qty` INT NOT NULL,
                `image` VARCHAR(255),
                `total` DOUBLE
            )")) {
                try {
                    mysqli_select_db($con, 'menu');
            
                    // Verifica se o ID está definido na URL
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        
                        // Recupera informações do produto com o ID fornecido
                        $sql = mysqli_query($con, "SELECT * FROM products WHERE id = $id");
                        $result = mysqli_fetch_assoc($sql);
                        
                        if ($result) {
                            $product_name = $result['product'];
                            $product_price = $result['price'];
                            $product_image = $result['image'];
            
                            mysqli_select_db($con, $user);
                            
                            // Verifica se o produto já está no carrinho
                            $sql = mysqli_query($con, "SELECT * FROM cart WHERE id = $id");
                            $sql_result = mysqli_fetch_assoc($sql);
            
                            if ($sql_result) {
                                // Produto já está no carrinho, incrementa a quantidade
                                $qty_add = $sql_result['qty'] + 1;
                                $total = $qty_add * $product_price;
                                mysqli_query($con, "UPDATE cart SET qty = $qty_add,total = $total WHERE id = $id");
                                
                            } else {
                                // Produto ainda não está no carrinho, insere
                                mysqli_query($con, "INSERT INTO cart (qty, product, price, image,total) VALUES (1, '$product_name', $product_price, '$product_image',$product_price)");
                            }
            
                            mysqli_select_db($con, 'menu');
                            header("Location: menu.php?success=1");
                            exit();
                        } else {
                            // Produto não encontrado, redireciona para menu.php com erro
                            header("Location: menu.php?error=1");
                            exit();
                        }
                    }
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    echo $msg; // Mostra uma mensagem de erro em caso de exceção
                }
            }
            
        }
    }
}

    


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
    <div class="alert">
        <h2><?php 
        if(isset($_GET['success'])){
            echo "ADICIONADO COM SUCCESSO AO CARRINHO !";
}?></h2>
    </div>
    <section class="Lanches">
        <h1>LANCHES</h1>
        <?php
        $fetchedProducts = fetchProducts('lanches'); // Fetch the products using the function
    
        foreach ($fetchedProducts as $product) {
            echo '<div class="product">';
            echo '<img src="' . $product['image'] . '" height="120px" width="120px" alt="lanche">';
            echo '<div class="LanchesText">';
            echo '<h3>' . $product['product'] . ' - <span class="price">' ."R$". $product['price'] . '</span></h3>'; // Display product name and price together
            echo '<p>' . $product['description'] . '</p>'; // Display product description
            echo '</div>';
            echo '<div class="order">';
            echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
            echo '<a href="menu.php?id=' . $product['id'] . '&clicked=1"><img src="source/img/cart 30x30.png" width="40px" alt="shopping-cart"></a>';
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
            echo '<div class="LanchesText">';
            echo '<h3>' . $product['product'] . ' - <span class="price">' ."R$". $product['price'] . '</span></h3>'; // Display product name and price together
            echo '<p>' . $product['description'] . '</p>'; // Display product description
            echo '</div>';
            echo '<div class="order">';
            echo '<input type="hidden" name="id" value="' . $product['id'] . '">';
            echo '<a href="menu.php?id=' . $product['id'] . '&clicked=1"><img src="source/img/cart 30x30.png" width="40px" alt="shopping-cart"></a>';
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