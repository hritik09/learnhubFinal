<?php
require_once('Course_cr/calendar/classes/tc_calendar.php');

header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");

$courseid=$_GET['courseid'];
$con=mysql_connect("localhost","root","root") or die("Error connecting a database".mysql_error());
mysql_select_db("learnhub");
$result=mysql_query("SELECT course_enddate from course where courseid='$courseid'") or die("Error executing a query".mysql_error());
$row=mysql_fetch_array($result);
$date=substr($row[0],0,strpos($row[0]," "));
echo $date;
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="Course_cr/calendar/calendar.js">
</script>
<script type="text/javascript">
 var date="<?php echo $date ?>";
	function ValidateAssignment()
	{
		var myForm=document.forms["myForm"];
		var reg=/^[A-Z0-9a-z]+(\.pdf|\.ppt|\.pptx)$/;
		if(myForm['ass_name'].value==null || myForm['ass_name'].value=="" ||(myForm["ass_file"].files.length >0 && !reg.test(myForm["ass_file"].files[0].name)) || myForm['date3'].value>date)
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
				var span2=document.getElementById("3");
					span2.innerHTML="Course expire before this date";
			}
			else
			{
				var span2=document.getElementById("3");
					span2.innerHTML="";
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
<style type="text/css" src="calendar/calendar.css"></style>
</head>

<body>
<div id="main">
	<?php
	?>
	<form name="myForm" method="POST" action="createassignment_submission.php" enctype="multipart/form-data" onsubmit="return ValidateAssignment()">
    	<fieldset>
    	<legend align="center"><h1>Assignment Creation</h1></legend>
        <label for="assignment">Assignment name:</label>
        <input type="text" id="assignment" name="ass_name" size="" maxlength="" value=""  onblur="ValidateInnerText(this)" /><span id="1" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
        <label for="description">Assignment Description:</label><br />
        <textarea rows="15" cols="40" id="description" name="ass_description" value="" ></textarea><br  /><br />
        <p id="due_date">Due Date:</p><?php
		$dat=date("Y-m-d");					
      $date3_default = $dat;  
	  $myCalendar = new tc_calendar("date3", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date3_default))
            , date('m', strtotime($date3_default))
            , date('Y', strtotime($date3_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->writeScript();	  
	  ?><span id="3" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
        <label for="assfile" >Assignment document(if any):</label><br /><input type="file" id="assfile" name="ass_file" onblur="ValidateInnerText(this)"  /><span id="2" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br /><br />
        <input type="submit" name="Submit" value="Submit" target="action_frame" />
		<input type="hidden" name="courseid" value="<?php echo $_GET['courseid']?>" />
        </fieldset>
        
        
    </form>
</div>
</body>
</html>