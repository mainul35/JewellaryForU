< script >
function CheckForm() {
    feedback = checkFirstName(frm.f_name.value)
    feedback += checkLastName(frm.l_name.value)
    feedback += checkUserName(frm.u_name.value)
    feedback += checkPassword(frm.password.value)
    feedback += checkRePassword(frm.re_password.value)
    feedback += checkEmail(frm.email.value)

    if (feedback == "") {
        return true;
    } else {
        alert(feedback);
        return false
    }
}
function checkFirstName(field) {
    if (field == "") {
        return 'Please Enter a First Name\n';
        document.forms[frm].element[f_name].focus();
    } else {
        return "";

    }
}
function checkLastName(field) {
    if (field == "") {
        return 'Please Enter a Last Name\n';
    } else {
        return "";
    }
}
function checkUserName(field) {
    if (field == "") {
        return 'Please Enter a User Name\n';
    } else if (field.length < 5) {
        return "Username must be at least 5 characters \n";
    } else {
        return "";
    }
}
function checkPassword(field) {
    //var pass = document.getElementByID('password');
    //var regPass = /^([A-Za-z0-9_\-\.])$/;
    if (field == "") {
        return 'Please Enter a Password\n';
    }/*else if(regPass.test(field)==false){
     return "Passwords require one each of a-z, A-Z and 0-9\n";
     }*/ else {
        return "";
    }
}
function checkRePassword(field) {
    //var repass = document.getElementByID('re_password');
    if (field == "") {
        return 'Please Enter Password Again\n';
    } else if (checkPassword(field) === field) {
        return "";
    } else {
        return "Password Does Not Match\n";
    }
}
function checkEmail(field) {
    var regEmail = /^([A-Za-z0-9_\-\.]){1,}\@([A-Za-z0-9_\-\.]){1,}\.([A-Za-z]{2,4})$/;
    if (field == "") {
        return 'Please Enter a Email Address\n';
    } else if (regEmail.test(field) == false) {
        return "Invalid Email Address, Please enter a valid one\n";
    } else {
        return "";
    }
}
< /script>