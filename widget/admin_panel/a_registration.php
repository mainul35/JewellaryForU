<DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <?php
            require('../../core/database/connect.php');
            if (isset($_POST['submit'])) {

                //store posted value in php variables

                $f_name = $_POST['f_name'];
                $l_name = $_POST['l_name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $address = $_POST['address'];


                //create a query

                $query = "SELECT * FROM users WHERE email='$email'";
                $result = mysql_query($query);

                if (!$result) {

                    die(mysql_error());
                }
                if (mysql_num_rows($result) > 0) {

                    echo "<script type='text/Javascript'>alert('This $email is already exists in our database! Try again'); location.href = '../../admin/admin_registration_page.php'</script>";
                } else {

                    $query = "INSERT INTO users (first_name, last_name, email, password, address, user_type) VALUES ('$f_name','$l_name','$email','$password','$address','admin')";
                    $result = mysql_query($query, $con);
                    if (!$result) {
                        echo 'Values are not Insert' . mysql_error();
                    } else {
                        echo "<script type='text/Javascript'>alert('You are successfully register to our database! Please Log In'); location.href = '../../admin/admin_login_page.php'</script>";
                    }
                }
            } else {

                die(mysql_error());
            }
            ?>
        </body>
    </html>