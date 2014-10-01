<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/vnd.microsoft.icon" href="http://www.flat-stomach-exercises.com/favicon.ico" />

<title>LearnHub</title>
<META Name="Description" Content="description" />
<META Name="Keywords" Content="keywords separated by commas"/>
<link rel="Shortcut Icon" href="/favicon.ico" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
td
{
text-align: center;
}
</style>

</head>
<body> 

<div id="container">
<div id="header2">
<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>

</div>
<div align="center">
<div align="center" style="width: 500px">
<?php


$con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  
  mysql_select_db("learnhub", $con);
  $que="Select * from user where userid='$_GET[userid]'";
  $sql=mysql_query($que);
  while($row=mysql_fetch_array($sql))
  {
      echo "<h1>User Details</h1><hr /><br />";
      echo "<table width=100%>
	  			<tr><td style='text-align: left'>UserID</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['userid']."</td></tr>
				<tr><td style='text-align: left'>FirstName</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['firstname']."</td></tr>
				<tr><td style='text-align: left'>Lastname</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['lastname']."</td></tr>
				<tr><td style='text-align: left'>Address</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['user_address']."</td></tr>
				<tr><td style='text-align: left'>City</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['city']."</td></tr>
				<tr><td style='text-align: left'>State</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['state']."</td></tr>
				<tr><td style='text-align: left'>Country</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['country']."</td></tr>
				<tr><td style='text-align: left'>Pincode</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['pincode']."</td></tr>
				<tr><td style='text-align: left'>Email</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['email']."</td></tr>
				<tr><td style='text-align: left'>Telephone</td><td width='1' bgcolor='blue'><BR></td><td> ".$row['areacode']."-".$row['telephone']."</td></tr></table>";
  }
  
  $query1="Select coursename,courseid from user_course natural join course where role in ('Owner', 'Admin') and userid='$_GET[userid]'";
  $sql1=mysql_query($query1);
  $num1=mysql_num_rows($sql1);
  if($num1>0)
  {
  echo "<h1>Courses Administered</h1><hr /><br />";
  while($row1=mysql_fetch_array($sql1))
  {
      
      echo "<a href='course.php?courseid=".$row1['courseid']."'>". $row1['courseid']."  " .$row1['coursename']. "</a><br />";
  }
  }
  
  
  $query2="Select coursename, courseid from user_course natural join course where role='Student' and userid='$_GET[userid]'";
  
  $sql2=mysql_query($query2);
  $num2=mysql_num_rows($sql2);
  if($num2>0)
  {
  echo "<h1>Courses Taken</h1><hr /><br />";
  while($row2=mysql_fetch_array($sql2))
  {
      
      echo "<a href='course.php?courseid=".$row2['courseid']."'>". $row2['courseid']."  ".$row2['coursename']. "</a><br />";
  }
  }
?>
</div>
</div>
</div>
<div align="center" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</body>
</html>
