<?php

$connect = new PDO('mysql:host=127.0.0.1;dbname=studymates', 'root', 'Ryud4@mysql');

$error = '';
$user_name = '';
$user_email = '';
$location = '';
$open_from = '';
$open_until = '';
//$comment_name = '';
//$comment_content = '';

if(empty($_POST["user_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $user_name = $_POST["user_name"];
}

if(empty($_POST["user_email"]))
{
 $error .= '<p class="text-danger">Email is required</p>';
}
else
{
 $user_email = $_POST["user_email"];
}

if(empty($_POST["location"]))
{
	$error .= '<p class="text-danger">Location Preference is required</p>';
}
else 
{
	$location = $_POST["location"];
}

if(empty($_POST["open_from"]))
{
	$error .= '<p class="text-danger">Availability is required</p>';
}
else
{
	$open_from = $_POST["open_from"];
}

if(empty($_POST["open_until"]))
{
	$error .= '<p class="text-danger">Availability is required</p>';
}
else
{
	$open_until = $_POST["open_until"];
}

if($error == '')
{
 $query = "
 INSERT INTO requests 
 (name, email, location, open_from, open_until) 
 VALUES (:name, :email, :location, :open_from, :open_until)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':name' => $_POST['user_name'],
   ':email'    => $_POST['user_email'],
   ':location' => $_POST['location'],
   ':open_from' => $_POST['open_from'],
   ':open_until' => $_POST['open_until']
  )
 );
 $error = '<label class="text-success">Matching Request Sent</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>