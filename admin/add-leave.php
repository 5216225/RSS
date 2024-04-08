<?php 
    error_reporting(0);
    include  'include/config.php';
    if(isset($_POST['submit'])){
        $LeaveName = $_POST['LeaveName'];
        $sql="INSERT INTO tblleavetype (leaveType) Values(:LeaveName)";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':LeaveName',$LeaveName,PDO::PARAM_STR);
        $query -> execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId>0){
            $msg= "Leave Name Added Successfully";
        }
        else {
            $errormsg= "Data not inserted successfully";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Add Leave</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 40px;
            max-width: 400px;
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
        <div class="container">
            <div class="card">
                <h2 align="center">Add Leave Type</h2>
                <hr />
                
                <!---Success Message--->  
                <?php if($msg){ ?>
                <div class="alert alert-success" role="alert">
                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                </div>
                <?php } ?>
                <!---Error Message--->
                <?php if($errormsg){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($errormsg);?>
                </div>
                <?php } ?>
                <div class="tile-body">
                    <form method="post">
                        <div class="form-group">
                            <label class="control-label">Leave Type</label>
                            <input class="form-control" name="LeaveName" id="LeaveName" type="text" placeholder="Enter Leave Type">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
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
    <script type="text/javascript" src="j../s/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
</body>
</html>
