<!DOCTYPE HTML>
<html>
    <head>
        <title> LearnHub Registration</title>
<?php
$con=mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect to the database: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);

$sql="INSERT INTO user (username, password, firstname, lastname, user_address, city, state, country, pincode, email, areacode, telephone, accountid, balance)
('$_POST[username]', md5('$_POST[password]'),'$_POST[fname]', '$_POST[lname]', '$_POST[addr]', '$_POST[city]', '$_POST[state]', '$_POST[country]', '$_POST[pcode]', '$_POST[email]', '$_POST[acode]', '$_POST[phno]', '$_POST[ano]', 0)";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con)
?> 
    </head>
</html>