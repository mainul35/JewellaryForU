<?php

session_start();
session_destroy();
header("location:../../page/user_login_page.php");
?>