<?php 
error_reporting(0);
include 'include/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Leave Report</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .tile {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }
        .tile-title {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .table thead th {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f0f0;
        }
        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            animation: fadeInUp 0.5s ease forwards;
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
        .form-group input,
        .form-group textarea,
        .form-group select {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
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
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="tile">
                    <h3 class="tile-title">Leave B/w Dates Report</h3>
                    <div class="tile-body">
                        <div class="form-container">
                            <form method="post">
                                <div class="form-group">
                                    <label class="control-label">From Date</label>
                                    <input class="form-control" type="date" name="fdate" id="fdate" placeholder="Enter From Date">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">To Date</label>
                                    <input class="form-control" type="date" name="todate" id="todate" placeholder="Enter To Date">
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(isset($_POST['Submit'])) {
            $fdate=$_POST['fdate'];
            $tdate=$_POST['todate'];
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 align="center">Leave Report from <?php echo date("d-m-Y", strtotime($fdate)); ?> To <?php echo date("d-m-Y", strtotime($tdate)); ?></h2>
                        <hr />
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Emp ID</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th> 
                                    <th>Posting Date</th> 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="SELECT tblleave.id, userID, EmpID, tblleave.LeaveType, FromDate, Todate, Description, status, 
                                adminremarks, tblleave.Create_date,tblleavetype.leaveType as leavetypss FROM tblleave
                                join tblleavetype on tblleave.LeaveType=tblleavetype.id
                                where date(tblleave.Create_date) between '$fdate' and '$tdate'";

                                $query= $dbh->prepare($sql);                  
                                $query-> execute();
                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query -> rowCount() > 0){
                                    foreach($results as $result){
                                ?>
                                <tr>
                                    <td><?php echo($cnt);?></td>
                                    <td><?php echo htmlentities($result->EmpID);?></td>
                                    <td><?php echo htmlentities($result->leavetypss);?></td>
                                    <td><?php echo htmlentities($result->FromDate);?></td>
                                    <td><?php echo htmlentities($result->Todate);?></td>
                                    <td><?php echo htmlentities($result->Create_date);?></td>
                                    <td>
                                        <?php 
                                        $statuss=$result->status;
                                        if ($statuss=="Pending"):
                                            echo '<span class="btn btn-warning">Not updated yet</span>';
                                        endif; 
                                        ?>
                                        <?php 
                                        if ($statuss=="Approved"):
                                            echo '<span class="btn btn-success">Approved</span>';
                                        endif;

                                        if ($statuss=="Reject"):
                                            echo '<span class="btn btn-danger">Reject</span>';
                                        endif;
                                        ?>
                                    </td>
                                    <td><a href="details-leave.php?leaveid=<?php echo htmlentities($result->id);?>" class="waves-effect waves-light btn btn-primary m-b-xs"  > View Details</a></td>
                                </tr>
                                <?php  $cnt=$cnt+1; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </main>

    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/plugins/pace.min
