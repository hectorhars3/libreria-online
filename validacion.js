document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    const form = document.getElementById("loginForm");
  
    emailInput.addEventListener("input", validateEmail);
    passwordInput.addEventListener("input", validatePassword);
  
    form.addEventListener("submit", function (event) {
      if (!validateEmail() || !validatePassword()) {
        event.preventDefault();
      }
    });
  
    function validateEmail() {
      const email = emailInput.value;
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
      if (!emailPattern.test(email)) {
        emailError.textContent = "Por favor, introduce un correo electrónico válido.";
        return false;
      } else {
        emailError.textContent = "";
        return true;
      }
    }
  
    function validatePassword() {
      const password = passwordInput.value;
      const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
  
      if (!passwordPattern.test(password)) {
        passwordError.textContent = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.";
        return false;
      } else {
        passwordError.textContent = "";
        return true;
      }
    }
  });
  