<?php

//crate connection with localhost

$con = mysql_connect("localhost", "root", "");

if ($con == false) {

    die("could not connect" . mysql_error());
} else {

    //select the database on which all queries will carry out

    $db = mysql_select_db("jewellaryForU", $con);

    if ($db == false) {
        die("Error: Database jewellaryForU is not selected" . mysql_error());
    }
}
?>