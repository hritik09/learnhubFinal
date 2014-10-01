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
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quiz Creation</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />



<script  type="text/javascript" src="jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="Course_cr/calendar/calendar.js"></script>
<script type="text/javascript">
     var date="<?php echo $date ?>";
	 var id=0;
	 $(document).ready(function () {
			$("#submit_quix").hide();
	 });
	 
	 function ValidateName(myobj)
	 {
		
		 if(myobj.value=="" || myobj.value==null)
		 {
			 var span1=document.getElementById("span1");
			 span1.innerHTML="Field is required";
		 }
		 else{
			  var span1=document.getElementById("span1");
			 span1.innerHTML="";
		 }
		 
	 }
	 function Focus(myobj)
		{
			var spam=0;
			var reg1=/(\S)*option(\S)*/;
			var reg2=/ques(\S)*/;
			//alert(reg1.test(myobj.name));
			if(reg1.test(myobj.name))
			{
				if(myobj.value.length<1)
				{
					
					 //setTimeout(function() {myobj.focus();}, 0);
					myobj.focus();
					var span1=document.getElementById(myobj.name+"_1");
					span1.innerHTML="Field required";
				}
				else
				{
					var span1=document.getElementById(myobj.name+"_1");
					span1.innerHTML="";
				}
			}
			else if(reg2.test(myobj.name))
			{
				if(myobj.value.length<1)
				{
				
				//setTimeout(function() {myobj.focus();}, 0);	
				myobj.focus();
				var span1=document.getElementById(myobj.name+"_1");
				span1.innerHTML="Field Required";
				}
				else
				{
					var span1=document.getElementById(myobj.name+"_1");
					span1.innerHTML="";
				}
			}
			else
			{
			if(myobj.value.length<1)
			{
				
				//setTimeout(function() {myobj.focus();}, 0);
				myobj.focus();
				var span1=document.getElementById(myobj.name+"_1");
				span1.innerHTML="Field Required";
			}
			
			else if(isNaN(myobj.value))
			{
				
				//setTimeout(function() {myobj.focus();}, 0);
				myobj.focus();
				var span1=document.getElementById(myobj.name+"_1");
				span1.innerHTML="Not a numeric";
			}
			else
			{
				var span1=document.getElementById(myobj.name+"_1");
				span1.innerHTML="";
			}
			}
		}
		
    function add_question(choice)
	{
		 var i= id.toString(); 
		 //alert(choice);
		 var xmlhttp;
		 if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  			}
		 else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	  {
    		document.getElementById(i).innerHTML=xmlhttp.responseText;
          }
          }
			xmlhttp.open("GET","question.php?id="+ i+"&"+"choice="+choice,true);
			xmlhttp.send();

	}
	
	function new_question(choice)
	{
		id++;
		if(id==1)
		{
			$("#submit_quix").show();
		}
		//if(id==2)
		//alert(document.getElementById("ques1").value);
		 var i=id.toString();
		 //var id="2";
		 //alert(id);
		 var div2=document.createElement("div");
		 var form1=document.getElementById("questions");
		 form1.appendChild(div2);
		 div2.id=i;
		 add_question(choice);
	}
	
	function number_of_question()
	{
		var totalMarks=0;;
		var questions=document.getElementById("no_of_question");
		questions.value=id;
		for(var j=1;j<=id;j++)
		{
			totalMarks+=parseInt(document.getElementById("c_marks_"+j).value);
		}
		document.getElementById("totalMarks").value=totalMarks;
		//alert(totalMarks);
	}
	function ValidateForm()
		{
			var d=0;
			var myForm=document.forms["myForm"];
			for(var i=1;i<=id;i++)
			{
				if(document.getElementById("ques"+i).value=="" || document.getElementById(i+"_option1").value=="" || document.getElementById(i+"_option2").value=="" || document.getElementById(i+"_option3").value=="" || document.getElementById(i+"_option4").value=="" || document.getElementById("c_marks_"+i).value=="" || document.getElementById("w_marks_"+i).value=="")
				{
					d=1;
				}
			}
			if(d==1)
			{
				document.getElementById("span2").innerHTML="Fields are empty";
				if(document.getElementById("quiz_name").value=="")
				{
					document.getElementById("span1").innerHTML="Field is required";
				}
				else
				{
					document.getElementById("span1").innerHTML="";
				}
				if(myForm['date3'].value >date)
		 		{
			 		var span1=document.getElementById("span3");
			 		span1.innerHTML="Course expire before this date";
				}
				return false;
			}
			if(myForm['date3'].value >date || document.getElementById("quiz_name").value=="")
		 	{
				if(myForm['date3'].value >date)
				{
			 		var span1=document.getElementById("span3");
			 		span1.innerHTML="Course expire before this date";
			 	}
				else
				{
					var span1=document.getElementById("span3");
			 		span1.innerHTML="";
				}
				if(document.getElementById("quiz_name").value=="")
				{
					var span1=document.getElementById("span1");
			 		span1.innerHTML="Field is required";
				}
				else
				{
					var span1=document.getElementById("span1");
			 		span1.innerHTML="";
				}
				return false;
			}
			
			return true;	
		}
	
	
</script>
<style type="text/css" src="calendar/calendar.css"></style>
</head>

<body >
<form name="myForm" id="form1" action="quizfilecreation.php" method="POST" onsubmit="return ValidateForm()">
	<fieldset>
    	<legend align="center"><h1>Quiz Creation</h1></legend>
        <label for="quiz_name">Quiz Name:</label><input type="text" name="quiz_name" id="quiz_name"  onblur="ValidateName(this)"/><span id="span1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
        <label for="description">Description:<br /></label><textarea type="text" name="description" id="description" rows="10" cols="40"></textarea><hr />
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
	  ?><span id="span3" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
        <div id="questions">
        
        </div>
 		<span id="span2" style="color: red; font-size: 9px; font-style:italic;"></span>       
         <input type="button" id="multiple_choice" name="multiple_choice"  value="Add a Multiple-Choice question" onclick="new_question(0)"/>
         <input type="button" id="true_false" name="true_false"  value="Add a True-False question" onclick="new_question(1)"/>
         <input type="hidden" id= "no_of_question" name="no_of_question" value="" />
         <input type="hidden" name="totalMarks" id="totalMarks" />
        <input type="submit" id="submit_quix" name="quiz" value="Create Quiz" onclick="number_of_question()" />
        <input type="hidden" name="courseid" value="<?php echo $courseid; ?>" />
    </fieldset>
</form>




</body>
</html>