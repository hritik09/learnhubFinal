<html>
<head>
<title> LearnHub: Create Event</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php

$con=mysql_connect("localhost","root","root") or die("Error connecting a database".mysql_error());
mysql_select_db("learnhub");
$result=mysql_query("SELECT course_startdate,course_enddate from course  where courseid='$_GET[courseid]'") or die("Error executing a query".mysql_error());
$row=mysql_fetch_array($result);

$stdate=substr($row['course_startdate'],0,strpos($row['course_startdate'],' '));
$spdate=substr($row['course_enddate'],0,strpos($row['course_enddate'],' '));
$cur=date('Y-m-d');
if($stdate<=$cur && $cur<=$spdate)
{
echo "<h1 align='center'>Create Event</h1><br />";
echo"<a href=\"createquiz.php?courseid=".$_GET['courseid']."\" target=\"action_frame\" >Create Quiz</a><br /><br /><hr /><br />";
echo"<a href=\"createlecture.php?courseid=".$_GET['courseid']."\" target=\"action_frame\" >Create Lecture</a><br /><br /><hr /><br />";
echo"<a href=\"createassignment.php?courseid=".$_GET['courseid']."\" target=\"action_frame\" >Create Assignment</a><br /><br /><hr /><br />";
}
else
{
	
echo "Course has ended or has not begun, so a new event can not be added";	
	
}
?>
</body>
</html>