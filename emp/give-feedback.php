<?php 
  session_start();
  error_reporting(0);
  require_once('include/config.php');
  if(strlen($_SESSION["Empid"])==0){   
    header('location:index.php');
  }
  else{
    if(isset($_POST['Submit'])){
      $userID=$_SESSION['id'];
      $Empid=$_SESSION['Empid'];
      $Description=$_POST['Description'];

      $sql="INSERT INTO tblfeedback(userID,EmpID,Description) VALUES(:userID,:Empid,:Description)";
      $query = $dbh->prepare($sql);

      $query->bindParam(':userID',$userID,PDO::PARAM_STR);
      $query->bindParam(':Empid',$Empid,PDO::PARAM_STR);
      $query->bindParam(':Description',$Description,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      
      if($lastInsertId>0){
        echo "<script>alert('Feedback given Successfully');</script>";
        echo "<script>window.location.href='feedback-history.php'</script>";
      }
      else {
        echo "<script>alert('Something went wrong please try again.');</script>";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>RSS | Give Feedback</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }
    .app-content {
      padding: 30px;
    }
    .tile {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      animation: fadeInUp 1s ease-in-out;
    }
    h2 {
      margin-bottom: 30px;
      color: #333;
      text-align: center;
      animation: slideInDown 1s ease-in-out;
    }
    textarea {
      resize: none;
      border-radius: 8px;
      border: 1px solid #ced4da;
      padding: 10px;
      transition: border-color 0.3s ease;
    }
    textarea:focus {
      border-color: #007bff;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .btn-primary:active,
    .btn-primary:focus {
      background-color: #0056b3 !important;
      border-color: #0056b3 !important;
      box-shadow: none !important;
    }
    .btn-primary:active {
      transform: translateY(1px);
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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="tile">
          <h2 class="animate__animated animate__bounceIn">Give Feedback</h2>
          <form method="post">
            <div class="form-group">
              <textarea name="Description" id="Description" class="form-control animate__animated animate__fadeIn" rows="5" placeholder="Enter your feedback" required></textarea> 
            </div>
            <div class="form-group text-center animate__animated animate__fadeInUp">
              <input type="submit" name="Submit" class="btn btn-primary btn-block" value="Submit">
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
  <!-- Animate.css -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
</body>
</html>
<?php } ?>
