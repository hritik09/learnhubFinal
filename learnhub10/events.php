<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
	function redirectTo(courseid)
	{
		location.href="course.php?courseid="+courseid;

	}
</script>
</head>

<body>
<?php
	session_start();
	mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;
		
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	$userid=$_SESSION['userid'];                                ///This to be created has a session variable to obtain his id when that user is opeating
	$day=$_GET['day'];
	$month=$_GET['month'];
	$year=$_GET['year'];
	$courseid=$_GET['courseid'];
	$datestamp=mktime(0,0,0,$month,$day,$year);
	$date=date('Y-m-d',$datestamp);
	//if(isset($_GET['courseid']))
	//{    echo "course";
	//	$courses[0]=$_GET['courseid'];
	//}
	if($courseid==0)
	{
	 $query="SELECT courseid FROM user_course where userid='$userid'";	
	$result=mysql_query($query) or die("Error executing query:".mysql_error());
	while($row=mysql_fetch_array($result))
	{  
		
		$courses[]=$row[0];
	}
	foreach($courses as $courseid)
	{
	 $query="SELECT eventid,event_name,event_date,due_date,coursename,event_type FROM event natural join course where courseid='$courseid' and due_date like '$date%' and event_type in        	('EQCRE','EASNY','ELEFI','ELEVI')";
	$result=mysql_query($query) or die("Error executing a query");
	$counts=mysql_num_rows($result);
	$query2="SELECT coursename from course where courseid='$courseid'";
	$result2=mysql_query($query2) or die("Error executing a query");
	$row=mysql_fetch_array($result2);
	if($counts>0)
	echo "<a target='_parent' href='course.php?courseid=".$courseid."'>".$row[0]."</a>";
	while($row=mysql_fetch_array($result))
	{
		switch($row['event_type'])
			{
				case 'ELEFI':
			  	echo "<p>A new lecture file is available <a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a></p>";
				break;	
			  case 'ELEVI':
			  	echo "<p>A new lecture video is available <a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a></p>";
				break;	
			 case 'EASNY':
			  	echo "<a target='action_frame' href='EASNY.php?eventid=".$row['eventid']."'>".$row['event_name']."</a> assignmnet is due.</p>";
				break;
		
			 case 'EQCRE':
			  	echo "<p><a target='action_frame' href='EQCRE.php?eventid=".$row['eventid']."&courseid=".$_GET['courseid']."'>".$row['event_name']."</a> quiz is due.</p>";
			
			
			
			
		}
		
		
	}
	
	}
	
	}
	else
	{
			$query="SELECT eventid,event_name,event_date,due_date,coursename,event_type FROM event natural join course where courseid='$courseid' and due_date like '$date%' and event_type in        	('EQCRE','EASNY','ELEFI','ELEVI')";
			$result=mysql_query($query) or die("Error executing a query");
			$counts=mysql_num_rows($result);
			$query2="SELECT coursename from course where courseid='$courseid'";
			$result2=mysql_query($query2) or die("Error executing a query");
			$row=mysql_fetch_array($result2);
			while($row=mysql_fetch_array($result))
			{
			switch($row['event_type'])
			{
				case 'ELEFI':
			  	echo "<p>A new lecture file is available <a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a></p>";
				break;	
			  case 'ELEVI':
			  	echo "<p>A new lecture video is available <a target='action_frame' href='ELEFI.php?eventid=".$row['eventid']."'>".$row['event_name']."</a></p>";
				break;	
			 case 'EASNY':
			  	echo "<a target='action_frame' href='EASNY.php?eventid=".$row['eventid']."'>".$row['event_name']."</a> assignmnet is due.</p>";
				break;
		
			 case 'EQCRE':
			  	echo "<p><a target='action_frame' href='EQCRE.php?eventid=".$row['eventid']."&courseid=".$_GET['courseid']."'>".$row['event_name']."</a> quiz is due.</p>";
			
			
			
			
			}
			}
	}
?>
</body>
</html>