


function createtable() {
    var tablenumber = document.getElementById('tablenumber').value;
    var tablename = document.getElementById('tablename').value;
    console.log('Function called');
    console.log('Table Number:', tablenumber);
    console.log('Table Name:', tablename);

    jQuery.ajax({
        url: "changeSessionvalues.php",
        method: "POST",
        data: { criarMesa: "True", number: tablenumber, table_name: tablename },
        success: function(response) {
            console.log('AJAX Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
}

function addProduct() {
    var tablenumber = document.getElementById('tablenumber').value;
    console.log('Function called');
    var product = document.getElementById('product_add').value
    jQuery.ajax({
        url: "changeSessionvalues.php",
        method: "POST",
        data: {product: product, tablenumber: tablenumber},
        success: function(response) {
            console.log('AJAX Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    })
}

function adicionarurl(element) {
    var tablenumber = element.getAttribute('data-tablenumber');
    console.log(element.getAttribute('data-tablenumber'));
    console.log('Element:', element);
    if (!tablenumber) {
        console.error('Data attribute "data-tablenumber" not found.');
        return;
    }

    var tablename = document.getElementById('tablename').value;

    // Pegar a URL atual
    var urlAtual = window.location.href;

    // Variáveis para os novos valores dos parâmetros
    var novoValor1 = tablenumber;
    var novoValor2 = tablename;

    // Adicionar novos parâmetros GET ou atualizar os valores dos parâmetros existentes
    var novosParametros = "tablenumber=" + novoValor1 + "&tablename=" + novoValor2;

    // Atualizar a URL sem recarregar a página usando replaceState
    if (window.history.replaceState) {
        var novoUrl = urlAtual.split('?')[0]; // Remove os parâmetros atuais
        novoUrl += '?' + novosParametros; // Adiciona os novos parâmetros

        window.history.replaceState(null, null, novoUrl);
    }

    // Agora você pode continuar com o seu código AJAX
    jQuery.ajax({
        url: "changeSessionvalues.php",
        method: "POST",
        data: { abrirMesa: "True", table_number: tablenumber, table_name: tablename },
        success: function(response) {

                    // Criar a mensagem de erro esperada com o valor de tablenumber
            var errorMessage = '{"additional_parameter":"MESA ' + tablenumber + ' JA EXISTE"}';
            console.log("ERROR" + errorMessage);
            console.log("RESPONSE" + response);
        // Verificar se a resposta corresponde à mensagem de erro esperada
            if (response == errorMessage) {
                console.log("Mesa já existe.");
            } else {
                var urlAtual = window.location.href.split('?')[0];
                window.location.href = urlAtual;
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
    
}

// Se você estava tentando definir outra função chamada `createTable`, aqui está ela separadamente:
function createTable(){
    var tablenumber = document.getElementById('tablenumber').value;
    var tablename = document.getElementById('tablename').value;

    jQuery.ajax({
        url: "changeSessionvalues.php",
        method: "POST",
        data: { createtable: "True", number: tablenumber, table_name: tablename },
        success: function(response) {
            console.log('AJAX Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
}
