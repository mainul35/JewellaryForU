<!DOCTYPE html>

<html lang="en" class=""> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Database Setup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="../../essentials/common-props.css">
    </head>
    <body>
        <div class="container">
            <?php require '../../essentials/header.html'; ?>

            <section class="body-content">				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login">
                            <h1>Database Setup report</h1> 
                            <hr>
                            <p>
                                <!-- Code for database create -->
                                <?php
                                $db_con = mysql_connect("localhost", "root", "")
                                        or die('Could not connect to host' . mysql_error());

                                //Drop jewellaryForU database if exist.

                                $query = "DROP DATABASE if exists jewellaryForU";
                                $result = mysql_query($query, $db_con);


                                if (!$result) {
                                    echo "Error: Database is not dropped" . mysql_error();
                                } else {
                                    $query = "CREATE DATABASE jewellaryForU"; //Create jewellaryForU database.
                                    $result = mysql_query($query, $db_con);
                                    if (!$result) {
                                        echo "<p class='error'>Error: Database is not created</p>" . mysql_error();
                                    } else {
                                        echo "<p class='success'>Database jewellaryForU has been created successfully</p>";
                                    }
                                }

                                //Selecting database

                                $db = mysql_select_db("jewellaryForU", $db_con);
                                if ($db == false) {
                                    echo "<p class='error'>Error: Database jewellaryForU is not selected</p>" . mysql_error();
                                } else {
                                    echo "<p class='success'>Database jewellaryForU is selected successfully</p>";
                                }

                                //creating database tables

                                $query = "Drop table if exists users,products,orders";

                                $result = mysql_query($query, $db_con);

                                if (!$result) {
                                    die('Error :' . mysql_error());
                                } else {

                                    //creating users table.
                                    $query = "CREATE TABLE users
	(
		user_id int NOT NULL AUTO_INCREMENT,
		first_name varchar(15),
		last_name varchar(15),
		email varchar(100) NOT NULL,
		password varchar(100) NOT NULL,
		address varchar(100),
		user_type varchar(100),
		primary key(user_id)
	)";
                                    $result = mysql_query($query, $db_con);
                                    if (!$result) {
                                        echo "<p class='error'>Error: Table users has not been created</p>" . mysql_error();
                                    } else {
                                        echo "<p class='success'>Table users has been created successfully</p>";
                                    }

                                    //creating products table.

                                    $query = "CREATE TABLE products
	(
		product_id int not null Auto_Increment,
		product_name varchar(100),
		product_type varchar(200),
		product_image varchar(100),
		price int,
		product_description varchar(200),
		primary key(product_id)
		
	)";
                                    $result = mysql_query($query, $db_con);
                                    if (!$result) {
                                        echo "<p class='error'>Error: Table products has not been created</p>" . mysql_error();
                                    } else {
                                        echo "<p class='success'>Table products has been created successfully</p>";
                                    }

                                    //creating orders table.

                                    $query = "CREATE TABLE orders
	(
		order_id int not null Auto_Increment,
		email varchar(100),
		product_id int,
		quantity int,
		total_price float(10),
		orderStatus varchar(100),
		primary key(order_id)
		
	)";
                                    $result = mysql_query($query, $db_con);
                                    if (!$result) {
                                        echo "<p class='error'>Error: Table orders has not been created</p>" . mysql_error();
                                    } else {
                                        echo "<p class='success'>Table orders has been created successfully</p>";
                                        echo "To log in as admin,  click on this <a href = '../../admin/admin_login_page.php'>link</a>";
                                    }
                                }
                                ?>
                            </p>
                        </div>						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>