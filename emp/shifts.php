<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if (strlen($_SESSION["Empid"]) == 0) {   
    header('location:index.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>RSS | Shifts</title>
    <meta charset="utf-8">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <!-- Custom CSS -->
    <style>
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slideInRight {
            animation-name: slideInRight;
        }

        .shift-table th,
        .shift-table td {
            text-align: center;
        }

        .shift-table .open-shift-badge {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
        }

        .shift-table .no-action-badge {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #555;
            color: #fff;
        }

        .shift-table .assigned-badge {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #2ecc71;
            color: #fff;
        }

        .shift-actions {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .shift-actions button {
            margin-left: 5px;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .shift-actions button:hover {
            background-color: #2980b9;
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
                <div class="tile animated slideInRight">
                    <div class="tile-body">
                        <h2 align="center">Shifts</h2>
                        <hr class="animated fadeIn">
                        <table class="table table-hover table-bordered shift-table" id="sampleTable">
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
                                        echo '<span class="open-shift-badge animated fadeIn">Open Shift</span>';
                                    } 
                                    else{
                                        echo $result->EmpID;
                                    }
                                    echo "</td>";
                                    echo "<td>{$result->start_time}</td>";
                                    echo "<td>{$result->end_time}</td>";
                                    
                                    echo "<td class='shift-actions'>";
                                    if ($result->EmpID == NULL) {
                                        echo '<button class="animated fadeIn btn-get-shift" onclick="assignShift('.$result->id.')">Get Shift</button>';
                                    } 
                                    else {
                                        if ($result->EmpID == $EmpID) {
                                            echo '<span class="btn btn-success animated fadeIn">Assigned to me</span>';
                                        } 
                                        else {
                                            echo '<span class="btn btn-warning animated fadeIn">Assigned to different employee</span>';
                                            echo '<button class="btn-swap-shift" onclick="swapShift('.$result->id.')">Swap Shift</button>';
                                        }
                                    }
                                    echo "</td>";
                                    echo "</tr>";
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

        // JavaScript function to assign shift
        function assignShift(id) {
            var empId = "<?php echo $EmpID?>";

            // Check if both id and empId are provided
            if (id && empId) {
                // Send AJAX request to assign shift
                $.ajax({
                    url: 'assign_shift.php',
                    type: 'POST',
                    data: { id: id, EmpID: empId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert("Shift assigned successfully!");
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

            // Check if both id and empId are provided
            if (id && empId) {
                // Send AJAX request to swap shift
                $.ajax({
                    url: 'swap_shift.php',
                    type: 'POST',
                    data: { id: id, EmpID: empId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert("Shift swapped successfully!");
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
