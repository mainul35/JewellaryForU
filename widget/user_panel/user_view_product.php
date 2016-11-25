<?php
require('../../core/database/connect.php');
include '../../essentials/converter/converter.php';
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
        <title>Product||JeweleryForU</title>
        <!-- Bootstrap Styles-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FontAwesome Styles-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Morris Chart Styles-->

        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <link href="assets/css/main.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- TABLE STYLES-->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                            <a href="user_home.php"><i class="fa fa-heart-o"></i> Home</a>
                        </li>

                        <li>
                            <a class="active-menu" href="user_view_product.php"><i class="fa fa-sitemap"></i> All Products</a>
                        </li>
                        <li>
                            <a href="my_order.php"><i class="fa fa-bar-chart-o"></i> My Order</a>
                        </li>
                        <li class="active">
                            Choose Currency
                            <ul style="list-style-type:none;">
                                <li ><a style="color: #c9c;" href="user_view_product.php?currency_type=GBP">Pound</a></li>
                                <li ><a style="color: #c9c;" href="user_view_product.php?currency_type=USD">US Dollar</a></li>
                                <li ><a style="color: #c9c;" href="user_view_product.php?currency_type=EUR">Euro</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                Product Page
                            </h1>
                        </div>
                    </div> 
                    <!-- /. ROW  -->
                    <div class="row">

                        <?php
                        $viewSql = "SELECT * FROM products";
                        $myData = mysql_query($viewSql, $con);

                        if (!$myData) {
                            echo 'Not selected' . mysql_error();
                        } else {
                            while ($record = mysql_fetch_array($myData)) {

                                echo "<div class='col-md-4 col-sm-4'>";
                                echo "<div class='panel panel-info'>";
                                echo "<div class='panel-heading'>";
                                echo "<p>Name: " . $record['product_name'] . "</p>";
                                echo "<p>Type: " . $record['product_type'] . "</p>";
                                echo "</div>";
                                echo "<div class='panel-body'>";

                                $imageName = $record['product_image']
                                ?> 
                                <img src="<?php echo "../../core/images/" . $imageName; ?>" height="200" width="200"> 
                                    <?php
                                    echo "</div>";
                                    echo "<div class='panel-footer'>";
                                    
                                    if(isset($_GET['currency_type'])){
                                        $_SESSION['currency_type'] = $_GET['currency_type'];
//                                        echo $_GET['currency_type'];
                                        
                                        if($_SESSION['currency_type']=="EUR"){
                                            echo "<p class='price'><span style='color:#000;'>Price: " . convertCurrency($record['price'], $_SESSION['currency_type']) . " EUR</span></p>";
                                        }else if($_SESSION['currency_type']=="GBP"){
                                            echo "<p class='price'><span style='color:#000;'>Price: " . $record['price'] . " GBP</span></p>";
                                        }else if($_SESSION['currency_type']=="USD"){
                                            echo "<p class='price'><span style='color:#000;'>Price: " . convertCurrency($record['price'], $_SESSION['currency_type']) . " USD</span></p>";
                                        }    
                                    }else{
//                                        echo $record['price'];
                                        $_SESSION['currency_type'] = "GBP";
                                        echo "<p class='price'><span style='color:#000;'>Price: " .$record['price'].  " GBP</span></p>";
                                    }
                                    
                                    echo "<p class='des'>" . $record['product_description'] . "</p>";

                                    echo "<div class='input_group'>";
                                    echo "<a class='btn btn-primary' href='addToCart_generate.php?action=add&id=$record[product_id]'><i class='fa fa-edit'></i>Add To Cart</a> ";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }

                            mysql_close($con);
                            ?>
                    </div>
                </div>
            </div>

        </div>

        </div>

        <!-- /. ROW  -->

        </div>
        <footer><p>All right reserved. JeweleryForU</a></p></footer>
        </div>
        <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <!-- /. WRAPPER  -->
        <!-- JS Scripts-->
        <!-- jQuery Js -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- Bootstrap Js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Metis Menu Js -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- DATA TABLE SCRIPTS -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>


    </body>
</html>
