<?php
// requerimentos 

require('db.php');
session_start();

//verificar se esta logado se nao estiver validar credenciais

if($_SESSION['logged']){
    header("location:table.php");
}
else{
    if(isset($_POST['send'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
    
        $sql = mysqli_query($con,"SELECT * FROM users WHERE username = '$user'");
        $result = mysqli_fetch_assoc($sql);
        if(password_verify($pass,$result['password'])){
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $_POST['username'];
            $_SESSION['id'] = $result['id'];
            header("location:table.php");
            exit();
        }
    }


}

//redirecionar ao registro

if(isset($_POST['register'])){
    header("location: register.php");
}







?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/login.css">
    <script src="/source/js/login.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <section class="login-selector">
            <div class="toggle-button">
                <input type="checkbox" class="checkbox" id="toggle">
                <label for="toggle" class="label"></label><br>
            </div>
        </section>
        <div class="Sections">
            <section id="loginSection" class="login">
                <div class="inputs">
                    <input type="text" name="usernameLogin" id="usernameLogin" placeholder="USERNAME"><br>
                    <input type="password" name="passwordLogin" id="passwordLogin" placeholder="PASSWORD">
                </div>
                <div class="buttons">
                    <button id="login-button">Login</button>
                    <button id="back-button"> BACK</button>
                </div>
            </section>
            <section class="registerSection" id="registerSelection">
                <div class="inputs">
                    <input type="text" name="username" id="username" placeholder="USERNAME"><br>
                    <input type="password" name="password" id="password" placeholder="REGISTER"> <button id="show-pass"><img src="/source/img/show-password.png" height="20px" width="20px"alt=""></button>
                </div>
                <div class="buttons">
                    <button id="login-button">Login</button>
                    <button id="back-button"> BACK</button>
                </div>
            </section>
        </div>
    </div>
</body>
<script>

</script>
</html>