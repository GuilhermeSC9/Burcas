function criarMesa(){
    var grid = document.getElementById("grid");
    var mesa = document.createElement("div");
    mesa.setAttribute('class' , 'gridItem');
    grid.appendChild(mesa);
}