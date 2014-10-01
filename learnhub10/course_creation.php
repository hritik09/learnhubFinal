<script type="text/javascript">
function ValidateForm(date)
	{
		
		var myForm=document.forms['userform'];
		var date=new Date();
		var strdate=date.getFullYear()+"-";
		if(date.getMonth()<9)
			strdate+="0"+(date.getMonth() + 1)+"-"; 
		else
			strdate+=(date.getMonth()+1)+"-";

		if(date.getDate() <10)
			strdate+="0"+date.getDate();
		else
			strdate+=date.getDate();
		
		if(myForm['course_name'].value==null || myForm['course_name'].value=="" || myForm['date3'].value == "0000-00-00" || myForm['date4'].value=="0000-00-00"|| ( myForm['fees'].value=="" && myForm['paid'][0].checked) || isNaN(myForm['fees'].value) || myForm['date3'].value < strdate)
		{
			if(myForm['course_name'].value==null || myForm['course_name'].value=="")
			{
				var span=document.getElementById("1");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("1");
				span.innerHTML="";			
			}
			if(myForm['date3'].value == "0000-00-00" || myForm['date4'].value=="0000-00-00")
			{
				var span=document.getElementById("2");
				span.innerHTML="This field is required";
			}
			else
			{
				if(myForm['date3'].value < strdate)
				{
				var span=document.getElementById("2");
				span.innerHTML="Please enter valid course duration";
				}
				else
				{
				var span=document.getElementById("2");
				span.innerHTML="";
				}
			}
			if(myForm['paid'][0].checked && myForm['fees'].value=="")
			{
				var span=document.getElementById("3");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("3");
				span.innerHTML="";
			}
			if(isNaN(myForm['fees'].value))
			{
				var span=document.getElementById("3");
				span.innerHTML="Not a numeric";
			}
			
		//	else
		//	{
		//		alert("1");
		//		var span=document.getElementById("2");
		//		span.innerHTML="";
		//	}
			
			
			return false;
		}
		if(document.getElementById("3").innerHTML=="Not a numeric") 
			document.getElementById("3").innerHTML="";
		return true;
	}
	
	function Focus(myobj)
	{
		var span=document.getElementById("fees");
		span.disabled=false;
		var sp=document.forms['userform']['fees'];
		sp.focus();
	
	}
	function Removeinner()
	{
		
		var sp=document.getElementById("3");
		if(sp.innerHTML!="")
		sp.innerHTML="";
		var span=document.getElementById("fees");
		span.disabled=true;
	}
	function ValidateNan(myobj)
	{
		if(!isNaN(myobj.value))
		{
		  document.getElementById("3").innerHTML="";
		}
	}
	function ValidateTextInner(myobj)
	{
		if(myobj.name=="course_name")
		{
		if(myobj.value!="")
		{
			document.getElementById("1").innerHTML="";
		}
		}
	}
</script>
<?php
require_once('calendar/classes/tc_calendar.php');

header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<title>Course Registration</title>
<script type="text/javascript" src="Course_cr/calendar/calendar.js">
</script>

<style type="text/css" src="calendar/calendar.css"></style>

</head>
<body>
<div>
<form name="userform" method="post" action="course_ins.php" target="action_frame" onSubmit="return ValidateForm(<?php echo date("Y-n-d") ?>)">
<fieldset style="-moz-border-radius: 10px; 
            -webkit-border-radius: 10px;
            border-radius: 10px; 
            padding: 10px;
            "><legend align="center"><h1>Course Creation</h1></legend>
<table><tr> 
<td>Course Name:</td><td>     		<input type="text" name="course_name" onBlur="ValidateTextInner(this)"/><span id="1" style='color: red; font-size: 9px; font-style:italic;'></span><br /></td></tr>
<tr><td>Course Duration:</td><td>     	<?php					
      $date3_default = "2013-01-01";
      $date4_default = "2013-01-01";

	  $myCalendar = new tc_calendar("date3", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date3_default))
            , date('m', strtotime($date3_default))
            , date('Y', strtotime($date3_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date3', 'date4', $date4_default);
	  $myCalendar->writeScript();	  
	  
	  $myCalendar = new tc_calendar("date4", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date4_default))
           , date('m', strtotime($date4_default))
           , date('Y', strtotime($date4_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date3', 'date4', $date3_default);
	  $myCalendar->writeScript();	  
	  ?><span id="2" style='color: red; font-size: 9px; font-style:italic; margin-left:5px;'></span><br /></td></tr>

<tr><td>Is the course Paid?</td><td> 	<br /><input type="radio" name="paid" value="yes" onClick="Focus(this)" />Yes<input type="radio" name="paid" value="no" checked onClick="Removeinner()"/>No<br /></td></tr>
<tr><td>Course Fees:</td><td>        <input type="text" name="fees" id="fees" disabled="disabled" onBlur="ValidateNan(this)"/><span id="3" style='color: red; font-size: 9px; font-style:italic;'></span><br /></td></tr>
<tr><td>Course Category:</td><td> 	<input type="text" name="course_category" /><br /></td></tr>
<tr><td>Course Description:</td><td>	<br /><textarea name="course_description" rows="10" cols="30" /></textarea><br /></td></tr></table>
    <input type="submit" value="Submit" />
</fieldset>
</form>
</div>
</body>

</html>

