
<?php

session_start();
error_reporting(0);
require('../../core/database/connect.php');

if (!$_SESSION['email']) {

    if (isset($_POST['submit'])) {

        //store posted value in php variables

        $email = $_POST['email'];
        $password = $_POST['password'];


        //create a query

        $query = "select email, password, user_type from users where email = '$email' AND password = '$password' AND user_type = 'user'";
        $result = mysql_query($query);

        if (!$result) {
            echo ("Error:Email and password not found in database" . mysql_error());
        } else if (mysql_num_rows($result) > 0) {

            $_SESSION['email'] = $email;
            header('location:user_home.php');
        } else {
            echo "<script type='text/Javascript'>alert('Invalid email and password'); location.href = '../../page/user_login_page.php';</script>" . mysql_error();
        }
    } else {
        die(mysql_error());
    }
} else {
    header('location:user_home.php');
    exit();
}
?>