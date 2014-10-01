
<?php
 $con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$query="Select role,status from user_course where courseid='$_GET[courseid]' and userid='$_SESSION[userid]'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if(!isset($row['role']) )
{
	echo "<a href=\"register.php?courseid=".$_GET['courseid']."\"   >Register for course</a>";
	
	
}
if( $row['status']=="Pending")
{
	
echo "Your registeration of the course is pending approval from the adminstration of the course";
}
?>


