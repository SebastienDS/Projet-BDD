const password = document.getElementById("password")
const confirm_password = document.getElementById("confirm");

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Mot de passe incorrect");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;