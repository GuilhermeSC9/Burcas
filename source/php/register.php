<?php 
session_start();
include_once('db.php');
if(isset($_POST['register'])){
    // definindo variaveis 

    //variaveis
    $user = $_POST['username'];
    $_SESSION['user'] = $user;
    $pass = $_POST['password'];
    $c_pass = $_POST['c_password'];
    $admin = $_POST['admin_pass'];
    
    $query = mysqli_query($con,"SELECT * FROM users WHERE username = '$user'");
    $result = mysqli_fetch_assoc($query);

    
    if($user == $result['username']){
        echo "username ja existente";
    }
    else{
        if($pass == $c_pass){
            if($admin == ""){
                $secure_pass = password_hash($pass,PASSWORD_DEFAULT);
                $query = mysqli_query($con,"INSERT INTO users (username,password,email) VALUES('$user','$secure_pass','$email')");
            }
            else{
                echo "ADMIJNNNNN";
            }
        }
    }
}
if(isset($_POST['verify'])){
    $pass = $_POST['password'];
    $user = $_POST['username'];
    $run = mysqli_query($con,"SELECT * FROM users WHERE username = '$user'");
    $result = mysqli_fetch_assoc($run);
    $secure_pass = $result['password'];
    if(password_verify($pass,$secure_pass)){
        echo "logado";
    }
    else{
        echo "errado";
    }
    
}




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/register.css">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <div class="container">
            <div class="inputs">
                <input type="text" name="username" placeholder="USERNAME">
                <input type="password" name="password" placeholder="PASSWORD">
                <input type="password" name="c_password" placeholder="CONFIRM PASSWORD">
                <input type="text" name="email" placeholder="EMAIL">
                <input type="checkbox" name="admin" id="admin" onclick="checbox()">Admin
                <input type="password" name="admin_pass" style="display:none" placeholder="SENHA ADMIN" id="input_admin">
            </div>
            <div class="buttons">
            <button name="verify">veirfy</button>
            <button name="register">Sign-in</button>
            </div>
        </div>
    </form>
    
</body>
<script>
    function checbox(){
        var check = document.getElementById("admin");
        var input = document.getElementById("input_admin");
        console.log(check.checked);
        if(check.checked == true){
            input.style.display = "block";

        }
        else{input.style.display = "none";}
    }
</script>
</html>