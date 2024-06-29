<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'icampusdb');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (!isset($_SESSION['user_nic'])) {
    header('Location: Login.php'); 
    exit();
}

$user_nic = $_SESSION['user_nic'];

$query = $con->prepare("SELECT * FROM student_details WHERE nic = ?");
$query->bind_param("s", $user_nic);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

$student_id = $user['student_id'];
$course = $user['course'];

$query->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];

    $update = $con->prepare("UPDATE student_details SET name=?, address=?, tel=? WHERE student_id=?");
    $update->bind_param("sssi", $name, $address, $tel, $student_id);

    if ($update->execute()) {
        $_SESSION['message'] = "Profile updated successfully.";
    } else {
        $_SESSION['message'] = "Error updating profile: " . $update->error;
    }

    $update->close();

   
    $query = $con->prepare("SELECT * FROM student_details WHERE nic = ?");
    $query->bind_param("s", $user_nic);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();
    $query->close();

}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ignova University</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <section class="sub-header4">
        <nav>
            <a href="HomePage.html"><img src="Images/Ignova University_Blue.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="HomePage.html">HOME</a></li>
                    <li><a href="Profile.php">PROFILE</a></li>
                    <li><a href="Studentdashboard.php">DASHBOARD</a></li>
                    <li><a href="">MY COURSES</a></li>
                    <li><a href="Contact.html">CONTACT</a></li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>| Profile</h1>
    </section>

    <section class="userprofile">
        <div class="container6">
            <div class="form-side">
                <form action="Profile.php" method="post">
                    <?php if (isset($_SESSION['message'])): ?>
                        <p class="message"><?php echo $_SESSION['message']; ?></p>
                        <?php unset($_SESSION['message']); endif; ?>
                    <h3><i class="fa-regular fa-user"></i>&nbsp;&nbsp;&nbsp;Your Profile</h3><br>

                    <div class="inputs-container">
                        <label for="student_id"><i class="fa-solid fa-id-badge">&nbsp;</i>Student ID:</label>
                        <span id="student_id"><?php echo htmlspecialchars($student_id); ?></span><br>

                        <label for="name"><i class="fa-solid fa-id-card">&nbsp;</i>Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

                        <label for="nic"><i class="fa-solid fa-id-card">&nbsp;</i>NIC:</label>
                        <span id="nic"><?php echo htmlspecialchars($user['nic']); ?></span><br>

                        <label for="address"><i class="fa-solid fa-house">&nbsp;</i>Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required><br>

                        <label for="tel"><i class="fa-solid fa-phone">&nbsp;</i>Telephone:</label>
                        <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($user['tel']); ?>" required><br>

                        <label for="course"><i class="fa-solid fa-book-open-reader">&nbsp;</i>Course:</label>
                        <span id="course"><?php echo htmlspecialchars($course); ?></span><br>
                    </div>
                    <button class="upbutton" type="submit">Update Profile</button>
                </form>
            </div>
            <div class="image-side">
                
            </div>
        </div>
    </section>
</body>
</html>
