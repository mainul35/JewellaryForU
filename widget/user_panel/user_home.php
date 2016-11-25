﻿<?php
require('../../core/database/connect.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../../page/user_login_page.php');
} else {
    $userEmail = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>JeweleryForU User Panel</title>
        <!-- Bootstrap Styles-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FontAwesome Styles-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Morris Chart Styles-->
        <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="user_home.php"><i class="fa fa-comments"></i> <strong>JeweleryForU</strong></a>
                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="username"><?php echo $userEmail ?></span>
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="u_logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </nav>
            <!--/. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">

                        <li>
                            <a class="active-menu" href="user_home.php"><i class="fa fa-heart-o"></i> Home</a>
                        </li>

                        <li>
                            <a href="user_view_product.php"><i class="fa fa-sitemap"></i> All Products</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o"></i> My Order</a>
                        </li>
                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">


                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                Welcome To The JeweleryForU Shop
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="user_home.php">Home</a></li>
                            </ol>
                        </div>
                    </div>






                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <p>Here you can view all our products and order to purchase from the left navigation bar.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /. ROW  -->
                    </div>
                    <footer><p>All right reserved. JweleryForU Shop</p></footer>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- JS Scripts-->
        <!-- jQuery Js -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- Bootstrap Js -->
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Js -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- Morris Chart Js -->
        <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
        <script src="assets/js/morris/morris.js"></script>


        <script src="assets/js/easypiechart.js"></script>
        <script src="assets/js/easypiechart-data.js"></script>


        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>


    </body>

</html>