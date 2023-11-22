<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include('db.php');


if(isset($_POST['novoValor'])){
    $_SESSION['logged'] = $_POST['novoValor'];
    session_destroy();
}

if(isset($_POST['closeOrder'])){
    try {
        // Assuming $con is a valid mysqli connection
        // No need to create the database and select it every time; this should typically be done once outside this code block
        mysqli_query($con,'CREATE DATABASE IF NOT EXISTS orders');
        mysqli_select_db($con,'orders');
        mysqli_query($con, 'CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            date DATETIME,
            value DOUBLE
        )');
        // Retrieve values from $_SESSION
        $value = $_SESSION['value'];
        $name = $_SESSION['user'];
        $data = date("Y-m-d H:i:s");
        
        // Use prepared statements to prevent SQL injection
        $insertQuery = "INSERT INTO orders (name, value, date) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sds", $name, $value, $data); // Assuming 's' for string, 'd' for double
        
        // Execute the prepared statement
        if(mysqli_stmt_execute($stmt)) {
            echo "Order inserted successfully!";
        } else {
            echo "Error inserting order: " . mysqli_error($con);
        }
        
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    } 
}

if(isset($_POST['addbutton'])){
    console.log('aaa');
}
?>