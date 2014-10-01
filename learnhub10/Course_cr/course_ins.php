<!DOCTYPE HTML>
<html>
    <head>
        <title> LearnHub Registration</title>
<?php
$con = mysql_connect("localhost" , "root", "root");
if (!$con)
  {
  die('Could not connect to the database: ' . mysql_error());
  }

mysql_select_db("learhub", $con);

$fid=rand(1,999999);
	
	$query="SELECT fileid FROM file where fileid='$fid'";
	$result=mysql_query($query);
	
	while($row=mysql_fetch_array($result))
	{
		
			$fid=rand(1,999999);
		    $result=mysql_query($query);
		
	}

$cid=rand(1,999999);
	
	$query="SELECT courseid FROM file where courseid='$cid'";
	$result=mysql_query($query);

	while($row=mysql_fetch_array($result))
	{
		
			$cid=rand(1,999999);
		    $result=mysql_query($query);
		
	}

$eid=rand(1,999999);
	
	$query="SELECT eventid FROM file where eventid='$eid'";
	$result=mysql_query($query);

	while($row=mysql_fetch_array($result))
	{
		
			$eid=rand(1,999999);
		    $result=mysql_query($query);
		
	}
$dat=date("Y/m/d");
$mydate1 = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
$mydate2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";

$paid = 0;

$selected_radio = $_POST['paid'];

if ($selected_radio == 'yes') {
$paid=1;
}
else if ($selected_radio == 'no') {
$paid=0;
}
        
        
$sql="INSERT INTO course (courseid,coursename, course_creationdate, course_startdate, course_enddate, course_paid, course_category)
VALUES
('$cid', '$_POST[course_name]','$dat', '$_REQUEST[date3]', '$_REQUEST[date4]', $paid, '$_POST[course_category]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
  $sql="INSERT INTO event (eventid,courseid,fileid,event_date, )
VALUES
('$eid','$cid','$fid','$dat' )";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="INSERT INTO user_course 
VALUES
('Owner','$dat','$cid','$_SESSION[userid]','Approved',0 )";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  $name="ECOCR_".$fid.".json";
$sql="INSERT INTO file
VALUES
('$fid','$_SESSION[userid]','$name' )";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";
$data['course_id']=$cid;
$data['course_name']=$_POST['course_name'];
$data['course_startdate']=$_REQUEST['date3'];
$data['course_enddate']=$_REQUEST['date4'];
$data['course_category']=$_POST['course_category'];
$data['paid']=$_POST['paid'];
$data['course_description']=$_POST['course_description'];
$data['course_owner']=$_SESSION['userid'];

$json_data=json_encode($data);
$link="user/".$_SESSION['userid']."/".$name;
$file=fopen($link,"w");
fwrite($file,$json_data);
	fclose($file);





mysql_close($con)
?> 
    </head>
</html>
