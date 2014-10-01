<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<title>Untitled Document</title>
<?php
$eventid=$_GET['eventid'];
$con=mysql_connect("localhost","root","root") or die("Error connecting a database".mysql_error());
mysql_select_db("learnhub");
$result=mysql_query("SELECT due_date from event where eventid='$eventid'") or die("Error executing a query".mysql_error());
$row=mysql_fetch_array($result);
$date=substr($row[0],0,strpos($row[0]," "));
 
?>

<script type="text/javascript">
	function Validate()
	{
		var myForm=document.forms["myForm"];
		var reg=/^[A-Z0-9a-z_]+(\.pdf|\.ppt|\.pptx)$/;
		if(myForm["ass_file"].files.length <1 || (myForm["ass_file"].files.length >0 && !reg.test(myForm["ass_file"].files[0].name)))
		{
			if(myForm["ass_file"].files.length >0 && !reg.test(myForm["ass_file"].files[0].name))
			{
				var span=document.getElementById("1");
				span.innerHTML="Invalid Filename";
			}
			if(myForm["ass_file"].files.length <1)
			{
				var span2=document.getElementById("1");
					span2.innerHTML="This field is required";
			}
			
			
		return false;
		}
		return true;
	}
	
	function ValidateInnerText(myobj)
	{
		if(document.forms["myForm"]['ass_file'].files.length>0 && document.getElementById("1").innerHTML=="This field is required")
		document.getElementById("1").innerHTML="";
	}
</script>
</head>

<body>
<?php
    session_start();
	$userid=$_SESSION['userid'];
	
	mysql_connect("localhost",'root','root') or die("Error connecting to database:".mysql_error());
	mysql_select_db("learnhub");
	$eventid=$_GET['eventid'];
	$query="SELECT fileid,userid from event natural join file where eventid='$eventid'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$filepath="user/".$row[1]."/".$row[0].".json";
	
	$file=fopen($filepath,"r");
	$filedata=fread($file,filesize($filepath));
    $filestring=json_decode($filedata,true);
	$ass_name=$filestring['name'];
	$ass_description=$filestring['description'];
	echo "<h1 align='center'>Submit Assignment</h1><hr /><br />";
	echo "<div>Assignment Name: ".$ass_name."<br /><br />";
	echo "Assignment Description: ".$ass_description."<br /></br>";
	if($filestring['file_link']!="")
	{
		$ass_link=$filestring['file_link'];
		$ass=$filestring['file_name'];
?>
		<br />File Associated: <a href="Downloading.php?link=<?php echo $ass_link ?>&file=<?php echo $ass ?>"> <?php echo $ass ?></a><br /><br />	
<?php        
	}
?>	
	<form name="myForm" method="POST" action="Submit_Assignment.php" enctype="multipart/form-data" onsubmit="return Validate()">
	Assignmnet Due-date: <?php echo $date ?> <br /><br />
    Upload File: <input type="file" name="ass_file" onblur="ValidateInnerText(this)" /><span id="1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
    <input type="hidden" name="eventid" value="<?php echo $eventid; ?>" /><br />
    Give Feedback: <input type="text" name="feedback"  /><br /><br />
 <?php   
    if($date > date("Y-m-d"))
    echo '<input type="submit" name="ass_submit" value="Submit Assignment" />';
	else
	echo '<p>The due date for this assignment is over</p>';
 ?>   
    </form></div>
</body>
	
</html>




