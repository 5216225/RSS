<?php 
  session_start();
  include 'include/config.php';
  if(strlen($_SESSION["Empid"])==0){   
    header('location:index.php');
  }
  else{
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RSS | Salary Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS for animations -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <style>
      /* Custom styles for animations */
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
      @keyframes fadeIn {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }
      .fadeIn {
        animation-name: fadeIn;
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
        <div class="col-md-12 animated slideInDown">
          <div class="tile">
            <h3 align="center" class="animated fadeIn"> Salary Details</h3>
            <hr class="animated fadeIn">
            <div class="tile-body">
              <?php
                $sid=$_GET['id'];
                $sql="SELECT salary,allowancesalary,total,tbladdsalary.create_date,
                tbldepartment.DepartmentName,tblemployee.EmpID,fname,lname,email,mobile,country,state,city,address,photo,dob,date_of_joining FROM tbladdsalary
                left join tblemployee on tbladdsalary.empid=tblemployee.EmpId
                left join tbldepartment on tblemployee.department_name=tbldepartment.id
                where tbladdsalary.id=:sid";
                
                $query= $dbh->prepare($sql);
                $query->bindParam(':sid',$sid, PDO::PARAM_STR);
                $query-> execute();
                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query -> rowCount() > 0){
                  foreach($results as $result){
              ?>
              <table class="table table-hover table-bordered">
                <tbody>
                  <tr>
                    <th colspan="4" style="font-size:20px; color:blue;" class="animated fadeIn">Personal Info Info</th>
                  </tr>

                  <tr>
                    <th>EmpId</th> <td><?php echo $result->EmpID;?></td>
                    <th>Photo</th> <td><img src="<?php echo $result->photo;?>" width="150px" height="130px;" class="animated fadeIn"></td>
                  </tr>

                  <tr>
                    <th>First Name</th> <td><?php echo $result->fname;?></td>
                    <th>Last Name</th> <td><?php echo $result->lname;?></td>
                  </tr>
                  
                  <tr>
                    <th>Department</th><td><?php echo $result->DepartmentName;?></td>
                    <th>Email</th><td><?php echo $result->email;?></td>
                  </tr>

                  <tr>
                    <th>Mobile</th> <td><?php echo $result->mobile;?></td>
                  </tr>

                  <tr>
                    <th colspan="4" style="font-size:20px; color:blue;" class="animated fadeIn">Salary Related Info</th>
                  </tr>

                  <tr>
                    <th>Salary</th> <td><?php echo $result->salary;?></td>
                    <th>Allowance</th> <td><?php echo $result->allowancesalary;?></td>
                  </tr>
                  
                  <tr>
                    <th>Total</th> <td><?php echo $result->total;?></td>
                    <th>Creation Date</th> <td><?php echo $result->create_date;?></td>
                  </tr>
                </tbody>
              </table>
              <?php } } ?>
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
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#sampleTable').DataTable();
      });
    </script>
  </body>
</html>
<?php } ?>
