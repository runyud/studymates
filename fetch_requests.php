<?php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require 'composer/vendor/autoload.php';

$mail = new PHPMailer(true);

$connect = new PDO('mysql:host=localhost;dbname=studymates', 'root', '');

$query3 = "
Select Distinct U1.name as U1_name, U1.email as U1_email, U2.name as U2_name, U2.email as U2_email From requests U1, requests U2 
Where (U1.location = U2.location 
    AND U1.Monday = U2.Monday
    AND U1.Tuesday = U2.Tuesday
    AND U1.Wednesday = U2.Wednesday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = U2.Monday
    AND U1.Tuesday = U2.Tuesday
    AND U1.Thursday = U2.Thursday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = U2.Monday
    AND U1.Tuesday = U2.Tuesday
    AND U1.Friday = U2.Friday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = U2.Monday
    AND U1.Wednesday = U2.Wednesday
    AND U1.Thursday = U2.Thursday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = U2.Monday
    AND U1.Wednesday = U2.Wednesday
    AND U1.Friday = U2.Friday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = U2.Monday
    AND U1.Thursday = U2.Thursday
    AND U1.Friday = U2.Friday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Tuesday = U2.Tuesday
    AND U1.Wednesday = U2.Wednesday
    AND U1.Thursday = U2.Thursday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Tuesday = U2.Tuesday
    AND U1.Wednesday = U2.Wednesday
    AND U1.Friday = U2.Friday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Tuesday = U2.Tuesday
    AND U1.Thursday = U2.Thursday
    AND U1.Friday = U2.Friday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Wednesday = U2.Wednesday
    AND U1.Thursday = U2.Thursday
    AND U1.Friday = U2.Friday
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = 'All day'
    AND U1.Tuesday = 'All day'
    AND U1.Wednesday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = 'All day'
    AND U1.Tuesday = 'All day'
    AND U1.Thursday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = 'All day'
    AND U1.Tuesday = 'All day'
    AND U1.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = 'All day'
    AND U1.Wednesday = 'All day'
    AND U1.Thursday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = 'All day'
    AND U1.Wednesday = 'All day'
    AND U1.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Monday = 'All day'
    AND U1.Thursday = 'All day'
    AND U1.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Tuesday = 'All day'
    AND U1.Wednesday = 'All day'
    AND U1.Thursday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Tuesday = 'All day'
    AND U1.Wednesday = 'All day'
    AND U1.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Tuesday = 'All day'
    AND U1.Thursday = 'All day'
    AND U1.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U1.Wednesday = 'All day'
    AND U1.Thursday = 'All day'
    AND U1.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Tuesday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Tuesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Tuesday = 'All day'
    AND U2.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Tuesday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Tuesday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Tuesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.Friday = 'All day'
    AND U1.id < U2.id)
    OR
    (U1.location = U2.location 
    AND U2.Wednesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.Friday = 'All day'
    AND U1.id < U2.id)
    Limit 1
";


$statement = $connect->prepare($query3);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
}

if (count($result) != 0) {
$email1 = $row["U1_email"];
$email2 = $row["U2_email"];
$user1 = $row["U1_name"];
$user2 = $row["U2_name"];
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'StudyMatesMod@gmail.com';                     // SMTP username
    $mail->Password   = 'StudyMates2020';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('StudyMates@umich.edu', 'StudyMates');
    //$mail->addAddress('itsye', 'Joe User');     // Add a recipient
    $mail->addAddress($email1);
    $mail->addAddress($email2);               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'StudyMates Partners Matched!';
    $mail->Body    = "Congratulations on finding a partner! Reach out to them ASAP to get started on your project! <br><br> $user1 : $email1 <br> $user2 : $email2";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'You are matched!! Wait for an email. . .';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$query = "
Delete From requests Where name IN ('$user1', '$user2')
";

$statement = $connect->prepare($query);
$statement->execute();
}

?>
