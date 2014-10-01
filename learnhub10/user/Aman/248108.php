<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learhub", $con);
$nam = mysql_query("SELECT * FROM event natural join file natural join course where courseid=10000 and ((event_date >= course_creationdate) and (event_date <= current_date))");
$dat=0;
while($row = mysql_fetch_array($nam))
//$row = mysql_fetch_a                                                                                              
//rray($nam);
{
    if($row['event_date']!=$dat)
        echo $row['event_date'];
    echo "<br />";
  echo $row['filename'];
  echo "<br />";
  $dat=$row['event_date'];
  }
mysql_close($con);
?> 