<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('/Users/lucas/Desktop/Projeto_Gui/Burcas/source/php/db.php');


session_start();
$session_id = $_SESSION['id'];
$session_user = $_SESSION['user'];
mysqli_select_db($con,'mesas');


$run = mysqli_query($con,"SELECT * from mesas");


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criação de Comandas</title>
    <link rel="stylesheet" href="/test/css/dynamicDiv.css">
</head>
<header>
    <nav>
        <li class="li">
            <ul><a href="/source/php/table.php">TABLES</a></ul>
        </li>
    </nav>
</header>
<body>
    
    <div class="main">
        <h1>
            Esta é a div Main!
        </h1>
        <h2>
                Esta é a div Grid!
            </h2>
        <div class="grid" id="grid">
            <?php 
            while ($result = mysqli_fetch_assoc($run)) {
            $names = $result['name'];
            $number = $result['number'];
            echo '<div class="gridItem"> 
                <h1>' . $names . '</h1>
                <h2>' . $number . '</h2>
                </div>';
            }

            ?>
        </div>
        <button class="btn" onclick="openDialog()">Criar Mesa</button>
    </div>
    <dialog id="dialog" class="dialog">
        <p class="error"></p><br>
        <input type="text" placeholder="TABLE NAME" id="table_name"><br>
        <input type="number" name="table_number" placeholder="table number" id="table_number"><br>
        <input type="hidden" id="username_session" data-content="<?php echo $session_user?>">
        <button onclick="criarMesa()">CRIAR</button>
    </dialog>
</body>
<script src="/test/js/dynamicDiv.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>