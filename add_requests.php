<?php

$connect = new PDO('mysql:host=localhost ;dbname=studymates', 'root', '');

$error = '';
$user_name = '';
$user_email = '';
$location = '';
$open_from = '';
$open_until = '';
$Monday = '';
$Tuesday = '';
$Wednesday = '';
$Thursday = '';
$Friday = '';
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

if(empty($_POST["Monday"]))
{
  $error .= '<p class="text-danger">Availability is required</p>';
}
else
{
  $Monday = $_POST["Monday"];
}

if(empty($_POST["Tuesday"]))
{
  $error .= '<p class="text-danger">Availability is required</p>';
}
else
{
  $Tuesday = $_POST["Tuesday"];
}

if(empty($_POST["Wednesday"]))
{
  $error .= '<p class="text-danger">Availability is required</p>';
}
else
{
  $Wednesday = $_POST["Wednesday"];
}

if(empty($_POST["Thursday"]))
{
  $error .= '<p class="text-danger">Availability is required</p>';
}
else
{
  $Thursday = $_POST["Thursday"];
}

if(empty($_POST["Friday"]))
{
  $error .= '<p class="text-danger">Availability is required</p>';
}
else
{
  $Friday = $_POST["Friday"];
}

if($error == '')
{
 $query = "
 INSERT INTO requests 
 (name, email, location, open_from, open_until, Monday, Tuesday, Wednesday, Thursday, Friday) 
 VALUES (:name, :email, :location, :open_from, :open_until, :Monday, :Tuesday, :Wednesday, :Thursday, :Friday)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':name' => $user_name,
   ':email'    => $user_email,
   ':location' => $location,
   ':open_from' => $open_from,
   ':open_until' => $open_until,
   ':Monday' => $Monday,
   ':Tuesday' => $Tuesday,
   ':Wednesday' => $Wednesday,
   ':Thursday' => $Thursday,
   ':Friday' => $Friday
  )
 );
 $error = '<label class="text-success"></label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
