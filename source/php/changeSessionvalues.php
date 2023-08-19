<?php
session_start();
include('db.php');


if(isset($_POST['novoValor'])){
    $_SESSION['logged'] = $_POST['novoValor'];
    session_destroy();
}

if(isset($_POST['closeOrder'])){
    try{
        mysqli_query($con,'CREATE DATABASE IF NOT EXISTS orders');
        mysqli_select_db($con,'orders');
        mysqli_query($con, 'CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            date DATETIME,
            value DOUBLE
        )');        
        $value = $_SESSION['value'];
        $name = $_SESSION['user'];
        mysqli_query($con,"INSERT INTO orders(name,value) VALUES($name,$value)");
    }
    catch (Exception $e){
        echo $e;
    }    
}







?>