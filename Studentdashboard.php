<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'icampusdb');

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$user_nic = $_SESSION['user_nic'];

$query = $con->prepare("SELECT student_id, name, nic, address, tel, course FROM student_details WHERE nic = ?");
$query->bind_param("s", $user_nic);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    
    $student_id = $row['student_id'];
    $name = $row['name'];
    $nic = $row['nic'];
    $address = $row['address'];
    $tel = $row['tel'];
    $course = $row['course'];
} else {
    echo "User details not found.";
}

$query->close();
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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <section class="sub-header3">
        <nav>
            <a href="HomePage.html"><img src="Images/Ignova University_Blue.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="HomePage.html">HOME</a></li>
                    <li><a href="Profile.php">PROFILE</a></li>
                    <li><a href="Studentdashboard.php">DASHBOARD</a></li>
                    <li><a href="">MY COURSES</a></li>
                    <li><a href="">SUPPORT</a></li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>|    Student Dashboard&nbsp;&nbsp;<i class="fa-solid fa-user"></i></h1>
    </section>

    <section class="Dashboard">
     <div class="container1">
        <div class="greeting">
            <br>
            &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-user"></i>&nbsp;<?php echo "Hi " . $row['name'] . " (Student ID: " . $row['student_id'] . ")"; ?>&nbsp;&nbsp;&nbsp;
        </div>
        <div class="details">
         <p><br>
            <strong class="nic"><i class="fa-solid fa-id-card">&nbsp;</i>NIC:</strong> <?php echo $row['nic']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong class="address"><i class="fa-solid fa-house">&nbsp;</i>Address:</strong> <?php echo $row['address']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong class="tel"><i class="fa-solid fa-phone">&nbsp;</i>Tel. No:</strong> <?php echo $row['tel']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <br><strong class="course"><i class="fa-solid fa-book-open-reader">&nbsp;</i>Course:</strong> <?php echo $row['course']; ?>
        </p>
        </div>
        <div class="logout-button">
        <button onclick="location.href='LogOut.php'">Log Out</button>
    </div>
     </div>
    </section>

    <section class="topics-section">
    <div class="row">
        <div class="topic-container">
            <div class="topic-box" style="background-color: #1E90FF;">
            <div class="topic-content">
            <i class="fa-solid fa-thumbtack"></i>
            <span>Notice Board</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #4682B4;">
            <div class="topic-content">
            <i class="fa-solid fa-clock"></i>
            <span>Time Table</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #5B92E5;">
            <div class="topic-content">
            <i class="fa-solid fa-video"></i>
            <span>Live Lectures</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #87CEFA;">
            <div class="topic-content">
            <i class="fa-solid fa-person-chalkboard"></i>
            <span>Free Lessons</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #6495ED;">
            <div class="topic-content">
            <i class="fa-solid fa-file-powerpoint"></i>
            <span>Practicals</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #009FDF;">
            <div class="topic-content">
            <i class="fa-solid fa-note-sticky"></i>
            <span>Assignments</span>
        </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="topic-container">
            <div class="topic-box" style="background-color: #00BFFF;">
            <div class="topic-content">
            <i class="fa-solid fa-e"></i>
            <span>Online Exam</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #5A9BD5;">
            <div class="topic-content">
            <i class="fa-solid fa-marker"></i>
            <span>Attendance</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #6CA6CD;">
            <div class="topic-content">
            <i class="fa-solid fa-money-bill"></i>
            <span>Payments</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #468499;">
            <div class="topic-content">
            <i class="fa-solid fa-square-poll-vertical"></i>
            <span>Results</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #00CED1;">
            <div class="topic-content">
            <i class="fa-solid fa-book"></i>
            <span>Libraries</span>
        </div>
            </div>
        </div>
        <div class="topic-container">
            <div class="topic-box" style="background-color: #ADD8E6;">
            <div class="topic-content">
            <i class="fa-solid fa-question"></i>
            <span>Inquires</span>
        </div>
            </div>
        </div>
    </div>
</section>


<section class="main-rectangle-section">
        <div class="main-rectangle">
            <div class="rectangle-header">Your Progress</div>
            <div class="inner-rectangle">
                <div class="progress-container">
                    <div class="progress-labels">
                        <span class="start">0%</span>
                        <span class="end">100%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" style="width: 75%;">
                            <span class="progress-completion">75%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer">
        <h4>About Us</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quo necessitatibus eaque officia obcaecati
            sit eveniet facilis minima? <br>Deserunt quod rerum hic earum possimus tempore natus est delectus beatae
            aliquid!</p>
        <div class="icons">
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-x-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-linkedin-in"></i>
        </div>
        <p>Made by @isuru wijewardhana<i class="fa-brands fa-github"></i><br><i class="fa-regular fa-copyright"></i>2024
        </p>
    </section>

    <script>
        var navLinks = document.getElementById("navLinks");
        function showMenu() {
            navLinks.style.right = "o";
        }
        function hideMenu() {
            navLinks.style.right = "-200px";
        }

        window.onload = function() {
        var bars = document.querySelectorAll('.progress-bar');
        bars.forEach(function(bar) {
        var percentage = bar.style.width; 
        bar.style.width = '0'; 
        setTimeout(function() { bar.style.width = percentage; },500);
            });
        };
    </script>
</body>

</html>