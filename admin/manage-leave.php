<?php 
  include 'include/config.php';
  if(isset($_REQUEST['del'])){
    $uid=intval($_GET['del']);
    $sql = "delete from tblleavetype WHERE  id=:id";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':id',$uid, PDO::PARAM_STR);
    $query -> execute();
    echo "<script>alert('Record Delete successfully');</script>";
    echo "<script>window.location.href='manage-leave.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RSS | Manage Leave Types</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
      animation: fadeInUp 0.6s ease-in-out;
    }
    h2 {
      margin-bottom: 30px;
      color: #333;
      text-align: center;
      animation: slideInDown 0.8s ease-in-out;
    }
    table {
      width: 100%;
      background-color: #fff;
      animation: slideInUp 0.8s ease-in-out;
    }
    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }
    th {
      background-color: #f8f9fa;
      font-weight: bold;
    }
    tbody tr:hover {
      background-color: #f1f1f1;
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
                <h2 align="center"> Manage Leave Types</h2>
                <hr />
                
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Leave Type ID</th>
                      <th>Type Of Leave</th>
                      <th>Action</th>
                    </tr>
                  </thead>              
                  
                  <?php
                    $sql="SELECT * FROM tblleavetype";
                    $query= $dbh->prepare($sql);
                    $query-> execute();
                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query -> rowCount() > 0){
                      foreach($results as $result){
                  ?>
                  
                  <tbody>
                    <tr>
                      <td><?php echo($cnt);?></td>
                      <td><?php echo htmlentities($result->leaveType);?></td>
                      <td>
                        <a href="edit-leave.php?levid=<?php echo htmlentities($result->id);?>"><span class="btn btn-success">Edit</span>
                        <a href="manage-leave.php?del=<?php echo htmlentities($result->id);?>"><span class="btn btn-danger">Delete</span>
                      </td>
                    </tr>
                  </tbody>
                  <?php  $cnt=$cnt+1; } } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

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
      $(document).ready(function() {
        $('#sampleTable').DataTable({
          "paging": true, // Enable pagination
          "ordering": true, // Enable sorting
          "searching": true, // Enable searching
          "info": true // Enable table information display
        });
      });
    </script>   
  </body>
</html>