

function closeorder(){
    $.ajax({
        url: "source/php/changeSessionvalues.php",
        method: "POST",
        data: { closeOrder: "true" },
        success: function(response) {
            alert("feito");
        }
    });
}

function loggoff(){
    console.log('olaaaa');
    $.ajax({
        url: "source/php/changeSessionvalues.php",
        method: "POST",
        data: { novoValor: "false" },
        success: function(response) {
            window.location.href = "/menu.php";
        }
    });
}
