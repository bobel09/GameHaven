function checkForErrors(event) {

    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var email = document.getElementById("email").value;
    var emailFormat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var error = document.getElementById("error");
    if (!email.match(emailFormat)) {
        error.textContent = "Invalid email address.";
        event.preventDefault();
        return false;
    }
    if (password.length < 8) {
        error.textContent = "Password must be at least 8 characters long.";
        event.preventDefault();
        return false;
    }
    if (password != confirmPassword) {
        error.textContent = "Passwords do not match.";
        event.preventDefault();
        return false;
    }
    error.textContent = "";

    return true;
}
