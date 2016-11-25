<!DOCTYPE html>

<html lang="en" class=""> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="../essentials/common-props.css"/>
    </head>
    <body>
        <?php require '../essentials/header.html'; ?>
        <div class="container">
            <section class="body-content">
                <div id="container_demo" >
                    <div id="wrapper" class="page_p">
                        <div id="login">
                            <h1>Admin Panel</h1> 
                            <hr>
                            <p class="page_link">
                                <b>For Setup or Create a Database </b>
                                <a href="../core/database/db_setup.php" target="_blank" class="">Click Here.</a>
                            </p>
                            <p class="page_link">
                                <b>For LogIn As Administrator</b>
                                <a href="admin_login_page.php" target="_blank" class="">Click Here.</a>
                            </p>
                            <p class="page_link"> 
                                <b>OR, </b><b>You can Join Wtih Us! By</b>
                                <a href="admin_registration_page.php" target="_blank" class="">Click Here.</a>
                            </p>
                            <p class="page_link"> 
                                <b>For System Information!</b>
                                <a href="admin_help.php" target="_blank" class="">Click Here.</a>
                            </p>
                        </div>						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>