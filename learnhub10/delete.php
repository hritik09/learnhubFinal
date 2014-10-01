<?php
if(isset($_GET['confirm']))
{
	if($_GET['confirm']==1)
	{
		$con=mysql_connect("localhost","root","root");
	mysql_select_db("learnhub");
	
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
     $query="delete from event where eventid='$_GET[eventid]'";
	 mysql_query($query);
$query="delete from event where resp_eventid='$_GET[eventid]'";
	mysql_query($query);
	 echo "The event has been deleted successfully.Click here to <a href=\"timeline.php?courseid=".$_GET['courseid']."\" target=\"action_frame\">continue</a>";	
		
	}
	
	
	
}
else
{
echo "Are you sure you want to delete the event ";
echo "<a target='action_frame' href='delete.php?eventid=".$_GET['eventid']."&courseid=".$_GET['courseid']."&confirm=1'> Yes </a><br />";
echo "<a target='action_frame' href='course.php?courseid=".$_GET['courseid']."> No </a><br />";
 	
	
}






?>