<?php 
    session_start();
    error_reporting(0);
    require_once('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Approved Leave Requests</title>
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
        }
        .container {
            margin-top: 50px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 30px;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .table th, .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            transition: background-color 0.3s ease;
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            text-align: left;
        }
        .table tbody tr:hover {
            background-color: #f0f0f0;
        }
        .btn {
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
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
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover">
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
                            join tblleavetype on tblleave.LeaveType=tblleavetype.id where status='Approved'";

                            $query= $dbh->prepare($sql);                  
                            $query-> execute();
                            $results = $query -> fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            
                            if($query -> rowCount() > 0){
                                foreach($results as $result){
                        ?>
                        <tr class="fadeInRow">
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
                            <td><a href="details-leave.php?leaveid=<?php echo htmlentities($result->id);?>" class="btn btn-primary"  > View Details</a></td>
                        </tr>
                        <?php  $cnt=$cnt+1; } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Custom script for table row animation -->
    <script>
        $(document).ready(function() {
            $('.fadeInRow').each(function(i) {
                $(this).delay(200 * i).addClass('fadeIn');
            });
        });
    </script>
</body>
</html>
