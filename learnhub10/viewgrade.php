<html>
<head>
<title> LearnHub: Event Grade</title>
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
<h1 align="center">Event Grade</h1><br /><br />

<?php
$con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;
		
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	
 $query="select userid,event_eval from event natural join file where resp_eventid='$_GET[eventid]'";
	$result=mysql_query($query);
	echo "<table width=100%>";
	echo "<tr><td style='font-size: 20px; text-align: left;'>User Name</td><td width='1' bgcolor='blue'><BR></td><td style='font-size: 20px;'>Grade</td></tr><tr><td><hr /></td><td><hr /></td><td><hr /></td></tr>";
	while($row=mysql_fetch_array($result))
	{
		echo "<tr><td style='text-align: left;'> <a target='_new' href='user.php?userid=".$row['userid']."' target='action_frame' >".$row['userid']."</a></td><td width='1' bgcolor='blue'><BR></td>";
		if(isset($row['event_eval']))
		{
		echo "<td>$row[event_eval]</td>";}
		else
		{echo "<td>Not Graded Yet</td>";}
		echo "</tr>";
    }
   echo "</table>";


?>