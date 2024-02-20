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


function openPopup() {
    // Exibe o overlay e o popup
    document.getElementById("overlay").style.display = "block";
    document.getElementById("popup").style.display = "block";
}

function closePopup() {
    // Oculta o overlay e o popup
    document.getElementById("overlay").style.display = "none";
    document.getElementById("popup").style.display = "none";
}