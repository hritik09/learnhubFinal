<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
session_start();
mysql_select_db("learnhub", $con);
$query="select fileid from event where courseid='$_GET[courseid]' and event_type='ECOCR'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$query="select * from course where courseid='$_GET[courseid]'";
$result1=mysql_query($query);
$row1=mysql_fetch_array($result1);
echo "<br />Course id :".$row1['courseid'];
echo "<br />Course Name :".$row1['coursename'];
echo "<br />Course Start date:".$row1['course_startdate'];
echo "<br />Course End date :".$row1['course_enddate'];
echo "<br />Course Category:".$row1['course_category'];
echo "<br />Course id :".$row1['courseid'];
$query="select userid from file where fileid='$row[fileid]'";
$result1=mysql_query($query);
$row1=mysql_fetch_array($result1);
$link="user\\".$row1['userid']."\\".$row['fileid'].".json";
$file=fopen($link,"r");
$filedata=fread($file,filesize($link));
$filestring=json_decode($filedata,true);
$course_description=$filestring['course_description'];
echo "Course Description :".$course_description;	
?>