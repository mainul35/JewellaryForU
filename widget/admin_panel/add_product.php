<?php
session_start();
error_reporting(0);
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
        <title>Add Product | Admin Panel</title>
        <!-- Bootstrap Styles-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FontAwesome Styles-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <!-- Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
                                    <a href="view_product.php">View Product</a>
                                </li>
                                <li>
                                    <a class="active-menu" href="add_product.php">Add Product</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o"></i> Order Details</a>
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
                                Add Product Page
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="admin_home.php">Home</a></li>
                                <li><a href="view_product.php">Product</a></li>
                                <li><a href="add_product.php">Add Product</a></li>

                            </ol>
                        </div>
                    </div> 
                    <!-- /. ROW  -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Add Product
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">

                                                        <!--    Start PHP Code for Add  -->								
                                                        <?php
                                                        require('../../core/database/connect.php');

                                                        if (isset($_POST['add_submit'])) {
                                                            if (is_numeric($_POST[p_price])) {

                                                                //For image Add.

                                                                $imageFile_tmp = $_FILES['p_image']['tmp_name'];
                                                                $imageFile_name = $_FILES['p_image']['name'];
                                                                $imageFile_type = $_FILES["p_image"]["type"];
                                                                $imageFile_path = "../../core/images/" . $imageFile_name;

                                                                move_uploaded_file($imageFile_tmp, $imageFile_path);

                                                                $addQuery = "INSERT into products (product_name, product_type, product_image, price, product_description) VALUES ('$_POST[p_name]', '$_POST[p_type]', '$imageFile_name','$_POST[p_price]', '$_POST[p_description]')";
                                                                $result = mysql_query($addQuery, $con);

                                                                if (!$result) {
                                                                    echo 'Query not right' . mysql_error();
                                                                } else {
                                                                    echo "<script type='text/Javascript'>alert('You are successfully add this product'); location.href = 'add_product.php'</script>";
                                                                }
                                                            } else {
                                                                echo "<script type='text/Javascript'>alert('Price will be numeric'); location.href = 'add_product.php'</script>";
                                                            }
                                                        };

                                                        echo "<table class='table'>";
                                                        echo "<form action='add_product.php' method='post' enctype='multipart/form-data'>";
                                                        echo "<tr class='form-group'>";
                                                        echo "<td><label>Product Name</label></td>";
                                                        echo "<td><input type='text' name='p_name' class='form-control' placeholder='Enter Product Name'></td>";
                                                        echo "</tr>";
                                                        echo "<tr class='form-group'>";
                                                        echo "<td><label>Product Type</label></td>";
                                                        echo "<td><input type='text' name='p_type' class='form-control' placeholder='Enter Product Type'></td>";
                                                        echo "</tr>";
                                                        echo "<tr class='form-group'>";
                                                        echo "<td><label>Add Image</label></td>";
                                                        echo "<td><input type='file' name='p_image'></td>";
                                                        echo "</tr>";
                                                        echo "<tr class='form-group'>";
                                                        echo "<td><label>Product Price</label></td>";
                                                        echo "<td><input type='text' name='p_price' class='form-control' placeholder='Enter Product Price'></td>";
                                                        echo "</tr>";
                                                        echo "<tr class='form-group'>";
                                                        echo "<td><label>Product Description</label></td>";
                                                        echo "<td><textarea class='form-control' name='p_description' rows='3' placeholder='Enter Product Description'></textarea></td>";
                                                        echo "</tr>";

                                                        echo "<td><button type='submit' name='add_submit' class='btn btn-primary'>Add Product</button></td>";
                                                        echo "</form>";
                                                        echo "</table>";
                                                        mysql_close($con);
                                                        ?>
                                                        <!--  End  PHP  -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <footer><p>All right reserved. JweleryForU</p></footer>
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
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>


    </body>
</html>
