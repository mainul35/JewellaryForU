<?php
require('../../core/database/connect.php');
require '../../essentials/converter/converter.php';
session_start();
$_SESSION['products'] = 0;

if (!isset($_SESSION['email'])) {
    header('location:../../page/user_login_page.php');
} else {
    $userEmail = $_SESSION['email'];
}

// carts php codes
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

    case "remove":
        if (isset($_SESSION['cart_item'][$id])) {
            $_SESSION['cart_item'][$id] --;
        }
        if ($_SESSION['cart_item'][$id] == 0) {
            unset($_SESSION['cart_item'][$id]);
        }
        break;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>JeweleryForU Admin Panel</title>
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
                            <a href="user_home.php"><i class="fa fa-heart-o"></i> Home</a>
                        </li>

                        <li>
                            <a href="user_view_product.php"><i class="fa fa-sitemap"></i> All Products</a>
                        </li>
                        <li>
                            <a class="active-menu" href="my_order.php"><i class="fa fa-bar-chart-o"></i> My Order</a>
                        </li>
<!--                        <li class="active">
                            Choose Currency
                            <ul style="list-style-type:none;">
                                <li ><a style="color: #c9c;" href="my_order.php?currency_type=GBP">Pound</a></li>
                                <li ><a style="color: #c9c;" href="my_order.php?currency_type=USD">US Dollar</a></li>
                                <li ><a style="color: #c9c;" href="my_order.php?currency_type=EUR">Euro</a></li>
                            </ul>
                        </li>-->
                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">


                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">
                                You can View all your order in here
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="panel panel-default"> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr> 
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>total</th>

                                        </tr>
                                        <?php
// displaying products in cart
                                        if (isset($_SESSION['cart_item'])) {
                                            $total_cost = 0;
                                            foreach ($_SESSION['cart_item'] as $id => $q) {
                                                //product query
                                                $query = "Select * from products where product_id='$id'";
                                                $result = mysql_query($query);
                                                if (!$result) {
                                                    echo "Error Found: " . mysql_error();
                                                }
                                                $row_array = mysql_fetch_array($result);

                                                $product_id = $row_array['product_id'];
                                                $product_title = $row_array['product_type'];
                                                $product_price = $row_array['price'];
                                                $order_cost = $product_price * $q;
                                                $total_cost = $total_cost + $order_cost;

                                                echo "<tr>";
                                                echo "<td>$product_id</td>";
                                                echo "<td>$product_title</td>";
                                                echo "<td>$q</td>";
//                                                echo $product_price;
//                                                $grandTotal+=$order_cost;
                                                if($_SESSION['currency_type']!="GBP"){
                                                    echo "<td>".convertCurrency($product_price, $_SESSION['currency_type'])." ".$_SESSION['currency_type'] ."</td>";
                                                    echo "<td>".convertCurrency($order_cost, $_SESSION['currency_type'])." ".$_SESSION['currency_type'] ."</td>";                                                    
                                                }else{
                                                    echo "<td>".$product_price." ".$_SESSION['currency_type']."</td>";
                                                    echo "<td>".$order_cost." ".$_SESSION['currency_type'] ."</td>";
                                                }

                                                echo "<td class='col-sm-2'><a href='my_order.php?id=" . $id . "&action=remove'>Remove Quantity</a></td>";
                                                echo "</tr>";
                                            }
                                            echo "<tr>";
                                            echo "<td colspan='4' align='right'><strong>Grand total:-</strong> &nbsp; &nbsp; &nbsp; </td>";
                                            
                                            if($_SESSION['currency_type']!="GBP"){
                                                echo "<td class='first-row col-sm-2 back_color'><strong>".convertCurrency($total_cost, $_SESSION['currency_type'])." ".$_SESSION['currency_type'] ."</strong></td>";
                                            }else{
                                                echo "<td class='first-row col-sm-2 back_color'><strong>".$total_cost." ".$_SESSION['currency_type'] ."</strong></td>";
                                            }
                                            echo "</tr>";
                                        } else {
                                            echo "<strong>No products in your cart</strong>";
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="4"><a href="user_view_product.php" class="btn btn-primary">Continue Shopping</a></td>
                                            <?php
                                            echo "<form action='my_order.php' method='post'>";
                                            echo "<td><input class='btn btn-success' type='submit' name='submit' value='Order' /></td>";
                                            echo "</form>";

                                            if (isset($_POST['submit'])) {
                                                $result = mysql_query("INSERT INTO orders (email, product_id, quantity, total_price, orderStatus) VALUES('$userEmail', '$product_id', '$q' ,'$total_cost', 'pending')");
                                                if (!$result) {
                                                    echo "Error Found: " . mysql_error();
                                                } else {
                                                    unset($_SESSION['cart_item']);
                                                }
                                                echo "<script type='text/Javascript'> alert('Thank You very much for order product'); location.href = 'user_view_product.php'; </script>";
                                            }
                                            ?>

                                        </tr>
                                    </table>	
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