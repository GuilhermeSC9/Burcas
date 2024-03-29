<?php 
session_start();

if(isset($_SESSION['logged'])){
    $logado = true;
    $user = $_SESSION['user'];
}
else{
    $logado = false;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/style.css">
    <link rel="icon" type="image/x-icon" href="source/img/burcas-fivecon.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
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
            <li><a href="menu.php">Cardápio</a></li>
            <?php
            if($logado == true){
                echo "<li><a href='/source/php/comandas.php'>COMANDAS</a></li>";
            }
            ?>
        </ul>
        <div class="main">
            <?php
            if($logado == true) {
                echo '<li>' . strtoupper($_SESSION['user']) . '</li>';
                echo '<button onclick="loggoff()">LogOff</button>';
                echo '<li><a href="addlanche.php"> Adicionar lanche </a></li>';
            }
            else{
                echo "<li><a href='source/php/register.php' class='user'><i class='ri-user-2-fill'></i>Sign in</a></li>";
                echo "<li><a href='source/php/login.php'>Login</a></li>";
            }
            ?>
            <div class="bx bx-menu" id="menu-icon">
            </div>
        </div>
    </header>
    <div class="container">
        <section class="gallery">
            <div class="model">
                <img src="source/img/lanche.png" height="350px" alt="Lanches">
                <p class="gallery-text">Lanches</p>
            </div>
            <div class="model">
                <img src="source/img/porcao.png" height="350px" alt="Porções">
                <p class="gallery-text">Porções</p>
            </div>
            <div class="model">
                <img src="source/img/drinks.png" height="350px" alt="Drinks">
                <p class="gallery-text">Drinks</p>
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
<script src="source/js/script.js"></script>

</html>