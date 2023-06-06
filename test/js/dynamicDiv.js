//validando se esta logado

usernameElement = document.getElementById('username_session');
username = usernameElement.getAttribute('data-content');
console.log(username)

if(!username){
    var li = document.getElementsByClassName('li')[0];
    var ul = document.createElement('ul');
    var a = document.createElement('a');

    a.setAttribute('href', '/source/php/login.php');
    a.textContent = "LOGIN";

    li.appendChild(ul);
    ul.appendChild(a);
}
else{
    var li = document.getElementsByClassName('li')[0];
    var ul = document.createElement('ul');
    var a = document.createElement('h1');
    a.textContent = username;

    li.appendChild(ul);
    ul.appendChild(a);
}


function criarMesa(){
    //DELETANDO O BLUR E FECHANDO O POPUP
    dialog.close()
    var main = document.getElementsByClassName('main')[0];
    main.style.filter = "blur(0px)";

    //VARIAVEIS
    var name = document.getElementById('table_name').value;
    var number = document.getElementById('table_number').value;

    if(name == "" && number == ""){
        
        openDialog('Por favor, digite os valores!');
    }
    else if(name == ""){
        openDialog('Preencha o nome!');
    }
    else if(number == ""){
        openDialog('Preencha o numero!');
    }
    else{
        fetch('/test/php/create_db.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'name=' + encodeURIComponent(name) + '&number=' + encodeURIComponent(number)
            })
        .then(response => response.text())
        .then(result => {
            console.log(result); // Exibe a resposta do servidor no console
        })
        .catch(error => {
            console.error('Erro ao enviar solicitação:', error);
        });
        //variaveis
        var grid = document.getElementById('grid');
        var mesa = document.createElement('div');
        var mesaContent = document.createElement('h1');
        var mesaContent_two = document.createElement('h2');

        //conteudo mesa
        mesaContent.textContent = name;
        mesaContent_two.textContent = number;

        ///MESA
        mesa.setAttribute('class' , 'gridItem');
        mesa.setAttribute('onclick', "window.location.href = '/test/test.html?id=" + number + "'");

        //declarando filhos
        grid.appendChild(mesa);
        mesa.appendChild(mesaContent);
        mesa.appendChild(mesaContent_two);
    }
}

function openDialog(error){
    error_p = document.getElementsByClassName('error')[0];
    var main = document.getElementsByClassName('main')[0];
    var dialog = document.getElementById('dialog');
    dialog.show()
    main.style.filter = "blur(3px)";
    if(error){
        error_p.textContent = error;
    }
}