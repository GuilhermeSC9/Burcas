function createtable() {
    console.log('Function called');
    var tablenumber = document.getElementById('tablenumber').value;
    var tablename = document.getElementById('tablename').value;
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
