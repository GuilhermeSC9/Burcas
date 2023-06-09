<?php
session_start();
include('/Users/lucas/Desktop/Projeto_Gui/Burcas/source/php/db.php');
$table_id = $_GET['id'];

if(isset($table_id)){
    mysqli_select_db($con,'mesas');
    $run = mysqli_query($con,"SELECT * FROM mesas WHERE id = $table_id");
    $result = mysqli_fetch_assoc($run);
    $name = $result['name'];
    $number = $result['number'];
    $db_name = $name . '_' . $number;
}







?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste header interativo</title>
    <script src="js/test.js"></script>
    <link rel="stylesheet" href="css/lucas.css">
</head>
<body>
    <header id="header">
        <h1>OLA MUNDO</h1>
    </header>
    <div class="container">
        <div class="products">
            <?php
            mysqli_select_db($con,$db_name);
            $run = mysqli_query($con,"SELECT * FROM $name"); 
            $result = mysqli_fetch_assoc($run);
            echo $result['product'] ?>
            
        </div>
    </div>
</body>
</html>
