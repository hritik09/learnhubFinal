<?php

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
 $rad=$_POST['us'];
 $query1="Select * from user where userid='$rad'";
$sql=mysql_query($query1);
while($row=mysql_fetch_array($sql))
{     $pass1=md5($_POST['old_pass']);
        $pass2="$pass1";
	  ;
        if($pass2==$row['password'])
        {$pass2=md5($_POST['pass']);
         $query="UPDATE user SET password='$pass2' where userid='$rad'";
        if (!mysql_query($query,$con))
        {
            die('Error: ' . mysql_error());
        }
            echo "Password changed successfully";
        }
        else
        {
            die("Current  Password incorrect");
        }
}
?>
