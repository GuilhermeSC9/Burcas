var canOpenTable = false;


$(document).ready(function() {
    console.log("jQuery está sendo executado!");
// Outras operações com jQuery aqui...
});




$(document).ready(function() {
    $('#search').on('input', function() {
        var searchText = $(this).val().toLowerCase().trim();
        console.log("Search text:", searchText);

        var noResultsMessage = $('#no-results');
        noResultsMessage.hide();

        $('.table-link').each(function() {
            var tableNumber = $(this).attr('data-tablenumber'); // Usando attr() em vez de data()
            console.log("TABLE NUMBER SEARCH " + tableNumber);
            var tableName = $(this).find('h2').text().toLowerCase();

            if (tableNumber && tableNumber.toString().includes(searchText) || tableName.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        var visibleTables = $('#table').find('.table-link:visible').length;
        if (visibleTables === 0 && searchText !== '') {
            noResultsMessage.show();
        } else {
            noResultsMessage.hide(); // Certifique-se de ocultar a mensagem se houver resultados visíveis
        }
    });
});


function adicionarurl(element) {
    var tablename = element.getAttribute('data-tablename');
    var tablenumber = element.getAttribute('data-tablenumber');




    if (!tablenumber) {
        console.error('Data attribute "data-tablenumber" not found.');
        return;
    }
    console.log('esse e o nome com n ' + tablename);
    var urlAtual = window.location.href;
    var novoValor1 = tablenumber;
    var novoValor2 = tablename;
    var novosParametros = "tablenumber=" + novoValor1 + "&tablename=" + novoValor2;

    if (window.history.replaceState) {
        var novoUrl = urlAtual.split('?')[0];
        novoUrl += '?' + novosParametros;
        window.history.replaceState(null, null, novoUrl);
    }
    if(tablename == ''){
        var openPopup = confirm("Deseja adicionar um nome para a mesa?");
    if (openPopup) {
        var tableName = prompt("DIGITE O NOME DA MESA", "");
        canOpenTable = true;
    }
    else{
        var confirmOpenTable = confirm("Deseja abrir a mesa sem nome?");
        if (!confirmOpenTable) {
            // Cancelar a abertura da mesa
            canOpenTable = false; // Atualizar a variável
        }
        else{
            canOpenTable = true;
        }
    }
    if(canOpenTable){
        jQuery.ajax({
            url: "changeSessionvalues.php",
            method: "POST",
            data: { abrirMesa: "True", table_number: tablenumber, table_name: tablename },
            success: function(response) {
                var errorMessage = '{"status":"error","message":"MESA ' + tablenumber + ' JA EXISTE"}';
    
                if (response == errorMessage) {
                    console.log("Mesa já existe.");
                }
                else {
                    if (tableName !== null) {
                        jQuery.ajax({
                            url: "changeSessionvalues.php",
                            method: "POST",
                            data: { addTableName: "True", tableNumber: tablenumber, tableName: tableName },
                            success: function(response) {
                                console.log(response);
                                window.location.href = "/source/php/openTable.php?tableNumber="+ tablenumber;
                            }
                        });
                    }
                }
                },

            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });

    }
    }
    else{
        window.location.href = "/source/php/openTable.php?tableNumber="+ tablenumber;
    }
}
