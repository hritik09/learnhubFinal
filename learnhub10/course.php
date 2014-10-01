<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="shortcut icon" type="image/vnd.microsoft.icon" href="http://www.flat-stomach-exercises.com/favicon.ico" />
</head> 
<title>LearnHub</title>
<META Name="Description" Content="description" />
<META Name="Keywords" Content="keywords separated by commas"/>
<link rel="Shortcut Icon" href="/favicon.ico" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script src="jquery-1.6.4.min.js" type="text/javascript" > </script>
<?php 
ob_start();
session_start();
if(isset($_SESSION['userid']))
{
if(isset($_GET['courseid']))
{$_SESSION['courseid']=$_GET['courseid'];}
include "calendar.php"	;

}
else
{       $_SESSION["login_error"]="Please login to use this feature ";
		header("Location: index.php");

}
ob_flush();
 ?>


</head>
<body> 


<div id="container">
<div id="rightnav1">
	<h2 align="center">You are Logged in as 
	<?php	
	
	echo "<a href=user.php?userid=".$_SESSION['userid'].">";
    
		echo $_SESSION['firstname'];
	
	?>
    </a><table style="font-size: 12px;"><tr><td></h2>
    <a href="homepage.php">
    Home
    </a>
    </a></h2></td><td></td><td>
    <a href="logout.php">
    Logout
    </a></td></tr></table>
    <a style="font-size: 12px;"href="forum.php?courseid=<?php echo $_GET['courseid'];?>" >Forum</a>
	</div>
<div id="div1" align="center" style="text-align: center;"><iframe align="center" style="text-align: center; height: 70px;" frameborder="0" src="coursebanner.php?courseid=<?php echo $_GET['courseid']; ?>" name="course_banner" id="course_banner"></iframe><br /><?php include 'course_reg.php';?>
</div>	
 

<div id="header2">
<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>
</div>

<?php ?>

<div align="center">
<table>
<tr>
<td>
	<div id="leftnav1" style="height: 350px;">
		<h1>User Action</h1><hr /><br />
    	<?php include 'courseactions.php';  ?>
	</div></td>
    <td>
    <div id="center_data" style="width: 630px; margin-left: 10px;">
<iframe style="margin-top: -30px;" id="iframecss" frameborder="0" src="<?php
 $con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$query="Select role,status from user_course where courseid='$_GET[courseid]' and userid='$_SESSION[userid]'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if(!isset($row['role']) || $row['status']=="Pending")
{
	echo "course_desc";
	
	
}
else
{
	echo "timeline";
	}
?>.php?courseid=<?php echo $_GET['courseid'];?>" id="action_frame" name="action_frame" >

</iframe>
</div></td>
    <td>
    <div id="rightnav2" style="height: 350px;">
    	<h2 align="center">Calendar</h2><hr /><br />
        <div align="center" id="calendar_wrapper"><?PHP echo @$calendar ?></div>
        <h1>Search</h1><hr />
        <form target="action_frame" name="search_box" id="search_box" action="search.php" method='post'>
<input type="text" name="find" /><br />
<input type="radio" name="type" value="Course" checked='checked'  />Course 
<input type="radio" name="type" value="User"  />User
<input type="submit" name="submit" id="submit" value="search" />

</form>
    </div>
    </td>
    </tr>
    <tr>
    <td><div style="height: 250px;"></div></td>
    <td><div style="height: 250px;"></div></td>
    <td><div style="height: 250px;"></div></td></tr>
</table>
</div>
	
            
<div align="center" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</div>

</body>
</html>


  
  