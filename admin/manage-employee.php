<!DOCTYPE html>
<html lang="en">
  <head>  
    <title>RSS | Manage Employee</title>
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
                <h2 align="center"> Manage Employee</h2>
                <hr />
                
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Emp Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Country</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
              
                  <?php
                    include  'include/config.php';
                    $sql="SELECT tblemployee.id,EmpId, fname, lname, department_name, email, mobile, country, state, city, address, photo, 
                    dob, date_of_joining, create_date,tbldepartment.DepartmentName FROM tblemployee
                    left join tbldepartment on tblemployee.department_name=tbldepartment.id";
                  
                    $query= $dbh->prepare($sql);
                    // $query->bindParam(':st',$st, PDO::PARAM_STR);
                    $query-> execute();
                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query -> rowCount() > 0){
                      foreach($results as $result){
                  ?>
            
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td><?php echo htmlentities($result->EmpId);?></td>
                    <td><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></td>
                    <td><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->mobile);?></td>
                    <td><?php echo htmlentities($result->country);?></td>
                    <td><?php echo htmlentities($result->DepartmentName);?></td>
                    <?php  $id=$result->id;?>
                    <td>  
                      <a href="emp-details.php?empid=<?php echo htmlentities($result->id);?>" class="btn btn-info">View</a>
                      <a href="edit-employee.php?empid=<?php echo htmlentities($result->id);?>" class="btn btn-success">Edit</a>
                      <a href="emp-salary-history.php?empid=<?php echo htmlentities($result->EmpId);?>&&empname=<?php echo htmlentities($result->fname);?>"  class="btn btn-warning">Salary</a>
                      <a href="emp-leave-history.php?empid=<?php echo htmlentities($result->EmpId);?>&&empname=<?php echo htmlentities($result->fname);?>" class="btn btn-danger">Leave</a>
                    </td>
                  </tr>                   
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