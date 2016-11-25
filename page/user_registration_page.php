<!DOCTYPE html>

<html lang="en" class=""> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Registration Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="../essentials/common-props.css"/>
        <link rel="stylesheet" type="text/css" href="login&registration_extra/css/style.css" />
        <link rel="stylesheet" type="text/css" href="login&registration_extra/css/animate-custom.css" />

        <!-- Form validation: -->
        <script type="text/javascript">
            function CheckForm() {
                feedback = checkFirstName(frm.f_name.value)
                feedback += checkLastName(frm.l_name.value)
                feedback += checkEmail(frm.email.value)
                feedback += checkPassword(frm.password.value)
                feedback += checkRePassword()
                feedback += checkAddress(frm.address.value)

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
            function checkPassword(field) {
                if (field == "")
                    return "Please Enter a Password\n"
                else if (field.length < 6)
                    return "Passwords must be at least 6 characters\n"
                else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
                    return "Passwords require one each of a-z, A-Z and 0-9\n"
                return ""
            }
            function checkRePassword() {
                if (frm.re_password.value == "") {
                    return 'Please Enter Password Again\n';
                } else if (frm.password.value != frm.re_password.value) {
                    return "Password Does Not Match\n";
                } else {
                    return "";
                }
            }
            function checkAddress(field) {

                if (field == "") {
                    return 'Please Enter your present Address\n';
                } else {
                    return "";
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
<?php require '../essentials/header.html';?>
            <section class="body-content">				
                <div id="container_demo" >

                    <div id="wrapper">
                        <div id="register" class="animate form">
                            <form id="frm" method="post" action="../widget/user_panel/u_registration.php">
                                <h1> Sign up </h1> 
                                <hr>
                                <p> 
                                    <label for="f_name" data-icon="u">Your First Name</label>
                                    <input type="text" maxlength="32" id="f_name" name="f_name" placeholder="please enter your first name"/>
                                </p>
                                <p> 
                                    <label for="l_name" data-icon="u">Your Last Name</label>
                                    <input type="text" maxlength="32" id="l_name" name="l_name" placeholder="please enter your last name"/> 
                                </p>
                                <p> 
                                    <label for="email" data-icon="e">Your Email</label>
                                    <input type="text" maxlength="32" id="email" name="email" placeholder="please enter your email address"/>
                                </p>
                                <p> 
                                    <label for="password" data-icon="p">Your Password</label>
                                    <input type="password" maxlength="32" id="password" name="password" placeholder="please enter your password"/>
                                </p>
                                <p> 
                                    <label for="re_password" data-icon="p">Confirm Your Password </label>
                                    <input type="password" maxlength="32" id="re_password" name="re_password" placeholder=" please confirm your password"/>
                                </p>
                                <p> 
                                    <label for="address" data-icon="e">Your Address</label>
                                    <input type="text" maxlength="132" id="address" name="address" placeholder="please enter your address"/>
                                </p>
                                <p class="signin button"> 
                                    <input type="submit" id="submit" name="submit" value="Register" onClick="return CheckForm();"/>
                                </p>
                                <p class="change_link"> 
                                    <a class="admin_help" href="user_help.php">Help</a>
                                    Already a member?
                                    <a href="user_login_page.php" class="to_register"> Go and log in </a>
                                </p>
                            </form>
                        </div>

                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>