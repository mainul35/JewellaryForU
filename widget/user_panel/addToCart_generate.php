<?php

require('../../core/database/connect.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../../page/user_login_page.php');
} else {

    $userEmail = $_SESSION['email'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1;
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "empty";
}

switch ($action) {
    case "add":
        if (isset($_SESSION['cart_item'][$id])) {
            $_SESSION['cart_item'][$id] ++;
        } else {
            $_SESSION['cart_item'][$id] = 1;
        }
        break;
}
if (isset($_GET['id'])) {

    echo "<script type='text/Javascript'> alert('You have successfully order this product'); location.href = 'user_view_product.php'; </script>";
}
?>