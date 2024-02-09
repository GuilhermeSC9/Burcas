<?php
include('db.php');


if(isset($_POST['deleteDB'])){
    $tablename = $_POST['dbName'];
    $tableNumber = $_POST['tableNumber'];
    $tableDB = strtolower($tablename);
    mysqli_query($con,"DROP DATABASE $tableDB");
    if(mysqli_errno($con)){
        $response = array('status' => 'error', 'message' => 'ERRO AO DELETAR BANCO' . mysqli_error($con));
    }
    else{
        $sql = mysqli_select_db($con,'menu');
        mysqli_query($con,"DELETE FROM tables WHERE number = $tableNumber");
        if(mysqli_errno($con)){
            $response = array('status' => 'error', 'message' => 'ERRO AO DELETAR TABELA' . mysqli_error($con));
        }
        else{
            $response = array('status' => 'success', 'message' => 'BANCO DELETADO');
        }
    }
    echo json_encode($response);
}
?>