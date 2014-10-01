<?php
$courseid=$_GET['courseid'];
$con=mysql_connect("localhost","root","root") or die("Error connecting a database".mysql_error());
mysql_select_db("learnhub");
$result=mysql_query("SELECT course_creationdate from course where courseid='$courseid'") or die("Error executing a query".mysql_error());
$row=mysql_fetch_array($result);
$date=substr($row[0],0,strpos($row[0]," "));
?>

<script type="text/javascript">
	var date="<?php echo $date; ?>"
	function ValidateForm()
	{
		var myForm=document.forms['myForm'];
		
		var myForm=document.forms['myForm'];
		if(myForm['coursename'].value==null || myForm['coursename'].value=="" || myForm['date3'].value == "0000-00-00" || myForm['date4'].value=="0000-00-00"|| ( myForm['Fees'].value=="" && myForm['paid'][0].checked) || isNaN(myForm['Fees'].value || myForm['date3'].value < strdate))
		{
			if(myForm['coursename'].value==null || myForm['coursename'].value=="")
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
			if(myForm['paid'][0].checked && myForm['Fees'].value=="")
			{
				var span=document.getElementById("3");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("3");
				span.innerHTML="";
			}
			if(isNaN(myForm['Fees'].value))
			{
				var span=document.getElementById("3");
				span.innerHTML="Not a numeric";
			}
			
			return false;
		} 
		return true;
	}
	
	function ValidateFormFields()
	{
		var date=new Date();
		var strdate=date.getFullYear()+"-";
		if(date.getMonth()<9)
		strdate+="0"+(date.getMonth() + 1) +"-"+date.getDate();
		else
		strdate+=(date.getMonth()+1)+"-"+date.getDate();
		var myForm=document.forms['myForm'];
		if(myForm['coursename'].value==null || myForm['coursename'].value=="" || myForm['date4'].value=="0000-00-00"|| ( myForm['Fees'].value=="" && myForm['paid'][0].checked) || isNaN(myForm['Fees'].value) || myForm['date4'].value < date || myForm['date4'].value < strdate)
		{
			if(myForm['coursename'].value==null || myForm['coursename'].value=="")
			{
				var span=document.getElementById("1");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("1");
				span.innerHTML="";			
			}
			if(myForm['paid'][0].checked && myForm['Fees'].value=="")
			{
				var span=document.getElementById("3");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("3");
				span.innerHTML="";
			}
			if(myForm['date4'].value < date || myForm['date4'].value < strdate)
			{
				var span=document.getElementById("2");
				span.innerHTML="Invalid Date";
			}
			else
			{
				var span=document.getElementById("2");
				span.innerHTML="";
			}
			if(isNaN(myForm['Fees'].value))
			{
				var span=document.getElementById("3");
				span.innerHTML="Not a numeric";
			}
			
			return false;
		} 
		return true;	
	}
	
	function Focus(myobj)
	{
		var span=document.getElementById("Fees");
		span.disabled=false;
		var sp=document.forms['myForm']['Feess'];
		sp.focus();
	
	}
	function Removeinner()
	{
		var sp=document.getElementById("3");
		if(sp.innerHTML!="")
		sp.innerHTML="";
		var span=document.getElementById("Fees");
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
		if(myobj.value!="")
		{
			document.getElementById("1").innerHTML="";
		}
	}
</script>
<?php
session_start();
require_once('calendar/classes/tc_calendar.php');

header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header ("Pragma: no-cache");
?>


<html>
<head>
<title> LearnHub: Edit Course</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Course_cr/calendar/calendar.js">
</script>

<style type="text/css" src="calendar/calendar.css"></style>

</head>
<body>
<div align="center">

<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$use=$_GET['courseid'];
$query="Select * from course where courseid='$use'";
$sql=mysql_query($query);
$row=mysql_fetch_array($sql);
$query1="select fileid from event where event_type='ECOCR' and courseid='$use'";
$sql1=mysql_query($query1);
$row1=mysql_fetch_array($sql1);

    echo "<div style='font-family: Verdana, Arial, sans serif;'>";
	if($date<date("Y-m-d"))
	echo "<form name='myForm' action='course_update.php' method='POST' onsubmit='return ValidateFormFields();'>";
	else
	echo "<form name='myForm' action='course_update.php' method='POST' onsubmit='return ValidateForm();'>";
	echo "<legend align='center'><h1>Edit Course</h1></legend><hr /><br /><table width= 100%>
    <tr><td>CourseID:</td><td>         ".$row['courseid']."</td></tr>
    <tr><td>Course Name:</td><td>         <input type='text' name='coursename' id='coursename' onblur='ValidateTextInner(this)' value='".$row['coursename']."' /><span id='1' style='color: red; font-size: 9px; font-style:italic;' ></span></td></tr>
    <tr><td>Course Duration: </td><td>";
	if($date<date("Y-m-d"))	
	{
		echo 'From: '.$date;
		echo 'To: ';
		$dat=strpos($row['course_enddate']," ");
	   $enddate=substr($row['course_enddate'],0,$dat);
	   $date4_default = $enddate;
		$myCalendar = new tc_calendar("date4", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date4_default))
           , date('m', strtotime($date4_default))
           , date('Y', strtotime($date4_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  //$myCalendar->setDatePair('date3', 'date4', $date3_default);
	  $myCalendar->writeScript();
	  echo "<input type='hidden' name='date3' value='".$date."' />"; 
	}
	else
	{
	   $dat=strpos($row['course_startdate']," ");
	   $stdate=substr($row['course_startdate'],0,$dat);	
	   $dat=strpos($row['course_enddate']," ");
	   $enddate=substr($row['course_enddate'],0,$dat);				
      $date3_default = $stdate;
      $date4_default = $enddate;

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
	}
	  $filepath="user/".$_SESSION['userid']."/".$row1['fileid'].".json";
	  $file=fopen($filepath,"r");
	$string=fread($file,filesize($filepath));
	 $filestring=json_decode($string,true);
	$desc = $filestring['course_description'];
    fclose($file);
	  	  
	  echo "<br /><span id='2' style='color: red; font-size: 9px; font-style:italic;'></span></td></tr>  
    	
    <tr><td>Course Paid:</td><td>             <input type='radio' name='paid' value='paid' onclick='Focus(this)'"; if($row['course_paid']=='1') {echo "checked";} echo " />Yes<input type='radio' name='paid' value='unpaid' onclick='Removeinner()'"; if($row['course_paid']=='0') echo "checked"; echo " />No</td></tr>";
	echo "<tr><td> Course Fees:</td><td>        <input type='text' name='Fees' id='Fees' disabled='disabled' onblur='ValidateNan(this)' value='";if($row['course_paid']=='1'){ echo $row['Fees'];}echo "' /><span id='3' style='color: red; font-size: 9px; font-style:italic;' ></span><br /></td></tr>";
    echo "<tr><td>Course Category:</td><td>                  <input type='text' name='course_category' value='".$row['course_category']."' /></td></tr>
    <tr><td>Course Description:</td><td> <textarea rows='15' cols='30' id='description' name='course_description'>".$desc."</textarea>            </td></tr>
                </table>
				<input type='hidden' value='".$row1['fileid']."' name='fileid' >
				<input type='hidden' value='".$row['courseid']."' name='courseid' >
                <input type='submit' value='submit' target='action_frame' 
;				/></form>
                </div>";

?>
</div>
</body>
</html>