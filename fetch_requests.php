<?php

$connect = new PDO('mysql:host=localhost;dbname=studymates', 'root', '');

$query = "
Create View View1 AS Select Distinct U1.name as U1_name, U1.email as U1_email, U2.name as U2_name, U2.email as U2_email From requests U1, requests U2 Where (U1.location = U2.location) AND U1.id < U2.id
	Limit 1
";
// USE NESTED LOOPS


// $query = "
// Select DISTINCT U1.name, U1.email, U2.name, U2.email From requests U1, requests U2 Where (U1.location = U2.location) AND U1.email != U2.email AND U1.id < U2.id Group by U1.name, U2.name
// ";


$statement = $connect->prepare($query);

$statement->execute();

$query = "
Select * From View1
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["U1_name"].'</b> on <i>'.$row["U1_email"].''.$row["U2_name"].''.$row["U2_email"].'</i></div>
 </div>
 ';
}

echo $output;

if (count($result) != 0) {
$deleted_user1 = $row["U1_name"];
$deleted_user2 = $row["U2_name"];
$query = "
Delete From requests Where name IN ('$deleted_user1', '$deleted_user2')
";

$statement = $connect->prepare($query);
$statement->execute();
}

?>