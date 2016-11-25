<?php
if(session_id() == '') {
    session_start();
    if(isset($_SESSION['email'])){
        header("location:../widget/admin_panel/admin_home.php");
    }
}
?>
<!DOCTYPE html>

<html lang="en" class=""> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../essentials/common-props.css"/>
        <link rel="stylesheet" type="text/css" href="../page/login&registration_extra/css/style.css" />
        <link rel="stylesheet" type="text/css" href="../page/login&registration_extra/css/animate-custom.css" />
        <!-- Form validation: -->
        <script type="text/javascript">
            function CheckForm() {
                feedback += checkEmail(frm.email.value)
                feedback += checkPassword(frm.password.value)

                if (feedback == "") {
                    return true;
                } else {
                    alert(feedback);
                    return false
                }
            }

            function checkEmail(field) {
                if (field == "") {
                    return 'Please Enter Your Email Address\n';
                } else {
                    return "";

                }
            }
            function checkPassword(field) {
                if (field == "") {
                    return 'Please Enter Your Password\n';
                } else {
                    return "";
                }
            }
        </script>
    </head>
    <body>
        <?php require '../essentials/header.html';?>
        <div class="container">

            <section class="body-content">				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form id="frm" method="post" action="../widget/admin_panel/a_login.php"> 
                                <h1>Log in as Admin</h1> 
                                <hr>
                                <p> 
                                    <label for="email" data-icon="u" > Your Email</label>
                                    <input type="text" maxlength="32" id="email" name="email" placeholder="Email"/>
                                </p>
                                <p> 
                                    <label for="password" data-icon="p"> Your password </label>
                                    <input type="password" maxlength="32" id="password" name="password" placeholder="password"/> 
                                </p>
                                <p class="login button"> 
                                <tr><td><input type="submit" id="submit" name="submit" onClick="return CheckForm();" value="Log  In"/>
                                        </p> 
                                        <p class="change_link">
                                            <a class="admin_help" href="admin_help.php">Help</a>
                                            Not a member yet ?
                                            <a href="admin_registration_page.php" class="to_register">Join us</a>
                                        </p>
                            </form>
                        </div>						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>