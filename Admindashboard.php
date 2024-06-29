<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ignova University</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <section class="sub-header5">
        <nav>
            <a href="HomePage.html"><img src="Images/Ignova University_Blue.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="HomePage.html">HOME</a></li>
                    <li><a href="">ADMIN PROFILE</a></li>
                    <li><a href="Admindashboard.php">ADMIN DASHBOARD</a></li>
                    <li><a href="">SERVER</a></li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" onclick="showMenu()"></i>
        </nav>
        
        <h1>|    Admin Dashboard&nbsp;&nbsp;<i class="fa-solid fa-screwdriver-wrench"></i></h1>

        <section class="search-result-container">
            <section class="search-part">
                <div class="searchbox">
                    <input type="text" id="nic" placeholder="Enter NIC">
                    <button onclick="searchStudent()">Search</button>
                </div>
            </section>

            <div id="result" class="result-part">
                <div class="image-container">
                    
                </div>
                <div class="details-container">
                    <div class="details">
                       
                    </div>
                </div>
            </div>
        </section> 
        <br>
        

        <div id="message-container">
        </div>

        <div class="container-wrapper">
            <div id="edit-container" class="edit-part" style="display:none;">
                         
            </div>

            <div id="student-info-container" class="student-info" style="display:none;">
                <div class="image-container"></div> 
                <p><strong>ID:</strong> <span id="student-id-display"></span></p>
                <p><strong>NIC:</strong> <span id="student-nic-display"></span></p>
                <button id="delete-btn" onclick="deleteStudent()">Delete</button>               
            </div>
        </div>

<section class="tabeledis">
    <?php include 'display_table.php'; ?>
</section>
        

        <section class="footer2">
            <br><br><br>
            <h4>About Us</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quo necessitatibus eaque officia
                obcaecati
                sit eveniet facilis minima? <br>Deserunt quod rerum hic earum possimus tempore natus est delectus beatae
                aliquid!</p>
            <div class="icons">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
            <p>Made by @isuru wijewardhana<i class="fa-brands fa-github"></i><br><i
                    class="fa-regular fa-copyright"></i>2024
            </p>
        </section>

        <script>
  function searchStudent() {
    var nic = $('#nic').val();
    $.ajax({
        url: 'search.php',
        type: 'post',
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: { nic: nic },
        success: function (response) {
            var studentDetails = JSON.parse(response);
            var courseNames = {
                'course1': 'Certificate in Cyber Security & Ethical Hacking',
                'course2': 'BSc (Hons) Cyber Security Engineer',
                'course3': 'Certified Computer Hacking Forensic Investigator',
                'course4': 'Executive Master of Science in Information Security',
                'course5': 'Master of Science in Cyber Security (MSc CS)'
            };

            if (studentDetails.error) {
                console.log(studentDetails.error);
                $('.details-container .details').html(`<span class="error-msg"><i class='fa-solid fa-circle-exclamation'></i> ${studentDetails.error}</span>`);
            } else {
                $('.details-container .details').html(
                    "ID: " + studentDetails.student_id + "<br>" +
                    "Name: " + studentDetails.name + "<br>" +
                    "NIC: " + studentDetails.nic + "<br>" +
                    "Address: " + studentDetails.address + "<br>" +
                    "Telephone: " + studentDetails.tel + "<br>" +
                    "Course: " + courseNames[studentDetails.course] // Display full course name
                );
                populateEditContainer(studentDetails);
                $('#edit-container').show();
                $('#student-id-display').text(studentDetails.student_id);
                $('#student-nic-display').text(studentDetails.nic);
                $('#student-info-container').show();
                $('#delete-btn').attr('onclick', 'deleteStudent(' + studentDetails.student_id + ')');
            }
            $('.image-container').addClass('searched');
        },
        error: function (xhr, status, error) {
            console.error("An AJAX error occurred: " + status + "\nError: " + error);
            $('.image-container').removeClass('searched');
            $('#edit-container').hide();
            $('#student-info-container').hide();
            $('#message-container').html(`<i class='fa-solid fa-circle-exclamation'></i> An AJAX error occurred: ${status}<br>Error: ${error}`).addClass('error-msg');
        }
    });
}

function populateEditContainer(studentDetails) {
    var courseNames = {
        'course1': 'Certificate in Cyber Security & Ethical Hacking',
        'course2': 'BSc (Hons) Cyber Security Engineer',
        'course3': 'Certified Computer Hacking Forensic Investigator',
        'course4': 'Executive Master of Science in Information Security',
        'course5': 'Master of Science in Cyber Security (MSc CS)'
    };

    var courses = ['course1', 'course2', 'course3', 'course4', 'course5'];
    var courseOptions = courses.map(function(course) {
        return `<option value="${course}" ${studentDetails.course === course ? 'selected' : ''}>${courseNames[course]}</option>`;
    }).join('');

    var editHtml = `
        <form id="edit-form">
            <input type="hidden" name="student_id" value="${studentDetails.student_id}" />
            
            <label for="name">Name:</label>
            <input type="text" name="name" value="${studentDetails.name}" />

            <label for="nic">NIC:</label>
            <input type="text" name="nic" value="${studentDetails.nic}" />

            <label for="address">Address:</label>
            <input type="text" name="address" value="${studentDetails.address}" />

            <label for="tel">Telephone:</label>
            <input type="text" name="tel" value="${studentDetails.tel}" />

            <label for="course">Course:</label>
            <select name="course">
                ${courseOptions}
            </select>
            
            <button type="submit">Save Changes</button>
        </form>
    `;

    $('#edit-container').html(editHtml); 
    $('#edit-container').hide();
    $('#student-info-container').hide();
}

$(document).on('submit', '#edit-form', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: 'edit.php',
        type: 'post',
        data: formData,
        success: function (response) {
            var data = JSON.parse(response);
            if (data.success) {
                console.log(data.success);
                $('#message-container').addClass('success-msg').html(`<i class='fa-solid fa-circle-check'></i> ${data.success}`);
                $('#edit-container').hide();
                $('#student-info-container').hide();
                searchStudent();
                $('.tabeledis').load('display_table.php');
            } else if (data.error) {
                console.error(data.error);
                $('#message-container').addClass('error-msg').html(`<i class='fa-solid fa-circle-exclamation'></i> ${data.error}`);
            }
        },
        error: function (xhr, status, error) {
            console.error("An AJAX error occurred: " + status + "\nError: " + error);
            $('#message-container').addClass('error-msg').html(`<i class='fa-solid fa-circle-exclamation'></i> An AJAX error occurred: ${status}<br>Error: ${error}`);
        }
    });
});

function deleteStudent(studentId) {
    if (confirm('Are you sure you want to delete this student?')) {
        $.ajax({
            url: 'delete.php',
            type: 'post',
            data: { student_id: studentId },
            success: function (response) {
                console.log('Delete request successful:', response);
                var data = JSON.parse(response);
                if (data.success) {
                    $('#message-container').addClass('success-msg').html(`<i class='fa-solid fa-circle-check'></i> ${data.success}`);
                    $('.details-container .details').empty();
                    $('#edit-container').hide();
                    $('#student-info-container').hide();
                    $('.tabeledis').load('display_table.php');
                } else if (data.error) {
                    console.error(data.error);
                    $('#message-container').addClass('error-msg').html(`<i class='fa-solid fa-circle-exclamation'></i> ${data.error}`);
                }
            },
            error: function (xhr, status, error) {
                console.error("An AJAX error occurred: " + status + "\nError: " + error);
            }
        });
    }
}


        </script>


</body>

</html>