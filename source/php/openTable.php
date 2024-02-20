<?php
session_start();
include("db.php");
global $con;
$table_number = $_GET['tableNumber'];

$tableDB = "Table_" . $table_number;

mysqli_query($con,"CREATE DATABASE IF NOT EXISTS $tableDB");
if(mysqli_errno($con)){
    echo ('SEM CONEXAO');
}
else{
    mysqli_select_db($con,$tableDB);
    mysqli_query($con,"CREATE TABLE IF NOT EXISTS products (product VARCHAR(255) NOT NULL,qty INT NOT NULL DEFAULT 1,price DOUBLE NOT NULL,image VARCHAR(255) NOT NULL,total DOUBLE,id INT AUTO_INCREMENT PRIMARY KEY)");
    if(mysqli_errno($con)){
        echo("IMPOSSIVEL CRIAR TABELA");
    }
    else{  
    }
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
        <img src="/source/img/search.png" width="30px" height="15px">
    </section>
    <section class="tables-section">
        <div class="tables" id="table">
            <div class="no-results" id="no-results" style="display:none">NADA FOI ENCONTRADO !!</div>
            <table cellspacing="10">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    mysqli_select_db($con,$tableDB);
                    $sql_products = mysqli_query($con,"SELECT * FROM products");
                    if(mysqli_num_rows($sql_products) > 0) {
                        while($item = mysqli_fetch_assoc($sql_products)) {
                            echo "<tr>";
                            echo "<td>" . $item['product'] . "</td>";
                            echo "<td style='text-align: center;'>" . $item['qty'] . "</td>";
                            echo "<td> R$" . $item['price'] . "</td>";
                            echo "<td> R$" . ($item['qty'] * $item['price']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Nenhum item encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php 
                        $sql = mysqli_query($con,"SELECT SUM(price * qty) as total FROM products");
                        $products_total = mysqli_fetch_assoc($sql);
                        $total = $products_total['total'];
                        ?>
                        <td colspan="3" style="text-align: right;"><strong>Total: R$</strong></td>
                        <td style="text-align: center;"><strong><?php if($total){echo number_format($total, 2, ',', '.');} ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="addDiv">
            <?php
            echo "<input type='hidden' name='dbName' id='tableNumber' value='$table_number'>";
            echo "<input type='hidden' name='dbName' id='dbName' value='$tableDB'>";
            ?>
            <button class="add" onclick="window.location.href = 'addProduct.php?tableNumber=<?php echo $table_number;?>'"> + </button>
        </div>
        <div class="overlay" id="overlay"></div>
        <div class="popup" id="popup">
        <h2>Fechamento da comanda <?php echo $table_number; ?></h2>

        <button onclick="closePopup()">Fechar</button>
        </div>
    </section>
    <header>
        <button onclick="openPopup()">  FECHAR COMANDA </button>
    </header>
</body>
</html>
