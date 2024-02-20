$(document).ready(function() {
    console.log("jQuery está sendo executado!");
// Outras operações com jQuery aqui...
});


$(document).ready(function() {
    $(".buttonAddButton").on("click", function() {
        var $parent = $(this).parent().prev(); // Navega para o elemento anterior, que é o div com a classe 'productsTables'
        var productId = $parent.find(".productId").data("productnumber");
        var tableid = document.getElementById('tableNumber').value;
        var productPrice = $parent.find(".price").data("price");
        var quantity = $(this).siblings('.qty').val();
        var text = $parent.find(".texto").val();


        console.log("MESA NUMERO ", tableid);
        console.log("Parent:", $parent);
        console.log("ID do produto:", productId);
        console.log("Quantidade selecionada:", quantity);
        console.log("Texto:", text);

        $.ajax({
            url: "openTablesValues.php",
            method: "POST",
            dataType: "json",
            data: {addProduct: "True",Quantity: quantity,productID: productId,Observation: text,tableNumber: tableid, productPrice: productPrice },
            success(response){
                if(response.status == "success"){
                    history.go(-1);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Lógica para lidar com erros de requisição
            }
        })
    });
});
