<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen($_SESSION["adminid"])==1){   
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS - Admin Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            overflow-y: hidden;
        }

        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard-content {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 20px;
            animation: fadeInUp 0.5s ease forwards;
            margin-bottom: 500px;
        }

        .dashboard-content h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .dashboard-content .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .widget-small {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            animation: fadeInUp 0.5s ease forwards;
        }

        .widget-small:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .widget-small .info {
            text-align: center;
        }

        .widget-small h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        .widget-small p {
            font-size: 1.2rem;
            color: #666;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .animated-icon {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="app sidebar-mini">
<!-- Navbar-->
<?php include 'include/header.php'; ?>

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<?php include 'include/sidebar.php'; ?>

<main class="app-content">
    <!-- Dashboard container -->
    <div class="dashboard-container">
        <div class="dashboard-content">
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>

            <div class="row">
                <?php
                $query=$dbh->prepare("SELECT id FROM tblemployee");
                $query->execute();
                $regemp=$query->rowCount();
                ?>

                <div class="col-md-4">
                    <div class="widget-small primary">
                        <i class="fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4>Registered Employees</h4>
                            <p style="color:white;"><b><?php echo $regemp; ?></b></p>
                        </div>
                    </div>
                </div>

                <?php
                $ret=$dbh->prepare("SELECT id FROM tbldepartment");
                $ret->execute();
                $listeddept=$ret->rowCount();
                ?>

                <div class="col-md-4">
                    <div class="widget-small warning">
                        <i class="fa fa-files-o fa-3x"></i>
                        <div class="info">
                            <h4>Listed Departments</h4>
                            <p style="color:white;"><b><?php echo $listeddept; ?></b></p>
                        </div>
                    </div>
                </div>

                <?php
                $sql=$dbh->prepare("SELECT id FROM tblleavetype");
                $sql->execute();
                $listedleavetype=$sql->rowCount();
                ?>

                <div class="col-md-4">
                    <div class="widget-small danger">
                        <i class="fa fa-star fa-3x"></i>
                        <div class="info">
                            <h4>Listed Leave Type</h4>
                            <p style="color:white;"><b><?php echo $listedleavetype; ?></b></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-------------------------------->
            <hr />
            <h3 align="center">Leaves Details </h3>
            <hr />

            <div class="row">
                <?php
                $query=$dbh->prepare("SELECT id FROM tblleave");
                $query->execute();
                $totalleaves=$query->rowCount();
                ?>

                <div class="col-md-6">
                    <div class="widget-small info">
                        <i class="fa fa-files-o fa-3x"></i>
                        <div class="info">
                            <h4>Leaves Applied</h4>
                            <p style="color:white;"><b><?php echo $totalleaves; ?></b></p>
                        </div>
                    </div>
                </div>

                <?php
                $ret=$dbh->prepare("SELECT id FROM tblleave where status='pending'");
                $ret->execute();
                $newleaves=$ret->rowCount();
                ?>

                <div class="col-md-6">
                    <div class="widget-small warning">
                        <i class="fa fa-file fa-3x"></i>
                        <div class="info">
                            <h4>New Leave Requests</h4>
                            <p style="color:white;"><b><?php echo $newleaves; ?></b></p>
                        </div>
                    </div>
                </div>

                <?php
                $sql=$dbh->prepare("SELECT id FROM tblleave where status='Reject'");
                $sql->execute();
                $rejectedleaves=$sql->rowCount();
                ?>

                <div class="col-md-6">
                    <div class="widget-small danger">
                        <i class="fa fa-file fa-3x"></i>
                        <div class="info">
                            <h4>Rejected Leave Requests</h4>
                            <p style="color:white;"><b><?php echo $rejectedleaves; ?></b></p>
                        </div>
                    </div>
                </div>

                <?php
                $sql=$dbh->prepare("SELECT id FROM tblleave where status='Approved'");
                $sql->execute();
                $approvedleaves=$sql->rowCount();
                ?>

                <div class="col-md-6">
                    <div class="widget-small primary">
                        <i class="fa fa-file fa-3x"></i>
                        <div class="info">
                            <h4>Approved Leave Requests</h4>
                            <p style="color:white;"><b><?php echo $approvedleaves; ?></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Essential javascripts for application to work-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/plugins/pace.min.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../js/plugins/chart.js"></script>
</body>
</html>
