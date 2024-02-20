<?php
include('db.php');
$response = "";


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



if(isset($_POST['addProduct'])){
    $productID = $_POST['productID'];
    $quantity = $_POST['Quantity'];
    $observation = $_POST['Observation'];
    $tableID = $_POST['tableNumber'];
    $total = 0;


    mysqli_select_db($con,'menu');

    $sql = mysqli_query($con,"SELECT * FROM products WHERE id = $productID");
    if(mysqli_errno($con)){
        $response = mysqli_error();
    }
    else{
        $result = mysqli_fetch_assoc($sql);
        $product_price = $result['price'];
        $product_image = $result['image'];
        $product_name = $result['product'];
        mysqli_select_db($con,'table_' . $tableID);
        $sql_qty = mysqli_query($con,"SELECT * FROM products WHERE product = '$product_name'");
        $result_qty = mysqli_fetch_assoc($sql_qty);
        if($result_qty !== null){
            $qtynow = $result_qty['qty'];
            $moreQTY =  $qtynow + $quantity;
            $total = $moreQTY * $product_price;
            mysqli_query($con,"UPDATE products SET qty = $moreQTY WHERE product = '$product_name'");
            if(mysqli_errno($con)){
                $response = array("status" => "error", "message" => "ERRO AO ATUALIZAR PRODUTO: ") . mysqli_error();
            }
            else{
                $response = array("status" => "success", "message" => "Quantidade Alterada !");
                
            }
        }
        else{
            $total = $product_price;
            mysqli_query($con,"INSERT INTO products (product,image,price,qty,total) VALUES ('$product_name','$product_image',$product_price,$quantity,$total)");
            $response = array("status" => "success", "message" => "Produto Adicionado");
        }
        echo json_encode($response);
    }
}
?>