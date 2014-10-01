<html>
<head>
<title> LearnHub: Updates</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center">
<h1>Updates</h1><br />
<?php
session_start();
 $con=mysql_connect("localhost","root","root");
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	


$query="Select courseid from user_course  where userid='$_SESSION[userid]'";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
  {
  	$query="Select event_date,event_type,coursename from event natural join course where courseid='$row[courseid]' and event_date>='$_SESSION[last_login]' and event_type in        	('EQCRE','EASNY','ELEFI','ELEVI') order by event_date ASC";
	 
  	$result1=mysql_query($query);
  	while($row1 = mysql_fetch_array($result1))
  	{  echo "<br />".$row['courseid']." : ".$row1['coursename']."  ";
		switch($row1['event_type'])
		{
		  case 'ELEFI':
		  	echo "A new lecture file was uploaded on ".$row1['event_date']."<br /><hr />";
			break;	
		  case 'ELEVI':
		  	echo "A new lecture video was added on ".$row1['event_date']."<br /><hr />";
			break;	
		 case 'EASNY':
		  	echo "A new assignemnet was added on ".$row1['event_date']."<br /><hr />";
			break;
		
		 case 'EQCRE':
		  	echo "A new quiz was added on ".$row1['event_date']."<br /><hr />";
			break;
		  case 'ETEST':
		  	echo "A new testimonial was written on ".$row1['event_date']."<br /><hr />";
			break;
		}
  		
  
  	}
  }
	
	


?>
</div>
</body>
</html>