<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. */
if(session_id() == '') {
    session_start();
    if(isset($_SESSION['email'])){
        header("location:../widget/user_panel/user_home.php");
    }
}
?>

<html lang="en" class=""> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../essentials/common-props.css"/>
        <link rel="stylesheet" type="text/css" href="../page/login&registration_extra/css/style.css" />
        <link rel="stylesheet" type="text/css" href="login&registration_extra/css/animate-custom.css" />
    </head>
<?php
require '../essentials/header.html';
?>
    <section class = "body-content">				
        <div id="container_demo" >
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form id="frm" method="post" action="../widget/user_panel/u_login.php"> 
                        <h1>To view our products, please Log in first</h1> 
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
                        <tr><td><input type="submit" id="submit" name="submit" value="Log  In"/>
                                </p> 
                                <p class="change_link">
                                    <a class="admin_help" href="user_help.php">Help</a>
                                    Not a member yet ?
                                    <a href="user_registration_page.php" class="to_register">Join us</a>
                                </p>
                    </form>
                </div>						
            </div>
        </div>  
    </section>
</html>
