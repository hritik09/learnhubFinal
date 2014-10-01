<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/vnd.microsoft.icon" href="http://www.flat-stomach-exercises.com/favicon.ico" />

<title>LearnHub</title>
<META Name="Description" Content="description" />
<META Name="Keywords" Content="keywords separated by commas"/>
<link rel="Shortcut Icon" href="/favicon.ico" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php  session_start();
if(isset($_SESSION['courseid'])){unset($_SESSION['courseid']);}
include "calendar.php" ?>


</head>
<body> 

<div id="container">

	<div id="rightnav1">
	<h2 align="center">You are Logged in as 
    <?PHP 
	
	echo "<a href=user.php?userid=".$_SESSION['userid'].">";
    
		echo $_SESSION['firstname'];
	
	?></h2>
    </a>
    <a href="logout.php">
    Logout
    </a>
	</div>
 

<div id="header2">
<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>

</div>

<div align="center">
<table>
<tr>
<td>
	<div id="leftnav1" align="center">
		<h2>
		<strong> Courses Administered </strong></h2><hr />
        <iframe style="width: 200px; height: 190px;" frameborder="0" src="courseadmin.php"></iframe>
<hr /><h3><a href="course_creation.php" target="action_frame">Create Course</a></h3>
	</div>
    </td>
    <td>
    <div id="center_data" align="center">
    	<iframe id="iframecss" align="center" frameborder="0" src="updates.php" id="action_frame" name="action_frame" height="800" width="500"></iframe>
    </div>
    </td>
    <td>
    <div id="rightnav2">
    	<h2 align="center">Calendar</h2><hr /><br />
        <div align="center" id="calendar_wrapper"><?PHP echo @$calendar ?></div><hr />
    </div>
    </td>
    </tr>
    <tr>
    <td>
    <div id="leftnav2" align="center">
    	<h2> Courses Taken</h2><hr /><br />
       <iframe style="width: 200px; height: 190px;" frameborder="0" src="coursetaken.php"></iframe>
	</div>
</td>
<td></td>
<td>
    <div id="rightnav3">
    	<h2 align="center">User actions</h2><hr /><br />
        <?php include 'useractions.php' ?>
        <h2>Search</h2><hr />
        <form target="action_frame" name="search_box" id="search_box" action="search.php" method='post'>
<input type="text" name="find" /><br />
<input type="radio" name="type" value="Course" checked='checked'  />Course 
<input type="radio" name="type" value="User"  />User
<input type="submit" name="submit" id="submit" value="search" />

</form>
    </div>
</td>
</tr>
</table>
</div>
	-
<div align="center" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</div>

</body>
</html>


  
  