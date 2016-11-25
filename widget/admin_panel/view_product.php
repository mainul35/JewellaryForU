<?php
session_start();
require '../../essentials/converter/converter.php';
if (!isset($_SESSION['email'])) {
    header('location:../../admin/admin_login_page.php');
} else {
    $userEmail = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>View Product | Admin Panel</title>
        <!-- Bootstrap Styles-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FontAwesome Styles-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Morris Chart Styles-->

        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- TABLE STYLES-->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="admin_home.php"><i class="fa fa-comments"></i> <strong>JeweleryForU</strong></a>
                </div>

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="username"><?php echo $userEmail ?></span>
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="a_logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="admin_home.php"><i class="fa fa-heart-o"></i> Home</a>
                        </li>

                        <li>
                            <a class="active-menu" href="view_product.php"><i class="fa fa-sitemap"></i> Products<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="active-menu" href="view_product.php">View Product</a>
                                </li>
                                <li>
                                    <a href="add_product.php">Add Product</a>
                                </li>


                            </ul>
                        </li>
                        <li>
                            <a href="view_order.php"><i class="fa fa-bar-chart-o"></i> Order Details</a>
                        </li>
                        <li class="active">
                            Choose Currency
                            <ul style="list-style-type:none;">
                                <li ><a style="color: #c9c;" href="view_product.php?currency_type=GBP">Pound</a></li>
                                <li ><a style="color: #c9c;" href="view_product.php?currency_type=USD">US Dollar</a></li>
                                <li ><a style="color: #c9c;" href="view_product.php?currency_type=EUR">Euro</a></li>
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
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="admin_home.php">Home</a></li>
                                <li><a href="view_product.php">Product</a></li>

                            </ol>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    You can View All product in here
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">

                                        <?php
                                        require('../../core/database/connect.php');


                                        $viewSql = "SELECT * FROM products";
                                        $myData = mysql_query($viewSql, $con);


                                        //Delete products
                                        if (isset($_POST['delete'])) {

                                            $deleteQuery = "DELETE FROM products WHERE product_id='$_POST[hidden]'";
                                            $result = mysql_query($deleteQuery, $con);

                                            if (!$result) {
                                                echo 'Query not right' . mysql_error();
                                            } else {
                                                echo "<script type='text/javascript'>alert('You have successfully delete the product'); location.href = 'view_product.php';</script>";
                                            }
                                        };

                                        //table

                                        echo "<table class='table table-striped table-bordered table-hover'>
        <tr>
			<th>Product ID</th>
			<th>Product Name</th>
			<th>Product Type</th>
			<th>Product Image</th>
			<th>Product Price</th>
			<th>Product Description</th>
        </tr>";
                                        if (!$myData) {
                                            echo 'Not selected' . mysql_error();
                                        } else {
                                            while ($record = mysql_fetch_array($myData)) {

                                                //Table Start
                                                echo "<form action='view_product.php' method='post'>";
                                                echo "<tr>";
                                                echo "<td>" . $record['product_id'] . "</td>";
                                                echo "<td>" . $record['product_name'] . "</td>";
                                                echo "<td>" . $record['product_type'] . "</td>";

                                                $imageName = $record['product_image'];

                                                echo "<td>";
                                                ?> <img src="<?php echo "../../core/images/" . $imageName; ?>" height="80" width="80"> <?php
                                                    echo "</td>";
                                                    
                                                    if (isset($_GET['currency_type'])) {
                                                        $_SESSION['currency_type'] = $_GET['currency_type'];
                                                        if ($_SESSION['currency_type'] == "EUR") {
                                                            echo "<td><p class='price'><span style='color:#000;'>" . convertCurrency($record['price'], $_SESSION['currency_type']) . " EUR</span></p></td>";
                                                        } else if ($_SESSION['currency_type'] == "GBP") {
                                                            echo "<td><p class='price'><span style='color:#000;'>" . $record['price'] . " GBP</span></p></td>";
                                                        } else if ($_SESSION['currency_type'] == "USD") {
                                                            echo "<td><p class='price'><span style='color:#000;'>" . convertCurrency($record['price'], $_SESSION['currency_type']) . " USD</span></p></td>";
                                                        }
                                                    } else {
                                                        echo "<td><p class='price'><span style='color:#000;'>Price: " . $record['price'] . " GBP</span></p></td>";
                                                    }
//                                                    echo "<td>" . $record['price'] . "</td>";
                                                    echo "<td>" . $record['product_description'] . "</td>";
                                                    
                                                    echo "<td>" . "<input type='hidden' name='hidden' value=" . $record['product_id'] . " </td>";

                                                    echo "<td>" . "<a class='btn btn-warning' href='edit_product.php?id=$record[product_id]'><i class='fa fa-edit'></i>Edit</a> " . "</td>";
                                                    echo "<td>" . "<input class='btn btn-danger' type='submit' name='delete' value='Delete'/> " . "</td>";
                                                    echo "</tr>";
                                                    echo "</form>";

                                                    //End Table
                                                }
                                                echo "</table>";
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
