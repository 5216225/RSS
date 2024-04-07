<?php
// Check if the shiftId and empId parameters are provided
if(isset($_POST['id']) && isset($_POST['EmpID'])) {
    // Retrieve shiftId and empId from the POST data
    $id = $_POST['id'];
    $EmpID = $_POST['EmpID'];

    try {
        // Establish database connection
        require_once('include/config.php');
        
        // Retrieve the current employee assigned to the shift
        $sql_select_current_emp = "SELECT EmpID FROM tblshifts WHERE id = :id";
        $stmt_select_current_emp = $dbh->prepare($sql_select_current_emp);
        $stmt_select_current_emp->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_select_current_emp->execute();
        $current_emp = $stmt_select_current_emp->fetch(PDO::FETCH_ASSOC);

        // Update the shift with the new employee ID
        $sql_update_shift = "UPDATE tblshifts SET EmpID = :EmpID WHERE id = :id";
        $stmt_update_shift = $dbh->prepare($sql_update_shift);
        $stmt_update_shift->bindParam(':EmpID', $EmpID, PDO::PARAM_STR);
        $stmt_update_shift->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_update_shift->execute();

        // If execution is successful, set success message
        $success = true;
        $message = "Shift swapped successfully!";
        
        // Return the previously assigned employee ID for further processing if needed
        $prev_emp = $current_emp['EmpID'];
    } 
    catch (PDOException $e) {
        // If database error occurs, set error message
        $success = false;
        $message = "Database error: " . $e->getMessage();
    }
} 
else {
    // If shiftId or empId is not provided, return an error message
    $success = false;
    $message = "Shift ID or Employee ID is not provided";
}

// Prepare response data
$response = array(
    'success' => $success,
    'message' => $message,
    'previous_employee' => $prev_emp // Return the previous employee ID for further processing
);

// Convert response data to JSON format and send it back
echo json_encode($response);
?>
