<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include('db.php');

if (isset($_POST['addTableName'])) {
    $tableName = $_POST['tableName'];
    $tableNumber = $_POST['tableNumber'];
    mysqli_select_db($con,'menu');

    // Use prepared statements para evitar SQL injection
    $query = "UPDATE tables SET name = ? WHERE number = ?";
    $stmt = mysqli_prepare($con, $query);

    // Vincular os parâmetros
    mysqli_stmt_bind_param($stmt, 'si', $tableName, $tableNumber);

    // Executar a consulta
    mysqli_stmt_execute($stmt);

    // Verificar se houve erro na execução da consulta
    if (mysqli_errno($con)) {
        $response = array("status" => "error", "message" => "Erro ao atualizar o nome da mesa: " . mysqli_error($con));
    } else {
        $response = array("status" => "success", "message" => "Nome da mesa atualizado com sucesso!");
    }

    // Fechar a instrução preparada
    mysqli_stmt_close($stmt);

    // Convertendo o array associativo em JSON e enviando de volta ao cliente
    echo json_encode($response);
    exit;
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
            $response = array("status" => "error", "message" => "Erro ao inserir a mesa: " . mysqli_error($con));
        } else {
            $response = array("status" => "success", "message" => "Table number inserted successfully!");
        }
    } else {
        $response = array("status" => "error", "message" => "MESA $tablenumber JA EXISTE");
    }
    
    // Convertendo o array associativo em JSON e enviando de volta ao cliente
    echo json_encode($response);
    exit;
}

?>