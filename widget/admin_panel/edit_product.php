<?php
session_start();
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
        <title>Edit Product | Admin Panel</title>
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
                                    <a href="add_product.php">Add Product</a>
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
                                Edit Product Page
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="admin_home.php">Home</a></li>
                                <li><a href="view_product.php">Product</a></li>
                                <li><a href="add_product.php">Add Product</a></li>
                                <li><a href="edit_product.php">Edit Product</a></li>

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
                                                    Edit Product
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">

                                                        <!--    Start PHP Code for Add  -->								
                                                        <?php
                                                        require('../../core/database/connect.php');
                                                        error_reporting(0);

                                                        if (!isset($_POST['update_submit'])) {

                                                            $id = $_GET['id'];
                                                            $sql = "SELECT * FROM products WHERE product_id = $id";
                                                            $myData = mysql_query($sql);
                                                            if (!$myData) {
                                                                echo "query Not right" . mysql_error();
                                                            } else {
                                                                $row = mysql_fetch_array($myData);
                                                            }
                                                        }
                                                        ?>
                                                        <table class="table">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <tr class="form-group">
                                                                    <td><label>Product Name</label></td>
                                                                    <td><input type="text" name="newP_name" class='form-control' placeholder='Enter Product Name' value="<?php echo $row['product_name']; ?>"/></td>
                                                                </tr>
                                                                <tr class='form-group'>
                                                                    <td><label>Product Type</label></td>
                                                                    <td><input type='text' name='newP_type' class='form-control' placeholder='Enter Product Type' value="<?php echo $row['product_type']; ?>"></td>
                                                                </tr>
                                                                <tr class='form-group'>
                                                                    <td><label>Add Image</label></td>
                                                                    <td><input type='file' name='newP_image' value="<?php echo $row['product_image']; ?>"></td>
                                                                </tr>
                                                                <tr class='form-group'>
                                                                    <td><label>Product Price</label></td>
                                                                    <td><input type='text' name='newP_price' class='form-control' placeholder='Enter Product Price' value="<?php echo $row['price']; ?>"></td>
                                                                </tr>
                                                                <tr class='form-group'>
                                                                    <td><label>Product Description</label></td>
                                                                    <td><textarea class='form-control' name='newP_description' rows='3' placeholder='Enter Product Description' ><?php echo $row['product_description']; ?></textarea></td>
                                                                </tr>

                                                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                                                                <td><button type='submit' name='update_submit' class='btn btn-primary'>Update</button></td>
                                                                <td><button type='reset' name='clear' class='btn btn-default'>Reset</button></td>
                                                            </form>
                                                        </table>
                                                        <?php
                                                        if (isset($_POST['update_submit'])) {

                                                            /* if(isset($_POST['newP_image'])){

                                                              //Image
                                                              $imageFile_tmp = $_FILES['newP_image']['tmp_name'];
                                                              $imageFile_name = $_FILES['newP_image']['name'];
                                                              $imageFile_type = $_FILES["newP_image"]["type"];
                                                              $imageFile_path = "../core/images/".$imageFile_name;

                                                              move_uploaded_file($imageFile_tmp, $imageFile_path);

                                                              }else{

                                                              } */

                                                            $updateQuery = "UPDATE products SET product_name='$_POST[newP_name]', product_type='$_POST[newP_type]', price='$_POST[newP_price]', product_description='$_POST[newP_description]' WHERE product_id='$_POST[id]'";
                                                            $result = mysql_query($updateQuery);

                                                            echo "<script type='text/javascript'>alert('You have successfully edit the product'); location.href = 'view_product.php';</script>";

                                                            if (!$result) {
                                                                echo 'Query not right' . mysql_error();
                                                            }
                                                        }
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
