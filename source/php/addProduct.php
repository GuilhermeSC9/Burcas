<?php
session_start();
include("db.php");
global $con;
$table_number = $_GET['tableNumber'];

$tableDB = "Table_" . $table_number;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/source/js/openTable.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/addProduct.css">
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
        <div class="addDiv">
            <?php
            echo "<input type='hidden' name='dbName' id='tableNumber' value='$table_number'>";
            ?>
        </div>
        <div class="tables" id="table">
            <div class="no-results" id="no-results" style="display:none">NADA FOI ENCONTRADO !!</div>
            <?php
                mysqli_select_db($con,'menu');
                $sql = mysqli_query($con,"SELECT * FROM products");
                if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_assoc($sql)){
                    $product_name = $row['product'];
                    $product_price = $row['price'];
                    $product_image = $row['image'];
                    echo "<img src='$product_image' width=100px height=100px>";
                    echo "<h1> $product_name </h1>";
                    echo "<h2> $product_price </h2>";
                    echo "<select class='qty' name='quantidade' id='qty'>";
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    }
                }
            ?>
        </div>
    </section>
    <header>
    </header>
</body>
</html>
