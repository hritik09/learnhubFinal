<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit a Lecture</title>

<?php
	session_start();
	
	$con=mysql_connect("localhost","root","root") or die("Error connecting a database");
	mysql_select_db("learnhub");
	$eventid=$_GET['eventid'];
	$query="SELECT event_type,fileid,userid,courseid from event natural join file where eventid='$eventid'";
	$result=mysql_query($query) or die("Error executing a query");
	$row=mysql_fetch_array($result);
	mysql_close($con);
	$userid=$row['userid'];
	$filepath="user/".$userid."/".$row[1].".json";
	
	$file=fopen($filepath,"r");
	$filedata=fread($file,filesize($filepath));
	fclose($file);
    $filestring=json_decode($filedata,true);
	$ass_name=$filestring['topic'];
	$ass_description=$filestring['description'];
	if($row[0]=="ELEFI")
	{
		 $ass_link=$filestring['file_link'];
		 $ass=$filestring['file_name'];
	}
	else
	{
		$video_link=$filestring['file_link'];
	}
	
?>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function ValidateLectureFile()
	{
		
		var myForm=document.forms["myForm"];
		var reg=/^[0-9A-Za-z_]+(\.pdf|\.ppt|\.pptx)$/i;
		if(myForm['topic'].value==null || myForm['topic'].value=="" || (myForm["lecture_file"].files.length >0 && !reg.test(myForm["lecture_file"].files[0].name)) )
		{
			
			if(myForm['topic'].value==null || myForm['topic'].value=="")
			{
				var span1=document.getElementById("1");
				span1.innerHTML="This field is required";
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
	function ValidateLectureVideo()
	{
		var myForm=document.forms["myForm"];
		if(myForm['topic'].value==null || myForm['topic'].value==""|| myForm['lecture_video'].value=="" )
		{
			if(myForm['topic'].value==null || myForm['topic'].value=="")
			{
				var span1=document.getElementById("1");
				span1.innerHTML="This field is required";
			}
		
			if(myForm['lecture_video'].value=="")
			{
				var span1=document.getElementById("2");
				span1.innerHTML="This field is required";
			}
			
		return false;
		}
		return true;
	}
	function ValidateInnerText(myobj)
	{
		/*if(myobj.name=="lecture_file")
		{
			if(document.forms["myForm"]['lecture_file'].files.length>0  && document.getElementById("2").innerHTML=="This field is required")
		document.getElementById("2").innerHTML="";
		}*/
		if(myobj.name=="lecture_video")
		{
			if(myobj.value!="")
			document.getElementById("2").innerHTML="";
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
<div id="main">

   
	<form name="myForm" method="POST" action="Edit_Lecture_Submit.php" enctype="multipart/form-data" >
    	<fieldset>
    		<legend align="center"><h1>Edit a Lecture</h1></legend>
        	<label for="topic">Topic:</label>
	    	    <input type="text" id="topic" name="topic" size="" maxlength="" onblur="ValidateInnerText(this)" value="<?php echo $ass_name; ?>"/><span id="1" style="color: red; font-size: 9px; font-style:italic;"></span><br /><br />
        	<label for="description">Description:</label><br />
    		    <textarea rows="10" cols="40" id="description" name="description"  value=""><?php echo $ass_description; ?></textarea><br /><br />
        	<?php 
				if($row[0]=="ELEFI")
				{
			?>		
            	<div id="file">  
            		Previous Uploaded File:<a href="Downloading.php?link=<?php echo $ass_link ?>&file=<?php echo $ass ?>"><?php echo $ass ?></a><br /><br />
        		    Enter the file:<input type="file" name="lecture_file"  /> <span id="2" style="color: red; font-size: 9px; font-style:italic;"></span>
        		</div>
                	<input type="submit" value="Edit" onclick="return ValidateLectureFile()"/>
             
             <?php
				}
                else
                 {
			 ?>		 
        		  <div id="video">
        		 	Enter You tube link:<input type="text" name="lecture_video" id="lecture_video"  onblur="ValidateInnerText(this)" value="<?php echo $video_link ?>" /><span id="2" style="color: red; font-size: 9px; font-style:italic;"></span>
        	     </div>
                 	<input type="submit" value="Edit" onclick="return ValidateLectureVideo()" />
			 <?php
                 }
			?>	 
        	   <input type="hidden" name="eventid" value="<?php echo $_GET['eventid']; ?>"/><br />
               <input type="hidden" name="event_type" value="<?php echo $row[0]; ?>"/><br />
               <input type="hidden" name="courseid" value="<?php echo $row['courseid']; ?>"/><br />
    	</fieldset>
    	    
        
 	</form>	
    
</div>

</body>
</html>