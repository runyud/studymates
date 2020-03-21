<?php

$connect = new PDO('mysql:host=127.0.0.1;dbname=studymates', 'root', 'Ryud4@mysql');

$query = "
Create View View1 AS Select Distinct U1.name as U1_name, U1.email as U1_email, U2.name as U2_name, U2.email as U2_email From requests U1, requests U2 Where (U1.location = U2.location) AND U1.id < U2.id
";
// USE NESTED LOOPS
$query = "
Create View View2 As Select Distinct U1.name as U1_name, U1.email as U1_email From requests U1 UNION Select Distinct U2.name as U2_name, U2.email as U2_email From requests U2
";

// $query = "
// Select DISTINCT U1.name, U1.email, U2.name, U2.email From requests U1, requests U2 Where (U1.location = U2.location) AND U1.email != U2.email AND U1.id < U2.id Group by U1.name, U2.name
// ";


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["name"].'</b> on <i>'.$row["email"].'</i></div>
 </div>
 ';
}

echo $output;



?>