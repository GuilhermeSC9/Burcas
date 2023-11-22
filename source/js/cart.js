

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

function addbutton(){
    console.log('oi0');
    $.ajax({
        url: "source/php/changeSessionvalues.php",
        method: "POST",
        data: { addbutton: "true" },
        success: function(response) {
            console.log('adicionar');
        }
    });
}

// No JavaScript
document.getElementById('addbutton').addEventListener('click', function() {
    console.log('ola');
    addbutton();
});

