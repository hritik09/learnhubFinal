<html>
<head>
<title></title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h3 align="center">
<?php
session_start();
  $con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  
  mysql_select_db("learnhub", $con);
  
  $query="Select coursename,courseid from user_course natural join course where role in ('Owner', 'Admin') and userid='$_SESSION[userid]'";
  $sql=mysql_query($query);
  $num=mysql_num_rows($sql);
  if($num>0)
  {
  while($row=mysql_fetch_array($sql))
  {
      echo "<a target='_parent' href='course.php?courseid=".$row['courseid']."'>". $row['courseid']."  " .$row['coursename']. "</a><br />";
  }
  }
  else
  {
	  echo "No Courses Owned Or Administered";
  }
?></h3>
</body>