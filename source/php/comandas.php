<?php
session_start();
$logged = $_SESSION['logged'];

include("db.php");
mysqli_select_db($con,"menu");

function fetchtablename($number) {

    global $con;

    // Use prepared statements para evitar SQL injection
    $query = "SELECT name FROM tables WHERE number = ?";
    $stmt = mysqli_prepare($con, $query);

    // Vincular o parâmetro
    mysqli_stmt_bind_param($stmt, 'i', $number);

    // Executar a consulta
    mysqli_stmt_execute($stmt);

    // Obter o resultado
    mysqli_stmt_bind_result($stmt, $nome);

    // Fetch o resultado
    mysqli_stmt_fetch($stmt);

    // Fechar a instrução preparada
    mysqli_stmt_close($stmt);

    return $nome; // Retorna o nome ou null se não encontrado
}


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
            <ul>
                <li><a class="cart" href="/cart.php"><img src="/source/img/cart30x30.png"></a></li>
            </ul>
        </div>

        </div>
    </header>
    <section class="search-section">
        <div><input type="text" name="search" id="search"></div>
        <img src="/source/img/search.png" width="30px" heigth="15px">
    </section>
    <section class="tables-section">
        <div class="tables" id="table">
            <?php
            $table_number = 0;
            while ($table_number < 25) {
                $table_number++;
                $nome_tabela = fetchtablename($table_number);
                echo "<a href='table_page.php?table_number=$table_number&?table_name=$nome_tabela'>";
                echo "<div class='table' style='background-color: " . (isEmptyTable($table_number) ? "red" : "green") . ";'>";
                echo "<h1>" . $table_number . "</h1>";
            
            
                // Verifica se o nome da tabela está vazio
                echo "<h2 id='name'>" . ($nome_tabela == null || empty($nome_tabela) ? "VAZIA" : $nome_tabela) . "</h2>";
            
                echo "</div>";
                echo "</a>";
            }
            
            function isEmptyTable($table_number) {
                $nome_tabela = fetchtablename($table_number);
                return $nome_tabela == null || empty($nome_tabela);
            }
            
            ?>
        </div>
    </section>
</body>

</html>