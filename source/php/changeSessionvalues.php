<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include('db.php');

// Assuming $con is a valid mysqli connection
// No need to create the database and select it every time; this should typically be done once outside this code block

if (isset($_POST['novoValor'])) {
    $_SESSION['logged'] = $_POST['novoValor'];
    session_destroy();
}

if (isset($_POST['closeOrder'])) {
    try {
        mysqli_select_db($con, 'orders');
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

        
        $insertQuery = "INSERT INTO orders (name, value, date) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sds", $name, $value, $data); 

        
        if (mysqli_stmt_execute($stmt)) {
            echo "Order inserted successfully!";
        } else {
            echo "Error inserting order: " . mysqli_error($con);
        }

        
        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}

if (isset($_POST['addbutton'])) {
    echo 'aaa';
}

if (isset($_POST['criarMesa'])) {
    $table_name = $_POST['table_name'];
    $number = $_POST['number'];
    mysqli_select_db($con, 'menu');

    // Use prepared statements to prevent SQL injection
    $updateQuery = "UPDATE tables SET name = ? WHERE number = ?";
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $table_name, $number); // Assuming 's' for string, 'i' for integer

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Table name updated successfully!";
    } else {
        echo "Error updating table name: " . mysqli_error($con);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

if(isset($_POST['product'])){
    $product = $_POST['product'];
    $tablenumber = $_POST['tablenumber'];
    mysqli_select_db($con,"table$tablenumber");
    if(mysqli_query($con,"INSERT INTO products(product) VALUES($product)"));
    
}


if (isset($_POST['abrirMesa'])) {
    $tablenumber = $_POST['table_number'];
    $table_name = $_POST['table_name'];
    mysqli_select_db($con, "menu");

    ## CHECK IF TABLE EXISTS
    $sql = mysqli_query($con, "SELECT * FROM tables WHERE number = $tablenumber");
    $result = mysqli_fetch_assoc($sql);

    if ($table_name == '' && $result == '') {
        mysqli_query($con, "INSERT INTO tables (number) VALUES ($tablenumber)");

        // Verificar se houve erro na inserção
        if (mysqli_errno($con)) {
            $response = array("status" => "error", "message" => "Error: " . mysqli_error($con));
        } else {
            $response = array("status" => "success", "message" => "Table number inserted successfully!");
        }
        
        // Fechar a conexão
        mysqli_close($con);
        
        // Adicionando um parâmetro extra ao response
    }
    $response["additional_parameter"] = "MESA $tablenumber JA EXISTE";
        
    // Convertendo o array associativo em JSON e enviando de volta ao cliente
    echo json_encode($response);
    exit;
}

?>