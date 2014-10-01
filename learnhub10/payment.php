<?php
ob_start();
session_start();
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);

$query="Select * from course where courseid='$_GET[courseid]'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$dat=date("Y/m/d");

if(isset($_GET['response']))
{
	if($_GET['response']==1)
	{
	$query="insert into user_course values ('Student','$dat','$_GET[courseid]','$_SESSION[userid]','Approved',0)";
	if (!mysql_query($query,$con))
    {
      die('Error: ' . mysql_error());
    }
    else {echo "Your payment has been succesfully made. You have been registered for this course";
	      echo "<a href=\"course.php?courseid=$_GET[courseid]\">Click here to continue</a> ";
	
		}
		
	}
	else
	{
	header("Location: course.php?courseid=$_GET[courseid]");	
   }
	
	
}
else
{
	echo "<iframe frameborder=\"0\" src=\"course_desc.php?courseid=$_GET[courseid]\" height=\"300\" width=\"700\"></iframe>";
	echo "<div><p>Are you sure u want to to make the payment?</p><a href=\"payment.php?courseid=$_GET[courseid]&response=1\">Yes </a> 
	<a href=\"payment.php?courseid=$_GET[courseid]&response=0\">NO </a> </div>";
	
}

ob_end_flush();
?>
