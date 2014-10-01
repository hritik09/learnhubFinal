<?php
require_once('calendar/classes/tc_calendar.php');

header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Course Registration</title>
<script type="text/javascript" src="calendar/calendar.js">
</script>

<style type="text/css" src="calendar/calendar.css"></style>

</head>
<body>
<div>
<form name="userform" method="post" action="course_ins.php">
<fieldset style="-moz-border-radius: 10px; 
            -webkit-border-radius: 10px;
            border-radius: 10px; 
            padding: 10px;
            "><legend align="center" style="font-family:Verdana, Geneva, sans-serif">Course Registration</legend>
<pre style="font-family: Verdana, Arial, sans serif;"> 
Course Name:     		<input type="text" name="cname" /><br />
Course Duration:     	<?php					
      $date3_default = "2012-03-18";
      $date4_default = "2012-03-18";

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
	  ?><br />

Is the course Paid? 	<br /><input type="radio" name="paid" value="paid" />Yes<input type="radio" name="paid" value="unpaid" />No<br />
Course Catagory: 	<input type="text" name="ccat" /><br />
Course Description:	<br /><textarea name="textarea" rows="10" cols="100" /></textarea><br />
    <input type="submit" value="Submit" />
</pre>
</fieldset>
</form>
</div>
</body>

</html>

