<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<body>
    <h1>QUANTOS ESTABELECIMENTOS USARAM ESTE BANCO DE DADOS ?</h1>
    <select name="quantos" id="option">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <button id="button" onclick="db_chose()">CRIAR</button>
    <div id="parent"></div><br>
    <button onclick="window.location.href='table.php'">VOLTAR</button>
</body>
<script>
    var db_numbers = document.getElementById('option');
    var container = document.getElementById("parent");

    //criar inputs para o nome de cada banco de dados

    function db_chose(){
        for(var i = 1; i <= db_numbers.value; i++){
            if(document.getElementById(i)){
                console.log('ja existe');
            }
            else{
                var input = document.createElement("input");
                input.setAttribute('type', 'text');
                input.setAttribute('name', '' + i);
                input.setAttribute('id', i);
                input.setAttribute('placeholder', 'Numero ' + i);
                container.appendChild(input);
            }

        }
        //criar botao de cadastrar se ele ja nao existir
        
        if(document.getElementById('cad_butt')){
            console.log('tbm ja existe');
        }
        else{
            var button = document.createElement('button');
            button.setAttribute('name', 'cadastrar_db');
            button.setAttribute('id', 'cad_butt');
            button.textContent = "cadastrar";
            container.appendChild(button);
        }
        
    }
</script>
</html>