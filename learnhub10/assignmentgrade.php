<html>
<head>
<title> LearnHub: Grade</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<style type="text/css">
td
{
text-align: center;
}
</style>
</head>
<body>
<div align="center">
<h1> Grade</h1><hr /><br />

<?php

$con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  $course=$_GET['courseid'];
  $res=$_GET['eventid'];
  mysql_select_db("learnhub", $con);
  $query="Select * from event natural join file where resp_eventid='$res' and courseid='$course'";
  $sql=mysql_query($query);
   echo"
       <form action='grad_submission.php' method='POST'>
        <table width=100%>
              <tr>
              <td style='font-size: 20px; text-align: left;'>User Name</td><td width='1' bgcolor='blue'><BR></td>
              <td style='font-size: 20px;'>File</td><td width='1' bgcolor='blue'><BR></td>
              <td style='font-size: 20px;'>Grade</td>
              </tr><tr><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td></tr>
             ";
			 
   while($row=mysql_fetch_array($sql))
   {
	   $ext=strpos($row['filename'],".");
	    $ext=substr($row['filename'],$ext);
   echo "
              <tr>
              <tr><td style='text-align: left;'> <a target='_new' href='user.php?userid=".$row['userid']."' target='_new' >".$row['userid']."</a></td><td width='1' bgcolor='blue'><BR></td>
                  <td><a href='Downloading.php?link=user/".$row['userid']."/".$row['fileid'].$ext."&file=".$row['filename']."'>".$row['filename']."</a></td><td width='1' bgcolor='blue'><BR></td>
                      <td><input type='text' name='".$row['eventid']."' value='".$row['event_eval']."'/></td>";
   echo "</tr>";
  }
  echo "</table>";
  echo "<input type='hidden' value='$res' name='resp_eventid'>";
  echo "<input type='Submit' value='Submit' /></form>";
?>
