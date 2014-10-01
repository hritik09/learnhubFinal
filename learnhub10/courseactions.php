

<body>

<?php

  $con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);

$query="select role,status from user_course where userid='$_SESSION[userid]' and courseid='$_GET[courseid]'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if($row['role']=='Owner')
{
	echo "<p><a href=\"Manageusers.php?courseid=".$_GET['courseid']."\" target=\"action_frame\"> Manage Users</a></p>";
	echo "<p><a href=\"Managecourse.php?courseid=".$_GET['courseid']."\" target=\"action_frame\"> Edit Course</a></p>";

}

if($row['role']=='Owner' || $row['role']=='Admin'  )
	{echo "<p><a href=\"Createevent.php?courseid=".$_GET['courseid']."\" target=\"action_frame\"> Create an event</a></p>";
	echo "<p><a href=\"edit.php?courseid=".$_GET['courseid']."\" target=\"action_frame\"> Edit an event</a></p>";
	echo "<p><a href=\"gradeassignment.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">Grade Assignment</a></p>";
	echo "<p><a href=\"viewfeedback.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">View feedback</a></p>";
	echo "<p><a href=\"gradeview.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">View Gradebook</a></p>";
	echo "<p><a href=\"timeline.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">View Timeline</a></p>";
	
	

}
if($row['role']=='Student' && $row['status']=='Approved')
{
	
	echo "<p><a href=\"Viewgradebookusercourse.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">View gradebook</a></p>";
	echo "<p><a href=\"timeline.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">View Timeline</a></p>";
	
	}
?>



</body>
