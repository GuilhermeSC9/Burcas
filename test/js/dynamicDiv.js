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
    var main = document.getElementsByClassName('main')[0];
    var dialog = document.getElementById('dialog');
    dialog.show()
    main.style.filter = "blur(3px)";
    if(error){
        console.log(error);
    }
}