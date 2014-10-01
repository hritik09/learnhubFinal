<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Creating Lecture</title>

<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
  
	$(document).ready( function() { 
	$("#file").show();
	$("#video").hide();
	$("#submit").show();
	}
	);
	function lecture_type()
	{
		if(document.getElementById("lecturetype").value=="file")
		{
			$("#file").show();
			$("#video").hide();
			$("#submit").show();
		
		}
		else
		{
			$("#video").show();
			$("#file").hide();
			$("#submit").show();
		}
	}
	
	function ValidateLecture()
	{
		var myForm=document.forms["myForm"];
		if(document.getElementById("lecturetype").value=="file")
		{
		//var myForm=document.forms["myForm"];
		//var reg=/^[0-9A-Za-z]+(\.pdf|\.ppt|\.pptx)$/i;
		//var stri=myForm["lecture_file"].files[0].name.posstr()
		var reg=/^[0-9A-Za-z]+(\.pdf|\.ppt|\.pptx)$/i;
		if(myForm['topic'].value==null || myForm['topic'].value==""  || myForm["lecture_file"].files.length <1 || (myForm["lecture_file"].files.length >0 && !reg.test(myForm["lecture_file"].files[0].name)) )
		{
			if(myForm['topic'].value==null || myForm['topic'].value=="")
			{
				var span1=document.getElementById("1");
				span1.innerHTML="This field is required";
			}
			if(myForm["lecture_file"].files.length <1)
			{
				var span2=document.getElementById("2");
					span2.innerHTML="This field is required.";
			}
			if(myForm["lecture_file"].files.length >0 && !reg.test(myForm["lecture_file"].files[0].name))
			{
				
				var span2=document.getElementById("2");
					span2.innerHTML="Invalid file name.";	
			}

		return false;
		}
		return true;
		}
		else 
		{
			if(myForm['topic'].value==null || myForm['topic'].value=="" || myForm['lecture_video'].value=="" || !/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/.test(myForm['lecture_video'].value))
			{
				if(myForm['topic'].value==null || myForm['topic'].value=="")
			{
				var span1=document.getElementById("1");
				span1.innerHTML="This field is required";
			}
			if(myForm['lecture_video'].value=="")
			{
				var span1=document.getElementById("3");
				span1.innerHTML="This field is required";
			}
			else if(!/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/.test(myForm['lecture_video'].value))
				{
					var span1=document.getElementById("3");
					span1.innerHTML="Invalid You tube link";
				}
			else
				{
					var span1=document.getElementById("3");
					span1.innerHTML="";
					
				}
			return false;
		}
		return true;
		}
	}
	
	function ValidateInnerText(myobj)
	{
		if(myobj.name=="lecture_file" && document.getElementById("2").innerHTML=="This field is required" )
		{
			if(document.forms["myForm"]['lecture_file'].files.length>0)
		document.getElementById("2").innerHTML="";
		}
		if(myobj.name=="lecture_video")
		{
			if(myobj.value!="")
			document.getElementById("3").innerHTML="";
		}
		if(myobj.name=="topic")
		{
			if(myobj.value!="")
			document.getElementById("1").innerHTML="";
		}
	}

	

</script>
</head>

<body>
 

<div>
<?php
	session_start();

	?>
   
<form name="myForm" method="POST" action="createlecture_submission.php" enctype="multipart/form-data" onsubmit="return ValidateLecture()">
    	<fieldset>
    	<legend align="center"><h1>Lecture Creation</h1></legend>
        <label for="topic">Topic:</label>
        <input type="text" id="topic" name="topic" size="" maxlength="" onblur="ValidateInnerText(this)"/><span  id="1" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
        <label for="description">Lecture Description:</label><br />
        <textarea rows="10" cols="40" id="description" name="description" ></textarea><br /><br />
  		<label for="lecture_type">Lecture type:</label>
        <select name="lecture" id="lecturetype">
        	<option value="file" onclick="lecture_type()">File</option>
            <option value="video" onclick="lecture_type()">Video</option>
        </select >
        <div id="file">  
            Enter then file:<input type="file" name="lecture_file"  onblur="ValidateInnerText(this)" /><p id="2" style="color: red; font-size: 9px; font-style:italic;"></p> 
        </div>   
        <div id="video">
        	Enter You tube link:<input type="text" name="lecture_video"   /><span id="3" style="color: red; font-size: 9px; font-style:italic;" ></span>
        </div>
        <div id="submit">
        <input type="submit" value="Create" target="action_frame"/>
        </div>
		<input type="hidden" name="courseid" value="<?php echo $_GET['courseid']?>" />
    </fieldset>
        
        
    </form>	
    
</div>
</body>
</html>