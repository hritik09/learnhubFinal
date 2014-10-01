<?php
require_once('Course_cr/calendar/classes/tc_calendar.php');

header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");

$eventid=$_GET['eventid'];
$con=mysql_connect("localhost","root","root") or die("Error connecting a database".mysql_error());
mysql_select_db("learnhub");
$result=mysql_query("SELECT course_enddate from course natural join event where eventid='$eventid'") or die("Error executing a query".mysql_error());
$row=mysql_fetch_array($result);
$date=substr($row[0],0,strpos($row[0]," "));
echo $date;
mysql_close($con);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LearnHub: Edit Assignment</title>
<script type="text/javascript" src="Course_cr/calendar/calendar.js">
</script>
<style type="text/css" src="calendar/calendar.css"></style>
<?php
	session_start();
	$userid=$_SESSION['userid'];
	mysql_connect("localhost",'root','root') or die("Error connecting to database:".mysql_error());
	mysql_select_db("learnhub");
	$eventid=$_GET['eventid'];
	$query="SELECT fileid,userid,due_date,courseid from event natural join file where eventid='$eventid'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$filepath="user/".$row['userid']."/".$row[0].".json";
	$dat=strpos($row['due_date']," ");
	$due_date=substr($row['due_date'],0,$dat);
	$file=fopen($filepath,"r");
	$filedata=fread($file,filesize($filepath));
    $filestring=json_decode($filedata,true);
	$ass_name=$filestring['name'];
	$ass_description=$filestring['description'];
	if($filestring['file_link']!="")
	{
		$ass_link=$filestring['file_link'];
		$ass=$filestring['file_name'];
		$d=1;
	}
	else
	   $d=0;
?>

<script type="text/javascript">
	var date="<?php echo $date?>";
	function ValidateFields()
	{
		var date=new Date();
		var strdate=date.getFullYear()+"-";
		if(date.getMonth()<10)
		strdate+="0"+date.getMonth()+"-"+date.getDate();
		else
		strdate+=date.getMonth()+"-"+date.getDate();
		var myForm=document.forms["myForm"];
		var reg=/^[A-Z0-9a-z_]+(\.pdf|\.ppt|\.pptx)$/;
		if(myForm['ass_name'].value==null || myForm['ass_name'].value=="" ||(myForm["ass_file"].files.length >0 && !reg.test(myForm["ass_file"].files[0].name))|| myForm['date3'].value>date || myForm['date3'].value < strdate)
		{
			if(myForm['ass_name'].value==null || myForm['ass_name'].value=="")
			{
				var span1=document.getElementById("1");
				span1.innerHTML="This field is required";
			}
			if(myForm["ass_file"].files.length >0 && !reg.test(myForm["ass_file"].files[0].name))
			{
	
				var span2=document.getElementById("2");
					span2.innerHTML="Invalid file name.";	
			}
			if(myForm['date3'].value>date)
			{
				var span2=document.getElementById("4");
					span2.innerHTML="Course expire before this date";
			}
			else
			{
				var span2=document.getElementById("4");
					span2.innerHTML="";
			}
			if(myForm['date3'].value < strdate)
				{
				alert("2");
				var span=document.getElementById("3");
				span.innerHTML="Please enter valid due date";
				}
				else
				{
				var span=document.getElementById("3");
				span.innerHTML="";
				}
			
		return false;
		}
		return true;
	}
	
	function ValidateInnerText(myobj)
	{
		if(myobj.name=="ass_name")
		{
			if(myobj.value!=null)
			document.getElementById("1").innerHTML="";
		}
		/*if(myobj.name=="ass_file")
		{
			if(document.forms['myForm']['ass_file'].files.length>0)
			document.getElementById("2").innerHTML="";
		}*/
	}
			
	
</script>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<form name="myForm" method="POST" action="Edit_Assignment_Submit.php" enctype="multipart/form-data" onsubmit="return ValidateFields()">
    	<fieldset>
    		<legend align="center"><h1>Edit a Assignment</h1></legend>
        	<label for="assignment">Assignment name:</label>
        		<input type="text" id="assignment" name="ass_name" size="" maxlength="" onblur="ValidateInnerText(this)" value="<?php echo $ass_name; ?>" /><span id="1" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
        	<label for="description">Assignment Description:</label><br /> 
        		<textarea rows="15" cols="40" id="description" name="ass_description"  ><?php echo $ass_description; ?></textarea><br  /><br />
        	<p id="due_date">Due Date:</p><?php					
      $date3_default = $due_date;
	  $myCalendar = new tc_calendar("date3", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date3_default))
            , date('m', strtotime($date3_default))
            , date('Y', strtotime($date3_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->writeScript();	  
	  ?><span id="4" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
            <?php
            
			if($d==1)
			{
			?>	
                Any Previous Attachment: <a href="Downloading.php?file=<?php echo $ass; ?>&link=<?php echo $ass_link; ?>"><?php echo $ass; ?></a><br /><br />
            <?php
			}
			else
			{
			?>
            	<p>No Previous Attachment</p><br /><br />
            <?php
			}
			?>
        	<label for="assfile" >Assignment document(if any):</label><br />
            	<input type="file" id="assfile" name="ass_file"  onblur="ValidateInnerText(this)"/><span id="2" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br /><br />
        	<input type="submit" name="Submit" onclick="return ValidateFields()" value="Edit" />
       		<input type="hidden" name="eventid" value=<?php echo $_GET['eventid'] ?> />
            <input type="hidden" name="courseid" value="<?php echo $row['courseid']; ?>"/><br />
        </fieldset>
        
        
    </form>
</body>
</html>