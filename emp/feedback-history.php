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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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
          <h2 class="animate__animated animate__bounceIn">Feedback History</h2>
          <div class="table-responsive animate__animated animate__fadeInUp">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Feedback No</th>
                  <th>Description</th>
                  <th>Applied Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $EmpID = $_SESSION["Empid"];
                  $sql = "SELECT tblfeedback.id, Description, tblfeedback.Create_date FROM tblfeedback WHERE EmpID = :EmpID";      
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':EmpID', $EmpID, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if($query->rowCount() > 0){
                    foreach($results as $result){
                ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php echo htmlentities($result->Description);?></td>
                  <td><?php echo htmlentities($result->Create_date);?></td>             
                </tr>
                <?php  
                    $cnt++;
                    } 
                  } else {
                ?>
                <tr>
                  <td colspan="3" align="center">No feedback found</td>
                </tr>
                <?php } ?>
              </tbody>
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
  <!-- DataTables JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <!-- Animate.css -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#sampleTable').DataTable();
    });
  </script>
</body>
</html>
<?php } ?>
