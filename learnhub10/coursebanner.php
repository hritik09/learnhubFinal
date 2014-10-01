 <?PHP 
  session_start();
  $con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
 if(isset($_GET['opinion']))
 {mysql_query("Update user_course Set opinion='$_GET[opinion]' where courseid='$_GET[courseid]' and userid='$_SESSION[userid]'");
  $query = mysql_query("Select courseid,coursename,likes,dislikes from course where courseid='$_GET[courseid]'");
  $row=mysql_fetch_array($query);
  if($_GET['opinion']==1)
  {    
	  $likes=$row['likes']+1;
	  $query="Update course Set likes=$likes where courseid='$_GET[courseid]' ";
	  mysql_query($query);
	  
  }
  if($_GET['opinion']==-1)
  {
	  $likes=$row['dislikes']+1;
	  mysql_query("Update course Set dislikes=$likes where courseid='$_GET[courseid]' ");
	  
  }
  
   }

 $con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$query = mysql_query("Select courseid,coursename,likes,dislikes from course where courseid='$_GET[courseid]'");
$row=mysql_fetch_array($query);
echo "<div align='left' width=100% style='color: blue;'>".$row['courseid']."  : ".$row['coursename']."  Likes ".$row['likes']."  Dislikes ".$row['dislikes']."</div>";
$query = mysql_query("Select opinion from user_course where courseid='$_GET[courseid]' and userid='$_SESSION[userid]'");
$row=mysql_fetch_array($query);
$opinion=$row['opinion'];
mysql_close($con);
?>

<?php
if($opinion==0)
{   
	echo "<table><tr><td><a style='color: red;' href=\"coursebanner.php?opinion=1&courseid=".$_GET['courseid']."\" target=\"course_banner\"> <img border='0' src='images/up.jpg' width='12' height='12' /> Like </a></td>";
    echo "<td><a style='color: red;' href=\"coursebanner.php?opinion=-1&courseid=".$_GET['courseid']."\" target=\"course_banner\"> <img border='0' src='images/down.jpg' width='12' height='12' /> Dislike</a></td><td></td>";
	}


?>
<td><a style='color: red;' href="testimonial.php?courseid=<?php echo $_GET['courseid'];?>" target="action_frame">Testimonials</a></td></tr></table>
