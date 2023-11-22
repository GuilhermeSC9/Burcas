<?php
// requerimentos 

require('db.php');
session_start();
mysqli_select_db($con,'logins');

//verificar se esta logado se nao estiver validar credenciais

if($_SESSION['logged']){
    header("location:table.php");
}
else{
    if(isset($_POST['send'])){
        $user = $_POST['usernameLogin'];
        $pass = $_POST['passwordLogin'];
    
        $sql = mysqli_query($con,"SELECT * FROM users WHERE username = '$user'");
        $result = mysqli_fetch_assoc($sql);
        if(password_verify($pass,$result['password'])){
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $user;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/login.css">
    <script src="/source/js/login.js"></script>
    <title>Login</title>
</head>
<body>
<form method="POST">
    <div class="container">
        <div class="Sections" id="Sections">
            <section class="loginRegisterSection">
                <section class="login-selector">
                    <div class="login-register-wrapper">
                        <span class="loginLabel" id="loginLabel">LOGIN </span>
                        <div class="toggle-button">
                            <input type="checkbox" class="checkbox" id="toggle">
                            <label for="toggle" class="label"></label>
                        </div>
                        <label for="toggle" class="registerLabel" id="registerLabel">REGISTER</label>
                    </div>
                </section>

                <section id="loginSection" class="login">
                    <div class="inputs">
                        <input type="text" name="usernameLogin" id="usernameLogin" placeholder="USERNAME"><br>
                        <input type="password" name="passwordLogin" id="passwordLogin" placeholder="PASSWORD">
                    </div>
                    <div class="buttons">
                            <button type="submit" name="send" class="login-button" id="login-button">Login</button>
                            <button class="back-button"id="back-button"> BACK</button>
                    </div>
                </section>
                <section class="registerSection" id="registerSelection">
                    <div class="inputs">
                        <input type="text"  class="username" name="username" id="username" placeholder="USERNAME"><br>
                        <input type="password" name="password" id="password" placeholder="PASSWORD"><br>
                        <input type="text"  class="email" name="email" id="email" placeholder="EMAIL"><br>
                        <input type="text"  class="phone" name="phone" id="phone" placeholder="PHONE NUMBER">
                    </div>
                    <div class="buttons">
                        <button type="submit" name="register" class="register-button" id="register-button">SIGN-IN</button>
                        <button type="submit" name="back" class="back-button" id="back-button"> BACK</button>
                    </div>
                </section>
            </section>
        </div>
    </div>
</form>
</body>
<script>

</script>
</html>