<?php 
session_start();
include_once('db.php');
if(isset($_POST['register'])){

    //variaveis
    $user = $_POST['username'];
    $_SESSION['user'] = $user;
    $pass = $_POST['password'];
    $c_pass = $_POST['c_password'];
    $admin = $_POST['admin_pass'];
    $email = $_POST['email'];

    // PEGAR SENHA ADMIN DATABASE
    $sql = mysqli_query($con,"SELECT password FROM users WHERE username = 'admin'");
    $result_sql = mysqli_fetch_assoc($sql);
    $admin_db = $result_sql['password'];
    
    //verificar se ja existe o username
    $query = mysqli_query($con,"SELECT * FROM users WHERE username = '$user'");
    $result = mysqli_fetch_assoc($query);

    
    if($user == $result['username']){
        echo "username ja existente";
    }
    else{
        //verificar se password conhencide
        if($pass == $c_pass){
            //VERIFICAR SE SENHA ADMIN CONHECIDE
            if(!password_verify($admin,$admin_db)){
                $secure_pass = password_hash($pass,PASSWORD_DEFAULT);
                $query = mysqli_query($con,"INSERT INTO users (username,password,email) VALUES('$user','$secure_pass','$email')");
            }
            else{
                $secure_pass = password_hash($pass,PASSWORD_DEFAULT);
                $query = mysqli_query($con,"INSERT INTO users (username,password,email,admin) VALUES('$user','$secure_pass','$email',1)");
            }
        }
        else{
            echo "digita a sena igual fldpt";
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