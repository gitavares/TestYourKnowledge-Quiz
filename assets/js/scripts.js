function confirmPasswordCheck() {
    $password = document.getElementById("password").value
    $confirmPassword = document.getElementById("confirmPassword").value

    if($password != $confirmPassword){
        document.getElementById("error-message").innerHTML = "Passwords doesn't match";
    } else {
        document.getElementById("error-message").innerHTML = "";
    }
}

// function loadUsersOnline() {
//     console.log("HERE!!")

//     setInterval(function() {
//         { location.reload(1); }
//     }, 500)
// }

// $(document).ready(function(){
//     $('#selectAllCheckboxes').click(function(event){
//         if(this.checked){
//             $('.checkBoxes').each(function() {
//                 this.checked = true;
//             })
//         } else {
//             $('.checkBoxes').each(function() {
//                 this.checked = false;
//             })
//         }
//     })
// })

