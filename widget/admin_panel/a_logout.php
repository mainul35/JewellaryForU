<?php

session_start();
session_destroy();
header("location:../../admin/admin_login_page.php");
?>