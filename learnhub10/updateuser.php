<?php
$con=mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect to the database: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);

$query="update user_course set role='$_POST[role]' where courseid='$_POST[courseid]' and userid='$_POST[userid]'";
if(mysql_query($query))
{
echo "Action performed Successfully.Click here to ";
echo "<a href='timeline.php?courseid=".$_POST['courseid']."' target='action_frame'>continue</a>";

}




?>