<?php
// Check if the shiftId and empId parameters are provided
if(isset($_POST['id']) && isset($_POST['EmpID'])) {
    // Retrieve shiftId and empId from the POST data
    $id = $_POST['id'];
    $empId = $_POST['EmpID'];

    try {
        // Establish database connection
        require_once('include/config.php');
        
        // Prepare SQL statement to update the shift with the assigned employee ID
        $sql = "UPDATE tblshifts SET EmpID = :EmpID WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':EmpID', $empId, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            // If execution is successful, set success message
            $success = true;
            $message = "Shift assigned successfully!";
        } 
        else {
            // If execution fails, set error message
            $success = false;
            $message = "Failed to assign shift";
        }
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
    'message' => $message
);

// Convert response data to JSON format and send it back
echo json_encode($response);
?>
