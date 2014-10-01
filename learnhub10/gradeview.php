<html>
<head>
<title> LearnHub: Gradebook</title>
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
<h1> Gradebook</h1><hr /><br />

<?php
$con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;
		
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	
	$query="select eventid,event_name,event_type from event where event_type in ('EASNY','EQCRE') and courseid='$_GET[courseid]'";
	$result=mysql_query($query);
	echo "<table width=100%>";
	echo "<tr><td style='font-size: 20px; text-align: left;'>Event Name</td><td width='1' bgcolor='blue'><BR></td><td style='font-size: 20px;'>Action</td></tr><tr><td><hr /></td><td><hr /></td><td><hr /></td></tr>";
	while($row=mysql_fetch_array($result))
	{
		echo "<tr><td style='text-align: left;'> <a href='".$row['event_type'].".php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' target='action_frame' >".$row['event_name']."</a></td><td width='1' bgcolor='blue'><BR></td>";
		echo "<td> <a href='viewgrade.php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' target='action_frame' >View</a></td>";
		echo "</tr>";
    }
   echo "</table>";


?>
</div>
</body>
</html>