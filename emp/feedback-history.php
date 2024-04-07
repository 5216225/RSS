<?php 
  session_start();
  error_reporting(0);
  require_once('include/config.php');
  if(strlen( $_SESSION["Empid"])==0){   
    header('location:index.php');
  }
  else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RSS | Feedback History</title>
    <meta charset="utf-8">
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
            <div class="tile-body">
              <h2 align="center">Feedback History</h2>
              <hr />
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Feedback.No</th>
                    <th>Description</th>
                    <th>Applied Date</th>
                  </tr>
                </thead>
              
                <?php
                  $EmpID=$_SESSION["Empid"];
                  $sql = "SELECT tblfeedback.id, Description, tblfeedback.Create_date FROM tblfeedback WHERE EmpID = :EmpID";      
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':EmpID',$EmpID, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0){
                    foreach($results as $result){
                ?>

                <tbody>
                    <tr>
                        <td><?php echo($cnt);?></td>
                        <td><?php echo htmlentities($result->Description);?></td>
                        <td><?php echo htmlentities($result->Create_date);?></td>             
                    </tr>
                </tbody>
                <?php  $cnt=$cnt+1; } } ?>
              </table>
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
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
   
  </body>
</html>
<?php } ?>