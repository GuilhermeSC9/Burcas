var nomePagina = window.location.pathname.split("/").pop();

if(nomePagina == "menu.php"){
    document.querySelector(".menu").style.fontSize = "20px";
    document.querySelector(".menu").style.color = "var(--main-color)";
    
}
