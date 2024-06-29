<?php

$con = new mysqli('localhost', 'root', '', 'icampusdb');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$courseNames = array(
    'course1' => 'Certificate in Cyber Security & Ethical Hacking',
    'course2' => 'BSc (Hons) Cyber Security Engineer',
    'course3' => 'Certified Computer Hacking Forensic Investigator',
    'course4' => 'Executive Master of Science in Information Security',
    'course5' => 'Master of Science in Cyber Security (MSc CS)'
);

$result = $con->query("SELECT * FROM student_details WHERE usertype='user'");

if ($result->num_rows > 0) {
    echo "<div class='tabledis'><table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>";
    while($row = $result->fetch_assoc()) {
        
        $course = isset($courseNames[$row['course']]) ? $courseNames[$row['course']] : $row['course'];
        
        echo "<tr>
                <td>".$row['student_id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['nic']."</td>
                <td>".$row['address']."</td>
                <td>".$row['tel']."</td>
                <td>".$course."</td>
              </tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<div class='tabledis'>0 results</div>";
}

$con->close();
?>
