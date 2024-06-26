<?php 
  session_start();
  error_reporting(0);
  require_once('include/config.php');
  if(strlen($_SESSION["Empid"])==0){   
    header('location:index.php');
  }
  else{ 
?>
<!DOCTYPE html>
<html lang="en">
  <head>  
    <title>RSS | Salary History</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Animation CSS -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
      /* Additional custom styles for animation */
      .animated {
        animation-duration: 1s;
        animation-fill-mode: both;
      }
      @keyframes slideInDown {
        0% {
          opacity: 0;
          transform: translateY(-100%);
        }
        100% {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .slideInDown {
        animation-name: slideInDown;
      }
      /* Style for the action button */
      .action-button {
        display: inline-block;
        padding: 8px 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
      }
      .action-button:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
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
          <div class="tile animated slideInDown">
            <div class="tile-body">
              <h2 align="center" class="animated fadeIn">Salary History</h2>
              <hr class="animated fadeIn">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Empid</th>
                    <th>DepartmentName</th>
                    <th>Salary</th>
                    <th>Allowance</th>
                    <th>Total</th>
                    <th>Creation Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
              
                <?php
                  $empid=$_SESSION["Empid"];
                  $sql="SELECT tbladdsalary.id as sid,tbladdsalary.empid,tbladdsalary.salary,tbladdsalary.allowancesalary,tbladdsalary.total,tbldepartment.DepartmentName,create_date FROM tbladdsalary join tbldepartment on tbladdsalary.Department=tbldepartment.id where tbladdsalary.empid=:empid";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':empid',$empid, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0){
                    foreach($results as $result){
                ?>

                <tbody>
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td><?php echo htmlentities($result->empid);?></td>
                    <td><?php echo htmlentities($result->DepartmentName);?></td>
                    <td>£<?php echo htmlentities($result->salary);?>.00</td>
                    <td>£<?php echo htmlentities($result->allowancesalary);?>.00</td>
                    <td>£<?php echo htmlentities($result->total);?>.00</td>
                    <td><?php echo htmlentities($result->create_date);?></td>
                    <td>
                      <a href="salary-details.php?id=<?php echo htmlentities($result->sid);?>" target="_blank" class="action-button animated fadeIn">View</a>
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
    
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- DataTables JS -->
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
<?php } ?>
