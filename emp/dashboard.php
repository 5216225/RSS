<?php 
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen($_SESSION["Empid"]) == 0){   
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Fancy styling */
        .widget-small {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .widget-small:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .widget-small .info a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .widget-small:hover .info a {
            color: #007bff;
        }
        .widget-small h4 {
            margin-top: 15px;
            margin-bottom: 5px;
            font-size: 24px;
            transition: color 0.3s ease;
        }
        .widget-small:hover h4 {
            color: #007bff;
        }
        .widget-small p {
            margin-bottom: 15px;
            font-size: 18px;
        }
        /* Half width for the widget */
        .half-width {
            width: 50%;
        }
    </style>
</head>
<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="row">         
            <div class="col-md-6 col-lg-12">
                <div class="widget-small primary coloured-icon half-width">
                    <i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <a href="my-profile.php">
                            <h4>Welcome Back</h4>
                            <p><b><?php echo $_SESSION['name'];?> (<?php echo $_SESSION['Empid'];?>)</b></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>  

<!-- Essential javascripts for application to work-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="../js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sampleTable').DataTable();
    });
</script>
</body>
</html>
<?php } ?>
