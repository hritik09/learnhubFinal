
<html>
<head>
<title> LearnHub: Edit Event</title>
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
<h1> Edit Events </h1><hr /><br />
<?php

$con=mysql_connect("localhost","root","root");
	mysql_select_db("learnhub");
	
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
$query="select event_name,eventid,event_type from event where courseid='$_GET[courseid]' and event_type in ('EQCRE','EASNY','ELEFI','ELEVI')";
$result=mysql_query($query);
echo "<table style='width: 100%;'>";
while($row=mysql_fetch_array($result))
{ echo "<tr>";
  echo "<td style='text-align: left;'>";
  if ($row['event_type']=='ELEFI')
    {
        echo "Lecture File: ";
        echo "<a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br />";
		echo "</td><td width='1' bgcolor='blue'><BR></td>";
  		echo "<td>";
  		echo "<a target='action_frame' href='editlecturefile.php?eventid=".$row['eventid']."'> Edit </a><br />";
  		echo "</td><td width='1' bgcolor='blue'><BR></td>";
    }
    elseif ($row['event_type']=='ELEVI')
    {
        echo "Lecture Video: ";
        echo "<a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br />";
		echo "</td><td width='1' bgcolor='blue'><BR></td>";
  		echo "<td>";
  		echo "<a target='action_frame' href='editlecturefile.php?eventid=".$row['eventid']."'> Edit </a><br />";
  		echo "</td><td width='1' bgcolor='blue'><BR></td>";
    }
    elseif ($row['event_type']=='EASNY')
    {
        echo "Assignment: ";
        echo "<a target='action_frame' href='EASNY.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br />";
		echo "</td><td width='1' bgcolor='blue'><BR></td>";
		echo "<td>";
  		echo "<a target='action_frame' href='editassignment.php?eventid=".$row['eventid']."'> Edit </a><br />";
  		echo "</td><td width='1' bgcolor='blue'><BR></td>";
    }
    elseif ($row['event_type']=='EQCRE')
    {
        echo "Quiz: ";
        echo "<a target='action_frame' href='EQCRE.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br />";
		 echo "</td><td width='1' bgcolor='blue'><BR></td><td> - </td><td width='1' bgcolor='blue'><BR></td>";
		
    }

 
  
  echo "<td>";
  echo "<a target='action_frame' href='delete.php?eventid=".$row['eventid']."&courseid=".$_GET['courseid']."'>Delete</a><br />";
  echo "</td>";
 
  echo "</tr>";
	
}

echo "</table>";



?>
</div>
</body>
</html>