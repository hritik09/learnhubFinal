
<html>
<head>
<title> LearnHub: Feedbacks</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<style type="text/css">
td
{
text-align: center;
}
</style>
</head>
<body>
<div align="left">
<h1 align="center">Feedbacks</h1><br /><br />

<?php

$con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  
  
  mysql_select_db("learnhub", $con);
  $query="Select event_feedback,event_date,userid from event natural join file where resp_eventid='$_GET[eventid]'";
  $result=mysql_query($query);
  while($row=mysql_fetch_array($result))
  {
	  if(isset($row['event_feedback']))
	  {
		  echo $row['event_date']."<hr />";
		  echo "<a target='_new' href='user.php?userid=".$row['userid']."' >".$row['userid']."</a>:  ";
		  echo $row['event_feedback']."<br /><br /><br />";
		  
	  }
	  
	  
  }


?>