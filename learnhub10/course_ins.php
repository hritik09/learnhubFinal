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
 
$fid=rand(1,999999);
	
	$query="SELECT fileid FROM file where fileid='$fid'";
	$result=mysql_query($query);
	
	while($row=mysql_fetch_array($result))
	{
		    
			$fid=rand(1,999999);
			$query="SELECT fileid FROM file where fileid='$fid'";
		    $result=mysql_query($query);
		
	}

$cid=rand(1,999999);
	
	$query1="SELECT courseid FROM course where courseid='$cid'";
	$result=mysql_query($query1);
	

	while($row=mysql_fetch_array($result))
	{
		
			$cid=rand(1,999999);
			$query1="SELECT courseid FROM course where courseid='$cid'";
		    $result=mysql_query($query1);
		
	}

$eid=rand(1,999999);
	
	$query="SELECT eventid FROM event where eventid='$eid'";
	$result=mysql_query($query);

	while($row=mysql_fetch_array($result))
	{
		
			$eid=rand(1,999999);
				$query="SELECT eventid FROM event where eventid='$eid'";
		    $result=mysql_query($query);
		
	}
$dat=date("Y/m/d H:i:s");
$mydate1 = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
$mydate2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";

$paid = 0;

$selected_radio = $_POST['paid'];

if ($selected_radio == 'yes') {
$paid=1;
$fees=$_POST['fees'];
}
else if ($selected_radio == 'no') {
$paid=0;
$fees=0;
}
     $name=$fid.".json";  
	   $sql="INSERT INTO file
VALUES
('$fid','$_SESSION[userid]','$name' )";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  } 
        
$sql="INSERT INTO course (courseid,coursename, course_creationdate, course_startdate, course_enddate, course_paid, course_category,likes,dislikes,Fees)
VALUES
('$cid', '$_POST[course_name]','$dat', '$_REQUEST[date3]', '$_REQUEST[date4]', $paid, '$_POST[course_category]',0,0,'$fees')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
  $sql="INSERT INTO event (eventid,courseid,fileid,event_date,event_type,event_name)
VALUES
('$eid','$cid','$fid','$dat','ECOCR','$_POST[course_name]')";
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
 


$data['course_id']=$cid;
$data['course_name']=$_POST['course_name'];
$data['course_startdate']=$_REQUEST['date3'];
$data['course_enddate']=$_REQUEST['date4'];
$data['course_category']=$_POST['course_category'];
$data['paid']=$_POST['paid'];
$data['Fees']=$fees;
$data['course_description']=$_POST['course_description'];
$data['course_owner']=$_SESSION['userid'];



$json_data=json_encode($data);
 $json_data;
$link="user\\".$_SESSION['userid']."\\".$name;
$file=fopen($link,"w");
fwrite($file,$json_data);
	fclose($file);



echo "The course has been created click here to visit it ";
echo "<a target='_parent'href='course.php?courseid=".$cid."' >".$_POST['course_name']."</a><br>";


mysql_close($con)
?> 
    </head>
</html>
