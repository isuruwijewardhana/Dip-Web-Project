<?php
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$email_from = 'Ignova@Uniwebsite.com' ;
$email_subject = 'New Form Submission' ;
$email_body = "User Name: $name.\n".
              "User Eamil: $visitor_email.\n".
              "Subject: $subject.\n".
              "User Message: $message.\n";

$to ='';

$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\rn";

mail($to,$email_subject,$email_body,$headers);

header("Location: Contact.html")

?>