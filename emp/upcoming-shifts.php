<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if (strlen($_SESSION["Empid"]) == 0) {   
    header('location:index.php');
}
else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>RSS | Upcoming Shifts</title>
    <meta charset="utf-8">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Data table CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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
                        <h2 align="center">Upcoming Shifts</h2>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Shift ID</th>
                                        <th>Emp ID</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $EmpID = $_SESSION["Empid"];
                                    $currentDateTime = date('Y-m-d H:i:s');
                                    $sql = "SELECT id, start_time, end_time, EmpID FROM tblshifts WHERE EmpID = :EmpID AND start_time > :currentDateTime ORDER BY start_time ASC";
                                    $query= $dbh->prepare($sql);
                                    $query->bindParam(':EmpID', $EmpID, PDO::PARAM_STR);
                                    $query->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    
                                    foreach($results as $result){
                                        echo "<tr>";
                                        echo "<td>{$result->id}</td>";
                                        echo "<td>{$result->EmpID}</td>";
                                        echo "<td>{$result->start_time}</td>";
                                        echo "<td>{$result->end_time}</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    <!-- Data table plugin-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
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
