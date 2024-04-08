<?php 
    //error_reporting(0);
    include 'include/config.php';
    $levid = $_GET['leaveid'];
    if (isset($_POST['submit'])) {
        $leaveID = $_POST['leaveID']; 
        $leavestatus = $_POST['leavestatus'];
        $remarks = $_POST['remarks'];

        $sql = "UPDATE tblleave SET status=:leavestatus, adminremarks=:remarks WHERE id=:leaveID";
        $query = $dbh->prepare($sql);
        $query->bindParam(':leaveID', $leaveID, PDO::PARAM_STR);
        $query->bindParam(':leavestatus', $leavestatus, PDO::PARAM_STR);
        $query->bindParam(':remarks', $remarks, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Leave status updated Successfully');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Leave Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .modal-dialog {
            max-width: 500px;
        }
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            color: #333;
        }
        .modal-body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
        }
        /* Add animation for modal */
        .modal.fade .modal-dialog {
            transform: translate(0, -100%);
            transition: transform 0.3s ease-in-out;
        }
        .modal.fade.show .modal-dialog {
            transform: translate(0, 0);
        }
        /* Additional styles for enhanced appearance */
        .tile {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: box-shadow 0.3s ease-in-out;
        }
        .tile:hover {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }
        .tile-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            vertical-align: top;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .btn {
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
        }
        .btn:hover {
            background-color: #138496;
            border-color: #138496;
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
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <?php    
                            $sql = "SELECT tblleave.id,tblleave.EmpID,tblleavetype.leaveType,FromDate,Todate,Description,tblleave.status,adminremarks,
                                    fname,lname,tbldepartment.DepartmentName,fname,lname,email,mobile,country,state,city,address,photo,dob,date_of_joining FROM tblleave
                                    LEFT JOIN tblemployee ON tblleave.EmpID=tblemployee.EmpId
                                    LEFT JOIN tblleavetype ON tblleave.LeaveType=tblleavetype.id
                                    LEFT JOIN tbldepartment ON tblemployee.department_name=tbldepartment.id
                                    WHERE tblleave.id=:levid";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':levid', $levid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                        ?>
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th colspan="4" class="tile-title">Personal Info</th>
                                </tr>
                                <tr>
                                  <th>EmpId</th> <td><?php echo $result->EmpID;?></td>
                                  <th>Photo</th> <td><img src="<?php echo $result->photo;?>"width=150px; height="130px;"></td>
                                </tr>

                                <tr>
                                  <th>First Name</th> <td><?php echo $result->fname;?></td>
                                  <th>Last Name</th> <td><?php echo $result->lname;?></td>
                                </tr>

                                <tr>
                                  <th>Department</th><td><?php echo $result->DepartmentName;?></td>
                                  <th>Email</th><td><?php echo $result->email;?></td>
                                </tr>

                                <tr>
                                  <th>DOB</th> <td><?php echo $result->dob;?></td>
                                  <th>Date Of Joining</th> <td><?php echo $result->date_of_joining;?></td>
                                </tr>

                                <tr>
                                  <th>Address</th> <td><?php echo $result->address;?></td>
                                  <th>City</th> <td><?php echo $result->city;?></td>
                                </tr>

                                <tr>
                                  <th>State</th> <td><?php echo $result->state;?></td>
                                  <th>country</th> <td><?php echo $result->country;?></td>
                                </tr>

                                <tr>
                                  <th>Mobile</th> <td><?php echo $result->mobile;?></td>
                                </tr>

                                <tr>
                                  <th colspan="4" style="font-size:20px; color:blue;">Leave Related Info</th>
                                </tr>
    
                                <tr>
                                  <th>Leave Type</th> <td><?php echo $result->leaveType;?></td>
                                  <th>Status</th> <td><?php echo $result->status;?></td>
                                </tr>

                                <tr>
                                  <th>Leave From Date</th> <td><?php echo $result->FromDate;?></td>
                                  <th>Leave To Date</th> <td><?php echo $result->Todate;?></td>
                                </tr>

                                <tr>
                                  <th>Leave Description</th> <td colspan="3"><?php echo $result->Description;?></td>
                                </tr>
  
                                <tr>
                                  <th>Admin Remark</th> <td colspan="3"><?php echo $result->adminremarks;?></td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- Button to trigger modal -->
                        <?php 
                            $statuss = $result->status;
                            if ($statuss == 'Pending'):
                        ?>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Take Action</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="tile">
                                                    <h3 class="tile-title">Admin Remark</h3>
                                                    <div class="tile-body">
                                                        <form class="row" method="post">
                                                            <input type="hidden" name="leaveID" value="<?php echo $result->id;?>">
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label">Leave Status</label>
                                                                <select name="leavestatus" class="form-control">
                                                                    <option value="">--select--</option>
                                                                    <option value="Approved">Approved</option>
                                                                    <option value="Reject">Reject</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="control-label">Description</label>
                                                                <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group col-md-4 align-self-end">
                                                                <input type="Submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endif;
                            $cnt = $cnt + 1;
                        }
                    }
                    ?>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#sampleTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "info": true
        });
    });
</script>   
</body>
</html>
