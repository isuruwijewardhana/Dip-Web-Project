<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'icampusdb');

if (mysqli_connect_errno()) {
    echo json_encode(array("error" => "Failed to connect to MySQL: " . mysqli_connect_error()));
    exit();
}

if(isset($_POST['nic'])) {
    $nic = filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$nic) {
        echo json_encode(array("error" => "Invalid NIC."));
        exit();
    }

    $query = $con->prepare("SELECT student_id, name, nic, address, tel, course FROM student_details WHERE nic = ?");
    $query->bind_param("s", $nic);

    if ($query->execute()) {
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(array("error" => "No student found with that NIC."));
        }
    } else {
        echo json_encode(array("error" => "Error executing query: " . htmlspecialchars($query->error)));
    }

    $query->close();
} else {
    echo json_encode(array("error" => "NIC is not set."));
}

$con->close();
?>
