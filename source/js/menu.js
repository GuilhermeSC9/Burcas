function loggoff(){
    console.log('olaaaa');
    jQuery.ajax({
        url: "source/php/changeSessionvalues.php",
        method: "POST",
        data: { novoValor: "false" },
        success: function(response) {
            window.location.href = "/menu.php";
        }
    });
}
