<?php


include('source/php/db.php');


if(isset($_POST['submit'])){
    $produto = $_POST['PRODUTO'];
    $valor = $_POST['VALOR'];
    $desc = $_POST['DESCRICAO'];
    $category = $_POST['category'];

    mysqli_select_db($con,'menu');
    if(mysqli_query($con,"INSERT INTO products(product,price,category,description) VALUES ('$produto',$valor,'$category','$desc')")){
        echo "PRONTO";
    }

}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" placeholder="PRODUTO" name="PRODUTO">
        <input type="number" placeholder="VALOR" name="VALOR">
        <input type="text" placeholder="DESCRIUCAO" name="DESCRICAO">
        <select name="category" id="category">
            <option value="lanches">LANCHES</option>
            <option value="porcoes">PORÇÕES</option>
        </select>
        <button type="submit" name="submit"> ENVIAR</button>
        <a href="menu.php">VOLTAR</a>
    </form>
</body>
</html>