<?php

session_start();
$con = mysqli_connect('localhost', 'root', '', 'icampusdb');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$nic = $_POST['nic'];
$password = $_POST['password'];

$login = $con->prepare("SELECT * FROM student_details WHERE nic = ? AND password = ?");
$login->bind_param("ss", $nic, $password);
$login->execute();
$result = $login->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    
    $_SESSION['user_nic'] = $nic;

    if ($user['usertype'] == 'admin') {
        header('Location: Admindashboard.php');
    } else {
        
        header('Location: Studentdashboard.php');
    }
} else {
    
    $_SESSION['error'] = "NIC or Password is incorrect.";
    header('Location: Login.php');
}

$login->close();
$con->close();
exit();


?>