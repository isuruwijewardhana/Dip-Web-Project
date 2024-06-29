<?php

session_start();
$con = mysqli_connect('localhost', 'root', '', 'icampusdb');


if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$name = $_POST['user'];
$nic = $_POST['nic'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$course = $_POST['course'];
$password = $_POST['password'];


$s = $con->prepare("SELECT * FROM student_details WHERE name = ?");
$s->bind_param("s", $name);
$s->execute();
$result = $s->get_result();
$num = $result->num_rows;

if ($num == 1) {
    $_SESSION['error'] = "Already exists.";
} else {
    
    $reg = $con->prepare("INSERT INTO student_details (name, nic, address, tel, course, password) VALUES (?, ?, ?, ?, ?, ?)");
    $reg->bind_param("ssssss", $name, $nic, $address, $tel, $course, $password);
    if ($reg->execute()) {
        $_SESSION['success'] = "Registration Successful.";
        $reg->close();
    } else {
        $_SESSION['error'] = "Error: " . $reg->error;
    }
}


$s->close();

$con->close();

header('Location: Login.php');
exit();
?>
