<html>
<head>
<title> LearnHub: Timeline</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div>
<?php
echo "<h1 align='center'> Timeline </h1>";
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$nam = mysql_query("SELECT eventid,event_type,event_name,event_date,due_date FROM event  where courseid='$_GET[courseid]' and event_type in ('ELEFI','ELEVI','EASNY','EQCRE') order by event_date ");
while($row = mysql_fetch_array($nam)) 
  {
	  echo $row['event_date']."<hr />";
    if ($row['event_type']=='ELEFI')
    {
        echo "Lecture File: ";
        echo "<a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br />";
    }
    elseif ($row['event_type']=='ELEVI')
    {
        echo "Lecture Video: ";
        echo "<a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br />";
    }
    elseif ($row['event_type']=='EASNY')
    {
        echo "Assignment: ";
        echo "<a target='action_frame' href='EASNY.php?eventid=".$row['eventid']."'>".$row['event_name']."</a><br /><br />   Assignment due on  ".$row['due_date']."<br />";
    }
    elseif ($row['event_type']=='EQCRE')
    {
        echo "Quiz: ";
        echo "<a target='action_frame' href='EQCRE.php?eventid=".$row['eventid']."&courseid=".$_GET['courseid']."'>".$row['event_name']."</a><br /><br /> Quiz due on ".$row['due_date']."<br /";
    }
	echo "<br /><br />";
  }
mysql_close($con);
?>
</div>
</body>
</html>