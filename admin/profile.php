<?php
  session_start();
  error_reporting(0);
  require_once('include/config.php');
  if(strlen( $_SESSION["adminid"])==0){   
    header('location:login.php');
  }
  else{
    if(isset($_POST['submit'])){
      $adminid=$_SESSION['adminid'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      $mobile=$_POST['mobile'];

      $sql="update tbladmin set name=:name,email=:email,mobile=:mobile where id=:adminid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':name',$name,PDO::PARAM_STR);
      $query->bindParam(':email',$email,PDO::PARAM_STR);
      $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
      $query->bindParam(':adminid',$adminid,PDO::PARAM_STR);
      $query->execute();
      //$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
      echo "<script>alert('Profile has been updated.');</script>";
      echo "<script> window.location.href =profile.php;</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
    <title>RSS | Profile</title>
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
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="tile">
              <h2 align="center">Profile</h2>
              <hr />            
              <div class="tile-body">
                <form class="row" method="post">
                  <?php 
                    $adminid=$_SESSION['adminid'];
                    $sql ="SELECT id, name,email,mobile from tbladmin where id=:adminid ";
                    $query= $dbh -> prepare($sql);
                    $query->bindParam(':adminid',$adminid, PDO::PARAM_STR);
                    $query-> execute();
                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0){
                      foreach($results as $result){ 
                  ?>

                  <div class="form-group col-md-12">
                    <label class="control-label">Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo $result->name;?>">
                  </div><br />

                  <div class="form-group col-md-12">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $result->email;?>" readonly>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label class="control-label">Mobile No</label>
                    <input class="form-control" type="text" name="mobile" id="mobile" placeholder="Enter your Mobile" value="<?php echo $result->mobile;?>">
                  </div>
                 
                  <div class="form-group col-md-4 align-self-end">
                    <input type="submit" id="submit" name="submit" value="Update" class="btn btn-primary">
                  </div>
                  <?php }} ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
  </body>
</html>
<?php } ?>

<style>
  .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #dd3d36;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  }
  .succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #5cb85c;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  }
</style>