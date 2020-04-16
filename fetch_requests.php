<?php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require 'composer/vendor/autoload.php';

$mail = new PHPMailer(true);

$connect = new PDO('mysql:host=localhost;dbname=studymates', 'root', '');

$query3 = "
Select Distinct U1.location as u1_location, U1.open_from as u1_start, U1.open_until as u1_end, 
U2.open_from as u2_start,U2.open_until as u2_end, U1.name as U1_name, U1.email as U1_email, 
U2.name as U2_name, U2.email as U2_email, U1.Monday as u1_monday, U1.Tuesday as u1_tuesday, 
U1.Wednesday as u1_wednesday, U1.Thursday as u1_thursday, U1.Friday as u1_friday, 
U2.Monday as u2_monday, U2.Tuesday as u2_tuesday, U2.Wednesday as u2_wednesday, 
U2.Thursday as u2_thursday, U2.Friday as u2_friday From requests U1, requests U2 
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
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Tuesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Tuesday = 'All day'
    AND U2.Friday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Friday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Monday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.Friday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Tuesday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Tuesday = 'All day'
    AND U2.Wednesday = 'All day'
    AND U2.Friday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Tuesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.Friday = 'All day'
    AND U2.id < U1.id)
    OR
    (U1.location = U2.location 
    AND U2.Wednesday = 'All day'
    AND U2.Thursday = 'All day'
    AND U2.Friday = 'All day'
    AND U2.id < U1.id)
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
$u1_start = $row["u1_start"];
$u1_end = $row["u1_end"];
$u2_start = $row["u2_start"];
$u2_end = $row["u2_end"];
$u1_monday = $row['u1_monday'];
$u1_tuesday = $row['u1_tuesday'];
$u1_wednesday = $row['u1_wednesday'];
$u1_thursday = $row['u1_thursday'];
$u1_friday = $row['u1_friday'];
$u2_monday = $row['u2_monday'];
$u2_tuesday = $row['u2_tuesday'];
$u2_wednesday = $row['u2_wednesday'];
$u2_thursday = $row['u2_thursday'];
$u2_friday = $row['u2_friday'];
$email1 = $row["U1_email"];
$email2 = $row["U2_email"];
$user1 = $row["U1_name"];
$user2 = $row["U2_name"];
$location = $row['u1_location'];

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
    $mail->Body    = "Congratulations on finding a partner! Reach out to them ASAP to get started on your project! <br>
    <br> $user1 : $email1, willing to meet from $u1_start to $u1_end 
     <br> $user2 : $email2, willing to meet from $u2_start to $u2_end <br><br>
     Looks like you guys both prefer working on $location campus and can meet up at least 3/5 days of the work week <br>
     $user1: Monday: $u1_monday, Tuesday: $u1_tuesday, Wednesday: $u1_wednesday, Thursday: $u1_thursday, Friday: $u1_friday <br>
     $user2: Monday: $u2_monday, Tuesday: $u2_tuesday, Wednesday: $u2_wednesday, Thursday: $u2_thursday, Friday: $u2_friday <br>";
    
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
