document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById("toggle");
    const login = document.getElementById("loginSection");
    const register = document.getElementById("registerSelection");

    toggle.addEventListener("change", function() {
      if (toggle.checked) {
        console.log('register');
        login.style.left = "100px";
        login.style.opacity = "0";
        register.style.opacity = "1";
        register.style.left = "0px"
        register.style.display = "grid";
        login.style.display = "none";
      } else {
        console.log('login');
        login.style.left = "0px";
        login.style.opacity = "1";
        register.style.opacity = "0";
        register.style.left = "100px"
        register.style.display = "none";
        login.style.display = "grid";
      }
    });
  });
  