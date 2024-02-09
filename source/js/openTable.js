function deleteDB(){
    var tableDB = document.getElementById("dbName").value;
    var tableNumber = document.getElementById("tableNumber").value;
    console.log("BANCO DE DADOS: " + tableDB);
    jQuery.ajax({
        url: "openTablesValues.php",
        method: "POST",
        data: { deleteDB: "True", dbName: tableDB, tableNumber: tableNumber },
        success: function(response){
            if(response === '{"status":"success","message":"BANCO DELETADO"}'){
                window.location.href = "comandas.php";
            }
            console.log(response);
        }
    });
}

function addProduct(){
    mysqli_select_db($con,'menu');

}
