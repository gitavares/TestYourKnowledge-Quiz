function confirmPasswordCheck() {
    $password = document.getElementById("password").value
    $confirmPassword = document.getElementById("confirmPassword").value

    if($password != $confirmPassword){
        document.getElementById("error-message").innerHTML = "Passwords doesn't match";
    } else {
        document.getElementById("error-message").innerHTML = "";
    }
}