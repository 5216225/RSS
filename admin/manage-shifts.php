<?php 
  include 'include/config.php';
  if(isset($_REQUEST['del'])){
    $uid=intval($_GET['del']);
    $sql = "delete from tblshifts WHERE  id=:id";
    $query = $dbh->prepare($sql);
    $query-> bindParam(':id',$uid, PDO::PARAM_STR);
    $query -> execute();
    echo "<script>alert('Record Delete successfully');</script>";
    echo "<script>window.location.href='manage-shifts.php'</script>";
  }
?>

<?php
if(isset($_POST['unassign_shift'])) {
    $unassignId = intval($_POST['unassign_id']);
    try {
        $sql = "UPDATE tblshifts SET EmpID = NULL WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $unassignId, PDO::PARAM_INT);
        $query->execute();
        echo "<script>alert('Shift unassigned successfully');</script>";
        echo "<script>window.location.href='manage-shifts.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error unassigning shift: ".$e->getMessage()."');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RSS | Manage Shifts</title>
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
              <div class="tile-body">
                <h2 align="center"> Manage Shifts</h2>
                <hr />
                
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Shift ID</th>
                      <th>Employee ID</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>              
                  
                  <?php
                    $sql="SELECT * FROM tblshifts";
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
                      <td>
                        <?php 
                          $assigned_to = $result->EmpID;
                          if (empty($assigned_to)):
                            echo '<span class="btn btn-info" style="margin-left: 10px;">Open Shift</span>';
                          else:
                            echo htmlentities($result->EmpID);
                            endif;
                        ?>
                      </td>
                      <td><?php echo htmlentities($result->start_time);?></td>
                      <td><?php echo htmlentities($result->end_time);?></td>
                      <td>
                        <?php 
                          $assigned_to = $result->EmpID;
                          if (empty($assigned_to)):
                            echo '<span class="btn btn-warning">Not Assigned</span>';
                          else:
                            echo '<span class="btn btn-success">Assigned</span>';
                        ?>
                        <form method="post" action="" style="display:inline;">
                          <input type="hidden" name="unassign_id" value="<?php echo $result->id; ?>">
                          <button type="submit" name="unassign_shift" class="btn btn-primary">Unassign</button>
                        </form>
                        <?php endif; ?>
                      </td>
                      <td>
                        <a href="edit-shift.php?levid=<?php echo htmlentities($result->id);?>"><span class="btn btn-success">Edit</span>
                        <a href="manage-shifts.php?del=<?php echo htmlentities($result->id);?>"><span class="btn btn-danger">Delete</span>
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