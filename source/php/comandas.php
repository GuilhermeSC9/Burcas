<?php
session_start();
global $con;

include("db.php");
mysqli_select_db($con, "menu");


function fetchtablexists($number) {
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM tables WHERE number = $number");
    $result = mysqli_fetch_assoc($sql);
    return empty($result);
}

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/source/js/table_page.js"></script>
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
    </header>
    <section class="search-section">
        <div><input type="text" name="search" id="search"></div>
        <img src="/source/img/search.png" width="30px" heigth="15px">
    </section>
    <section class="tables-section">
        <div class="tables" id="table">
            <div class="no-results" id="no-results" style="display:none">NADA FOI ENCONTRADO !!</div>
            <?php
            $table_number = 0; // Inicia do zero
            while ($table_number < 25) {
                $table_number++;
                
                // Verifica se a tabela existe e determina a cor da tabela
                $table_exists = fetchtablexists($table_number);
                $table_color = $table_exists ? "red" : "green";

                // Obtém o nome da tabela
                $nome_tabela = fetchtablename($table_number);

                // Exibe a tabela
                echo "<a class='table-link' data-tablenumber='$table_number' data-tablename='$nome_tabela' onclick='adicionarurl(this)'>";
                echo "<div class='table' style='background-color: $table_color;'>";
                echo "<h1>$table_number</h1>";
                echo "<input type='hidden' class='table-link' data-tablename='$nome_tabela'>";
                echo "<h2>" . ($nome_tabela == null || empty($nome_tabela) ? "SEM NOME" : $nome_tabela) . "</h2>";
                if($nome_tabela == null){
                    echo "NADA";
                }
                else{
                    echo $nome_tabela;
                }
                echo "</div>";
                echo "</a>";
            }
            ?>
        </div>
    </section>
</body>
</html>
