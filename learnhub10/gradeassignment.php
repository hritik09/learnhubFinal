<html>
<head>
<title> LearnHub: Grade Assignment</title>
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
<h1> Grade Assignments </h1><hr /><br />


<?php
$con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;
		
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	
	$query="select eventid,event_name from event where event_type='EASNY' and courseid='$_GET[courseid]'";
	$result=mysql_query($query);
	echo "<table width=100%>";
	echo "<tr><td style='font-size: 20px; text-align: left;'>Assignment Name</td><td width='1' bgcolor='blue'><BR></td><td style='font-size: 20px;'>Action</td></tr><tr><td><hr /></td><td><hr /></td><td><hr /></td></tr>";
	while($row=mysql_fetch_array($result))
	{
		echo "<tr><td style='text-align: left;'> <a href='EASNY.php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' target='action_frame' >".$row['event_name']."</a></td><td width='1' bgcolor='blue'><BR></td>";
		echo "<td> <a href='assignmentgrade.php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' target='action_frame' >Grade</a></td>";
		echo "</tr>";
    }
   echo "</table>";


?>
</div>
</body>
</html>