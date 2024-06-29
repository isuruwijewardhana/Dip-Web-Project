<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'icampusdb');

if (mysqli_connect_errno()) {
    echo json_encode(array("error" => "Failed to connect to MySQL: " . mysqli_connect_error()));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nic = filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $course = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = $con->prepare("UPDATE student_details SET name = ?, nic = ?, address = ?, tel = ?, course = ? WHERE student_id = ?");
    $query->bind_param("sssssi", $name, $nic, $address, $tel, $course, $student_id);

    if ($query->execute()) {
        $response = array("success" => "Student details updated successfully.");
    } else {
        $response = array("error" => "Error executing query: " . htmlspecialchars($query->error));
    }

    $query->close();
} else {
    $response = array("error" => "Invalid request.");
}

echo json_encode($response);

$con->close();
?>
