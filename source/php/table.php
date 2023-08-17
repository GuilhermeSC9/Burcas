<?php
//reportar erros descobertos na pagina
error_reporting(E_ALL);
ini_set('display_errors', 1);


//requerimentos e variaveis

include_once('admin_panel.php');
require('db.php');
session_start();
$table_name = 'lucas';
$login = $_SESSION['logged'];
$username = $_SESSION['user'];
$db_name = "burcas";


// Verificar se o usuário já está logado e suas credenciais

if ($login) {
    $sql = mysqli_query($con,"SELECT admin FROM users WHERE username = '$username'");
    $result = mysqli_fetch_assoc($sql);
    $result_ofc = $result['admin'];
    if($result_ofc == 1){
        $_SESSION['admin'] = TRUE;
    }
    else{
        $_SESSION['admin'] = FALSE;
    }
    //criar banco de dados automaticamente se ja nao existente
    if (isset($_POST['create'])) {
        if (mysqli_query($con, "CREATE DATABASE IF NOT EXISTS $db_name")) {
            mysqli_select_db($con,$db_name);
            if (mysqli_query($con, "CREATE TABLE IF NOT EXISTS $table_name (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(255), price DOUBLE NOT NULL, product VARCHAR(255) NOT NULL, product_image VARCHAR(255) NOT NULL, PRIMARY KEY(id))")) {
                echo "create";
                exit();
            }
        } else {
            echo "TMNC";
        }
    }
} else {
    echo 'não logado';
}

//deslogar

if(isset($_POST['logoff'])){
    header("location: login.php");
    $_SESSION['logged'] = false;
    exit();
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <button name="create" id="login">
            CREATE DB
        </button>
        <p>Bem Vindo <?php echo ucwords($username) ?> Você esta atualmente no <?php echo ucwords($db_name) ?></p>
        <button name="logoff" id="logoff">LOGOOF</button>
    </form>
    <button name="OLA" id="butt_log" onclick="window.href='/menu.php'">LOGAR CADE</button>
    <button id="admin_panel" onclick="window.location.href='admin_panel.php'">admin panel</button>
    <button onclick="window.location.href='/test/dynamicDiv.php'">DIV DYNAMIC</button>
    <a href="/menu.php">MENU</a>
    
</body>
<script>
    var logged = <?php echo json_encode($login) ?>;
    var is_admin = <?php echo json_encode($result_ofc)?>;
    var button = document.getElementById('login');
    var button_login = document.getElementById('butt_log');
    var loggoff = document.getElementById('logoff');
    var admin_button = document.getElementById('admin_panel');


    if (logged) {
        if(is_admin == 1){
            console.log("voce [e um admin");
            admin_button.style.display = "block";
        }
        else{
            admin_button.style.display = "none";
            console.log("voce nao e um admin");
        }
        loggoff.style.display = 'block';
        button_login.style.display = 'none';
        button.style.display = 'block';
    } else {
        loggoff.style.display = 'none';
        button_login.style.display = 'block';
        button.style.display = 'none';
    }
</script>
</html>
