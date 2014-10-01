<head>

<script type="type/javascript">
	
	function test(ad)
	{
		if(ad==1)
		document.getElementById("action_frame").src="course_desc.php?courseid=<?php  echo $_GET['courseid'];?>";
	}
	
</script>
<?php
 $con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$query="Select role from user_course where courseid='$_GET[courseid]' and userid='$_SESSION[userid]";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$a=0;
if(!isset($row['role']))
{
	echo "<a href=\"register.php?courseid=".$_GET['courseid']."\"  target=\"action_frame\" >Register for course</a>";
	$a=1;
	
}
?>

</head>
<body onLoad="test(<?php  echo $a;?>)">
	
</body>

