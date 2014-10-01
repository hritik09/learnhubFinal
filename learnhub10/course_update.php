<!DOCTYPE HTML>
<html>
    <head>
        <title> LearnHub Registration</title>
<?php
session_start();
$con = mysql_connect("localhost" , "root", "root");
if (!$con)
  {
  die('Could not connect to the database: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);



$mydate1 = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
$mydate2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
$sql="update course set  coursename= '$_POST[coursename]', course_startdate='$_REQUEST[date3]', course_enddate='$_REQUEST[date4]', course_category='$_POST[course_category]' where courseid='$_POST[courseid]'";
mysql_query($sql,$con);

$query="select eventid from event  where courseid='$_POST[courseid]' and due_date >'$_REQUEST[date4]'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	 $query1="update event set due_date='$_REQUEST[date4]' where eventid='$row[eventid]'";
	mysql_query($query);
	
	
}




$data['course_id']=$_POST['courseid'];
$data['course_name']=$_POST['coursename'];
$data['course_startdate']=$_REQUEST['date3'];
$data['course_enddate']=$_REQUEST['date4'];
$data['course_category']=$_POST['course_category'];

$data['course_description']=$_POST['course_description'];
$data['course_owner']=$_SESSION['userid'];


$name=$_POST['fileid'].".json"; 
$json_data=json_encode($data);
 $json_data;
$link="user\\".$_SESSION['userid']."\\".$name;
$file=fopen($link,"w");
fwrite($file,$json_data);
	fclose($file);






mysql_close($con)
?> 
The event has been edited successfully. Click here to <a href="timeline.php?courseid=<?php echo $_POST['courseid'];?>" target="action_frame">continue</a>;
    </head>
</html>
