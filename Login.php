<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ignova University</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="container">
        <section class="sub-header2">
            <nav>
                <a href="HomePage.html"><img src="Images/Ignova University_Blue.png"></a>
                <div class="nav-links" id="navLinks">
                    <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
                    <ul>
                        <li><a href="HomePage.html">HOME</a></li>
                        <li><a href="Login.php">LOGIN</a></li>
                        <li><a href="Course.html">COURSE</a></li>
                        <li><a href="Blog.html">BLOG</a></li>
                        <li><a href="About.html">ABOUT</a></li>
                        <li><a href="Contact.html">CONTACT</a></li>
                    </ul>
                </div>
                <i class="fa-solid fa-bars" onclick="showMenu()"></i>
            </nav>
            <div class="logincard">
            <?php
                if (isset($_SESSION['success'])) {
                    echo "<div class='message success-message'><i class='fa-solid fa-circle-check'></i> " . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo "<div class='message error-message'><i class='fa-solid fa-circle-exclamation'></i> " . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                ?>
                <div class="innercard" id="logincard">
                    <div class="frontCard">
                        <h2>LOGIN</h2>
                        <form action="validation.php" method="post">
                            <input type="text" name="nic" class="input-box" placeholder="Your NIC Number" required>
                            <input type="password" name="password" class="input-box" placeholder="Password" required>
                            <button type="submit" class="loginbtn">Login</button>
                            <input type="checkbox"><span>Remember Me</span>
                        </form>
                        <button type="button" class="regbtn" onclick="openRegister()">I'm New Here</button>
                        <a href="">Forgot Password</a>
                    </div>
                    <div class="backCard">
                        <h2>REGISTER</h2>
                        <form action="registration.php" method="post">
                            <input type="text" name="user" class="input-box" placeholder="Your Name" required>
                            <input type="text" name="nic" class="input-box" placeholder="Your NIC Number" required>
                            <input type="text" name="address" class="input-box" placeholder="Your Address" required>
                            <input type="text" name="tel" class="input-box" placeholder="Your Tel. Number" required>
                            <select name="course" class="input-box" placeholder="Select your course" required>
                                <option value="" disabled selected>Select Your Course</option>
                                <option value="Certificate in Cyber Security & Ethical hacking">Certificate in Cyber Security & Ethical hacking</option>
                                <option value="BSc (Hons) Cyber Security Engineer">BSc (Hons) Cyber Security Engineer</option>
                                <option value="Certified Computer Hacking Forensic Investigator">Certified Computer Hacking Forensic Investigator</option>
                                <option value="Executive Master of Science in Information Security">Executive Master of Science in Information Security</option>
                                <option value="Master of Science in Cyber Security (MSc CS)">Master of Science in Cyber Security (MSc CS)</option>
                            </select>
                            <input type="password" name="password" class="input-box" placeholder="Password" required>
                            <button type="submit" class="loginbtn">Register</button>
                            <input type="checkbox"><span>Remember Me</span>
                        </form>
                        <button type="button" class="regbtn" onclick="openLogin()">I've an account</button>
                        <a href="">Forgot Password</a>
                    </div>
                </div>
            </div>
        </section>
        </div>
        

    <script>
        var logincard = document.getElementById("logincard");
        function openRegister(){
            logincard.style.transform= "rotateY(-180deg)";
        }
        function openLogin(){
            logincard.style.transform= "rotateY(0deg)";
        }
    </script>
</body>
</html>
