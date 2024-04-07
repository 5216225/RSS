<?php 
  session_start();
  error_reporting(0);
  require_once('include/config.php');
  if(strlen( $_SESSION["Empid"])==0){   
    header('location:index.php');
  }
  else{
    if(isset($_POST['Submit'])){

      $userID=$_SESSION['id'];
      $Empid=$_SESSION['Empid'];
      $Description=$_POST['Description'];

      $sql="INSERT INTO tblfeedback(userID,EmpID,Description) Values(:userID,:Empid,:Description)";
      $query = $dbh -> prepare($sql);

      $query->bindParam(':userID',$userID,PDO::PARAM_STR);
      $query->bindParam(':Empid',$Empid,PDO::PARAM_STR);
      $query->bindParam(':Description',$Description,PDO::PARAM_STR);
      $query -> execute();
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <h2 align="center">Give Feedback</h2>
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
              <strong>Oh snap!</strong> <?php echo htmlentities($errormsg);?></div>
              <?php } ?>
              <div class="tile-body">
                <form class="row" method="post">
                  <div class="form-group col-md-12">
                    <label class="control-label">Description</label>
                    <textarea name="Description" id="Description" placeholder="Enter your Description" class="form-control" autocomplete="offs"></textarea> 
                  </div>

                  <div class="form-group col-md-4 align-self-end">
                    <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
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
<?php } ?>
<!-- Script -->
<script>
  function getdistrict(val) {
    $.ajax({
      type: "POST",
      url: "ajaxfile.php",
      data:'category='+val,
      success: function(data){
        $("#package").html(data);
      }
    });
  }
</script>