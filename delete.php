<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'icampusdb');


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}


if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];

    
    $delete = $con->prepare("DELETE FROM student_details WHERE student_id = ?");
    $delete->bind_param("i", $studentId); 
    if ($delete->execute()) {
        
        $response = array('success' => 'Student deleted successfully.');
        echo json_encode($response);
    } else {
        
        $response = array('error' => 'Failed to delete student.');
        echo json_encode($response);
    }

    $delete->close();
} else {
    
    $response = array('error' => 'Student ID not provided.');
    echo json_encode($response);
}


$con->close();
?>
