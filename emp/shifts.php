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
    <title>RSS | Get Shift</title>
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
                        <h2 align="center">Shifts</h2>
                        <hr />
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Shift ID</th>
                                    <th>Emp ID</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $EmpID = $_SESSION["Empid"];
                                $sql = "SELECT id, start_time, end_time, EmpID FROM tblshifts";
                                $query= $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                
                                foreach($results as $result){
                                    echo "<tr>";
                                    echo "<td>{$result->id}</td>";
                                    echo "<td>";
                                    if ($result->EmpID == NULL) {
                                        echo '<span class="btn btn-info">Open Shift</span>';
                                    } 
                                    else{
                                        echo $result->EmpID;
                                    }
                                    echo "</td>";
                                    echo "<td>{$result->start_time}</td>";
                                    echo "<td>{$result->end_time}</td>";
                                    
                                    echo "<td>";
                                    if ($result->EmpID == NULL) {
                                        echo '<button class="btn btn-primary" onclick="assignShift('.$result->id.')">Get Shift</button>';
                                    } 
                                    else {
                                        if ($result->EmpID == $EmpID) {
                                            echo '<span class="btn btn-dark">No Action Needed</span>';
                                        } 
                                        else {
                                            echo '<span class="btn btn-success">Assigned to different employee</span>';
                                            echo '<button class="btn btn-primary" onclick="swapShift('.$result->id.')" style="margin-left:7px;">Swap Shift</button>';
                                        }
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                    $cnt++;
                                }
                                ?>
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
    <!-- The javascript plugin to display page loading on top
    <script src="js/plugins/pace.min.js"></script>-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sampleTable').DataTable();
        });

        // JavaScript function to assign shift
        function assignShift(id) {
            var empId = "<?php echo $EmpID?>";
            console.log("Shift ID: " + id); // Debugging statement
            console.log("Emp ID: " + empId); // Debugging statement

            // Check if both id and empId are provided
            if (id && empId) {
                // Send AJAX request to assign shift
                $.ajax({
                    url: 'assign_shift.php', // Corrected PHP script name
                    type: 'POST',
                    data: { id: id, EmpID: empId }, // Ensure correct parameter names
                    dataType: 'json', // Specify expected data type
                    success: function(response) {
                        // Handle response from server
                        console.log(response); // Debugging statement
                        if (response.success) {
                            // Update UI or display success message
                            alert("Shift assigned successfully!");
                            // Reload the page to reflect changes
                            location.reload();
                        } 
                        else {
                            alert("Failed to assign shift: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Failed to assign shift: " + error);
                    }
                });
            } 
            else {
                alert("Shift ID or Employee ID is not provided");
            }
        }

        // JavaScript function to swap shift
        function swapShift(id) {
            var empId = "<?php echo $EmpID?>";
            console.log("Shift ID: " + id); // Debugging statement
            console.log("Emp ID: " + empId); // Debugging statement

            // Check if both id and empId are provided
            if (id && empId) {
                // Send AJAX request to swap shift
                $.ajax({
                    url: 'swap_shift.php', // Adjust URL according to your implementation
                    type: 'POST',
                    data: { id: id, EmpID: empId }, // Ensure correct parameter names
                    dataType: 'json', // Specify expected data type
                    success: function(response) {
                        // Handle response from server
                        console.log(response); // Debugging statement
                        if (response.success) {
                            // Update UI or display success message
                            alert("Shift swapped successfully!");
                            // Reload the page to reflect changes
                            location.reload();
                        } 
                        else {
                            alert("Failed to swap shift: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Failed to swap shift: " + error);
                    }
                });
            } 
            else {
                alert("Shift ID or Employee ID is not provided");
            }
        }
    </script>
</body>
</html>
<?php } ?>