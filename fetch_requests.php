<?php

$connect = new PDO('mysql:host=localhost;dbname=studymates', 'root', '');

$query = "
Create View View1 AS Select Distinct U1.name as U1_name, U1.email as U1_email, U2.name as U2_name, U2.email as U2_email From requests U1, requests U2 Where (U1.location = U2.location) AND U1.id < U2.id Limit 1
";

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

// function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
// {
//  $query = "
//  SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
//  ";
//  $output = '';
//  $statement = $connect->prepare($query);
//  $statement->execute();
//  $result = $statement->fetchAll();
//  $count = $statement->rowCount();
//  if($parent_id == 0)
//  {
//   $marginleft = 0;
//  }
//  else
//  {
//   $marginleft = $marginleft + 48;
//  }
//  if($count > 0)
//  {
//   foreach($result as $row)
//   {
//    $output .= '
//    <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
//     <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//     <div class="panel-body">'.$row["comment"].'</div>
//     <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
//    </div>
//    ';
//    $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
//   }
//  }
//  return $output;
// }



?>