
<?php

 $con=mysql_connect("localhost","root","root");
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());

$_POST['find']= strtoupper($_POST['find']); 
$_POST['find']= strip_tags($_POST['find']); 
$find= trim ($_POST['find']);
if($_POST['type']=="Course")
{
echo "<h1><div style='color: blue; size: 16px'>Results in Course's</div></h1><hr />";
echo "<h3><div style='color:blue'>Results by Course Name</div></h3>";
$query="select coursename,courseid from course where upper(coursename) like \"%$find%\"";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	echo "<a style='color: red;' target='_parent' href='course.php?courseid=".$row['courseid']."'>".$row['coursename']."</a><br />";
	
}
echo "<br /><br /><h3><div style='color: blue; '>Results by Course Category</div></h3>";
$query="select coursename,courseid from course where upper(course_category) like \"%$find%\"";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	echo "<a style='color: red;' target='_parent' href='course.php?courseid=".$row['courseid']."'>".$row['coursename']."</a><br />";
	
}}
else
{
echo "<br /><br /><h1><div style='color: blue; size: 16px'>Results in User's</div></h1><hr />";
$query="select userid from user where upper(userid) like \"%$find%\"";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	echo "<a style='color: red;' target='_parent' href='user.php?userid=".$row['userid']."'>".$row['userid']."</a><br />";
	
}
}
?>