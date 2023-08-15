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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="username" id="" placeholder="username">
        <input type="password" name="password" id="">
        <button name="send">enviar</button>
        <button name="register">regster</button>
        <a href="/menu.php">menu</a>
    </form>
</body>
<script>

</script>
</html>