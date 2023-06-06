<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require('/Users/lucas/Desktop/Projeto_Gui/Burcas/source/php/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $db_name = $name. "_" . $number;
}

if($name){
    mysqli_select_db($con,'mesas');
    //$run = mysqli_query($con,"CREATE TABLE IF NOT EXISTS $db_name(product VARCHAR(255) NOT NULL,un_price DOUBLE,qty INT NOT NULL DEFAULT 1,total DOUBLE,garcom VARCHAR(255))");
    $run = mysqli_query($con,"INSERT INTO mesas(name,number) VALUES ('$name',$number)");
    if($run == TRUE){
        $run = mysqli_query($con,"CREATE DATABASE IF NOT EXISTS $db_name");
        mysqli_select_db($con,$db_name);
        $RUN_TABLE = mysqli_query($con,"CREATE TABLE IF NOT EXISTS $name (product VARCHAR(255) NOT NULL,unit_price DOUBLE ,total_price DOUBLE,garcom VARCHAR(255)");
        if($RUN_TABLE == TRUE){
            echo "banco de dados criado com sucesso";
        }
    }
    else{
        echo $con->error;
    }
}
?>