<?php
  session_start();
  error_reporting(0);
  require_once('include/config.php');
  if(strlen($_SESSION["adminid"])==1){   
    header('location:index.php');
  }
  else{
    // Code for change password 
    if(isset($_POST['submit'])){
      $password=md5($_POST['password']);
      $newpassword=md5($_POST['newpassword']);
      $confirmpassword=md5($_POST['confirmpassword']);
      $email=$_SESSION['email'];
      
      if($newpassword !== $confirmpassword){
        $error="New Password and Confirm Password do not match.";
      } else {
        $sql ="SELECT password FROM tbladmin WHERE email=:email and password=:password";
        $query= $dbh->prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        
        if($query->rowCount() > 0){
          $con="UPDATE tbladmin SET password=:newpassword WHERE email=:email";
          $chngpwd1 = $dbh->prepare($con);
          $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
          $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
          $chngpwd1->execute();
          $msg="Your Password has been successfully changed.";
        } else {
          $error="Your current password is not valid."; 
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RSS | Change Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .tile {
            margin: auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            background-color: #fff;
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

        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
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
            <h2 align="center">Change Password</h2>
            <hr />
            <?php if($error){ ?><div class="errorWrap"><strong>Error:</strong> <?php echo htmlentities($error); ?> </div><?php } 
            else if($msg){ ?><div class="succWrap"><strong>Success:</strong> <?php echo htmlentities($msg); ?> </div><?php } ?>
            
            <div class="tile-body">
              <form class="row" name="chngpwd" method="post" onsubmit="return valid();">

                <div class="form-group col-md-12">
                  <label class="control-label">Old Password</label>
                  <input type="password" name="password" id="password" placeholder="Old Password" class="form-control" autocomplete="off" required>
                </div>

                <div class="form-group col-md-12">
                  <label class="control-label">New Password</label>
                  <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="New Password" autocomplete="off" required>
                </div>

                <div class="form-group col-md-12">
                  <label class="control-label">Confirm Password</label>
                  <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" autocomplete="off" class="form-control" required>
                </div>
                 
                <div class="form-group col-md-4 align-self-end">
                  <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                </div>

              </form>
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
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      function valid(){
        if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value){
          alert("New Password and Confirm Password do not match!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        return true;
      }
    </script>
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
    </style>
  </body>
</html>
<?php } ?>
