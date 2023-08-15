<?php 
include("source/php/db.php");

if(mysqli_select_db($con,"menu")){
    $sql = mysqli_query($con,"SELECT * FROM menu");
}
else{
    echo "SEM BANCO DE DADOS";
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
            <li><a class="menu" href="menu.html">Cardápio</a></li>
        </ul>
        <div class="main">
            <li><a href="source/php/register.php" class="user"><i class="ri-user-2-fill"></i>Sign in</a></li>
            <li><a href="#">Login</a></li>
            <div class="bx bx-menu" id="menu-icon">
            </div>
        </div>
    </header>

<div class="container">
    <section class="Lanches">
        <div class="product">
            <img src="/source/img/lanche.png" height="120px" width="120px" alt="lanche">
            <div class="LanchesText">
                <h3>NOME DO LANCHE</h3>
                <span>DESCRICAO DO LANCHE DE ATE 32 PALAVRAS e ai eu quero saber como ele vai quebrar linha tbm para manter pq ate aqui le ta mantendo ali em cima</span>
            </div>
            <div class="order">
                <img src="source/img/cart 30x30.png"  width="40px" alt="shopping-cart">
            </div>
        </div>
        <div class="product">
            <img src="/source/img/lanche.png" height="120px" width="120px" alt="lanche">
            <div class="LanchesText">
                <h3>FONDUE BURGUER</h3>
                <span>DESCRICAO DO LANCHE DE ATE 32 PALAVRAS e ai eu quero saber como ele vai quebrar linha tbm para manter pq ate aqui le ta mantendo ali em cima</span>
            </div>
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
<script src="source/js/menu.js"></script>
</html>