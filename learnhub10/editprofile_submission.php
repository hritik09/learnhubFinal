<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$rad=$_GET['us'];
$query1="Select * from user where userid='$rad'";
$sql=mysql_query($query1);
while($row=mysql_fetch_array($sql))
{
        $query="UPDATE user SET firstname='$_GET[fnam]', lastname='$_GET[lnam]', user_address='$_GET[addr]', city='$_GET[ct]', state='$_GET[stat]', country='$_GET[count]', pincode='$_GET[pc]', email='$_GET[em]', areacode='$_GET[arc]', telephone='$_GET[tel]', accountid='$_GET[accid]', security_ques='$_GET[secq]', security_ans='$_GET[seca]' where userid='$rad'";
        if (!mysql_query($query,$con))
        {
            die('Error: ' . mysql_error());
        }
            echo "Your profile has been successfully updated.";
}

?>
Click here <a href="updates.php" target="action_frame">continue</a>