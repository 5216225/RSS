<?php 
    error_reporting(0);
    include  'include/config.php';
    if(isset($_POST['submit'])){
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        $sql="INSERT INTO tblshifts (start_time, end_time) Values(:start_time, :end_time)";

        $query = $dbh -> prepare($sql);
        $query->bindParam(':start_time',$start_time,PDO::PARAM_STR);
        $query->bindParam(':end_time',$end_time,PDO::PARAM_STR);
        $query -> execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId>0){
            $msg= "Shift Added Successfully";
        }
        else {
            $errormsg= "Data not inserted successfully";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Add Shift</title>
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
        .form-group input[type="datetime-local"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            transition: border-color 0.3s ease;
        }
        .form-group input[type="datetime-local"]:focus {
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
                <h2 align="center">Add Shift</h2>
                <hr />
                
                <!---Success Message--->
                <?php if($msg){ ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success:</strong> <?php echo htmlentities($msg);?>
                </div>
                <?php } ?>
                <!---Error Message--->
                <?php if($errormsg){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Error:</strong> <?php echo htmlentities($errormsg);?>
                </div>
                <?php } ?>
                
                <div class="tile-body">
                    <form method="post">
                        <div class="form-group">
                            <label class="control-label">Start Time</label>
                            <input class="form-control" type="datetime-local" id="start_time" name="start_time" value="" min="2023-12-31T00:00" max="2050-06-14T00:00" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">End Time</label>
                            <input class="form-control" type="datetime-local" id="end_time" name="end_time" value="" min="2023-12-31T00:00" max="2050-06-14T00:00" />
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
</body>
</html>
