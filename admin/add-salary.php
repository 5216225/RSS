<?php 
    error_reporting(0);
    include  'include/config.php';
    if(isset($_POST['Submit'])){
        $Department = $_POST['Department'];
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $AllowanceSalary = $_POST['AllowanceSalary'];
        $totalsalary = $_POST['totalsalary'];

        $sql="INSERT INTO tbladdsalary (Department, empid, salary, allowancesalary, total) 
        Values(:Department,:name,:salary,:AllowanceSalary,:totalsalary)";
        
        $query = $dbh -> prepare($sql);

        $query->bindParam(':Department',$Department,PDO::PARAM_STR);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':salary',$salary,PDO::PARAM_STR);
        $query->bindParam(':AllowanceSalary',$AllowanceSalary,PDO::PARAM_STR);
        $query->bindParam(':totalsalary',$totalsalary,PDO::PARAM_STR);
        $query -> execute();
        $lastInsertId = $dbh->lastInsertId();
      
        if($lastInsertId>0){
            $msg= "Salary Added Successfully";
        }
        else {
            $errormsg= "Data not inserted successfully";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS | Add Salary</title>
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
                <h2 align="center">Add Salary</h2>
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
                    <form class="row" method="post">

                        <div class="form-group col-md-6">
                            <label class="control-label">Department</label>
                            <select name="Department" id="Department" class="form-control" onChange="getdistrict(this.value);">
                                <option value="NA">--select--</option>
                                <?php 
                                    $stmt = $dbh->prepare("SELECT * FROM tbldepartment ORDER BY DepartmentName");
                                    $stmt->execute();
                                    $departList = $stmt->fetchAll();
                                    foreach($departList as $departname){
                                        echo "<option value='".$departname['id']."'>".$departname['DepartmentName']."</option>";
                                    }
                                ?>
                            </select>
                            <span style="color:red;"><?php echo $deperrormsg;?></span>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="control-label">Name</label>
                            <select name="name" id="name" class="form-control">
                                <option value="">--Select--</option>
                            </select>   
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Salary</label>
                            <input type="number" name="salary" id="salary" placeholder="Enter Salary" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Allowance Salary</label>
                            <input type="number"  name="AllowanceSalary" id="AllowanceSalary" placeholder="Enter Allowance Salary" class="form-control">  
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Total</label>
                            <input type="text"  name="totalsalary" id="totalsalary" placeholder="Total Salary" class="form-control" readonly>  
                        </div>

                        <div class="form-group col-md-4 align-self-end">
                            <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
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

<!-- Script -->
<script>
    function getdistrict(val) {
        $.ajax({
            type: "POST",
            url: "ajaxfile.php",
            data:'Department='+val,
            success: function(data){
                $("#name").html(data);
            }
        });
    }
</script>

<script>
    $(function(){
        $('#salary, #AllowanceSalary').keyup(function(){
            var value1 = parseFloat($('#salary').val()) || 0;
            var value2 = parseFloat($('#AllowanceSalary').val()) || 0;
            $('#totalsalary').val(value1 + value2);
        });
    });
</script>
