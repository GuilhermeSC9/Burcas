document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById("toggle");
    const registerLabel = document.getElementById("registerLabel");
    const loginLabel = document.getElementById("loginLabel");
    const login = document.getElementById("loginSection");
    const register = document.getElementById("registerSelection");
    loginLabel.style.textShadow = "1px 4px 7px rgba(255, 252, 79, 0.6)";

    toggle.addEventListener("change", function() {
      if (toggle.checked) {
        console.log('register');
        loginLabel.style.textShadow = "";
        registerLabel.style.textShadow = "1px 4px 7px rgba(255, 252, 79, 0.6)";
        login.style.left = "100px";
        login.style.opacity = "0";
        register.style.opacity = "1";
        register.style.left = "0px"
        register.style.display = "grid";
        login.style.display = "none";
      } else {
        registerLabel.style.textShadow = "";
        loginLabel.style.textShadow = "1px 4px 7px rgba(255, 252, 79, 0.6)";
        console.log('login');
        login.style.left = "0px";
        login.style.opacity = "1";
        register.style.opacity = "0";
        register.style.right = "100px"
        register.style.display = "none";
        login.style.display = "grid";
      }
    });
  });
  