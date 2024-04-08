<?php 
  error_reporting(0);
  include 'include/config.php';
  if(isset($_POST['submit'])){
    $DepartmentName = $_POST['DepartmentName'];
    $sql="INSERT INTO tbldepartment (DepartmentName) VALUES (:DepartmentName)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':DepartmentName', $DepartmentName, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId > 0){
      $msg = "Department Name Added Successfully";
    }
    else {
      $errormsg = "Failed to add Department Name";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="RSS is a">
  <title>RSS | Add Department</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    /* Additional custom styles */
    body {
      background-color: #f3f4f6;
    }
    .container {
      margin-top: 50px;
      padding: 0 20px;
    }
    .card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-header {
      background-color: #007bff;
      color: #fff;
      border-radius: 10px 10px 0 0;
      padding: 20px;
    }
    .card-header h2 {
      margin: 0;
    }
    .card-body {
      padding: 20px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 5px;
      border: 1px solid #ced4da;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #0056b3;
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
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header text-center">
              <h2>Add Department</h2>
            </div>
            <div class="card-body">
              <!-- Success Message -->
              <?php if($msg){ ?>
              <div class="alert alert-success" role="alert">
                <?php echo htmlentities($msg);?>
              </div>
              <?php } ?>
              <!-- Error Message -->
              <?php if($errormsg){ ?>
              <div class="alert alert-danger" role="alert">
                <?php echo htmlentities($errormsg);?>
              </div>
              <?php } ?>
              <!-- Department Form -->
              <form method="post">
                <div class="form-group">
                  <input class="form-control" name="DepartmentName" id="DepartmentName" type="text" placeholder="Enter Department Name" required>
                </div>
                <div class="form-group text-center">
                  <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                </div>
              </form>
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
</body>
</html>
