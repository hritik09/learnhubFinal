<?php
ob_start();
session_start();
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);

$query="Select course_paid,Fees from course where courseid='$_GET[courseid]'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$dat=date("Y/m/d");
if($row['course_paid']==1)
{   header("Location: payment.php?courseid=$_GET[courseid]");
	
	
	
	
}
else
{
	$query="insert into user_course values ('Student','$dat','$_GET[courseid]','$_SESSION[userid]','Pending',0)";
  if (!mysql_query($query,$con))
  {
  die('Error: ' . mysql_error());
  }
  else {
	  $head="Location: course.php?courseid=".$_GET['courseid'];
    header($head);
	
  }
}


ob_end_flush();
?>