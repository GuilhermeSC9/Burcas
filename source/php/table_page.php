<?php
include("db.php");
session_start();

if($_SESSION['logged']!= true){
    echo "NAO LOGADO";
}
else {
    $table = $_GET['table_number'];
    $query = "CREATE DATABASE IF NOT EXISTS `menu$table`";
    if (mysqli_query($con, $query)) {
        if (isset($_GET['table_name']) && !empty($_GET['table_name'])) {
            echo "GOSTARIA DE CRIAR A COMANDA ?";
            echo "<div class='section'>";
            echo "<div class='inputs'>";
            echo "<input type='text' id='tablename' placeholder='NOME DA MESA'>";
            echo "<button onclick='createtable()'>CRIAR</button>";
            echo "<input type='hidden' id='tablenumber' value='$table'>";
            echo "</div>";
            echo "</div>";
        } else {
            mysqli_select_db($con, "menu$table");
        }
    }
    
    else {
        echo "Error creating or selecting database: " . mysqli_error($con);
    }
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/source/js/table_page.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
</body>
</html>