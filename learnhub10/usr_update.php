<?php

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
session_start();

$query1="Select * from user_course where courseid='$_SESSION[temp]' and role='Student' and status='Pending'";
$sql1=mysql_query($query1);


while($row=mysql_fetch_array($sql1))
{   $t="$row[userid]";
   if(isset($_POST[$t]))
   { 
    $_POST[$t];
   $query="update user_course set status='$_POST[$t]' where userid='$row[userid]'";
   mysql_query($query);
   }



}
?>
