<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
			session_start();
			$userid=$_SESSION['userid'];
			mysql_connect("localhost","root","root") or die("Error connecting a database");
			mysql_select_db("learnhub");
			//$result=mysql_query("SELECT * from event where resp_eventid='$_GET[eventid]' and event_type='EQEVAL'") or die("Error".mysql_error());
			//$a=mysql_num_rows($result);
			
?>
<?php
		if(isset($_POST['courseid']) && isset($_POST['eventid']))
		{
		$i=1;	
		$courseid=$_POST['courseid'];
		$eventid=$_POST['eventid'];
		//$date=date("Y:m:d H:i:s",mktime(0,0,0,$_GET['month'],$_GET['day'],$_GET['year']));
		// mysql_connect("localhost","root","root") or die("Error connecting a database");
		// mysql_select_db("learhub");
		$result=mysql_query("SELECT fileid,userid FROM event natural join file where eventid='$eventid' ");
		$row=mysql_fetch_array($result);
		$file=fopen("user/".$row[1]."/".$row[0].".json","r");
		$string=fread($file,filesize("user/".$row[1]."/".$row[0].".json"));
		fclose($file);
		$filestring=json_decode($string,true);
		}
?>		
<style>
	* /Lightbox background */
#lightbox {
 display:none;
 background:#000000;
 opacity:0.9;
 filter:alpha(opacity=90);
 position:absolute;
 top:0px;
 left:0px;
 min-width:100%;
 min-height:100%;
 z-index:1000;
}
/* Lightbox panel with some content */
#lightbox-panel {
 display:none;
 position:fixed;
 top:100px;
 left:50%;
 margin-left:-200px;
 width:400px;
 background:#FFFFFF;
 padding:10px 15px 10px 15px;
 border:2px solid #CCCCCC;
 z-index:1001;
}
</style>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	var present=1;
	var total=<?php echo $filestring['TotalQuestion']?>;
	function ValidateUserQuiz()
	{
			$("#lightbox, #lightbox-panel").fadeIn(300);
			$("#"+present).show();
			for(var i=2;i<=total+1;i++)
			$("#"+i).hide();
			$("#feedback").hide();
			$("#lab_feed").hide();
	}
	function nextquestion()
	{
	for(var i=1;i<=present;i++)
	 $("#"+i).hide();
	 present++;
	 $("#"+present).show();
	 $("#lab_feed").hide
	 $("#feedback").hide();
	 for(var i=present+2;i<=total+1;i++)
	 $("#"+i).hide();
	 if(present==total)
	 {
	 $("#next").hide();
	 $("#feedback").show();
	 $("#lab_feed").show();
	 }
	}
	function closequiz()
	{
		$("#lightbox, #lightbox-panel").fadeOut(300);
	}
	
</script>
</head>

<body onload="ValidateUserQuiz()" style='background-color: #F1F1F1; '>

<div id="fail"></div>
<div align="center"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>
<form id="myform" action="Quiz_Process.php" method="POST" >
<div id="lightbox-panel" style='border: 2px solid black; -moz-border-radius: 15px;
	border-radius: 15px; margin-top: 40px;'>
  <h1 align="center">Online Quiz</h1><hr />
    
    <?php
		$string="";
		while($i<=$filestring['TotalQuestion'])
		{ 
			if($filestring['questions'][$i-1]['type']=="mcq")
			{
				$string.= "<div id='$i'> 
					<h2>$i: ".$filestring['questions'][$i-1]['question']."</h2>
					<p><input type='radio' name='$i' value='1'/>".$filestring['questions'][$i-1]['option1']."</p>
    	 		    <p><input type='radio' name='$i' value='2'/>".$filestring['questions'][$i-1]['option2']."</p>
					<p><input type='radio' name='$i' value='3'/>".$filestring['questions'][$i-1]['option3']."</p>
					<p><input type='radio' name='$i' value='4'/>".$filestring['questions'][$i-1]['option4']."</p>
					<input type='submit' name='quiz".$i."' value='Submit the quiz' />
    		  		</div>";
			}
			else
			{
				$string.="<div id='$i'>
					<p>($i)".$filestring['questions'][$i-1]['question']."</p>
					<p><input type='radio' name='$i' value='true'/>True</p>
     		    	<p><input type='radio' name='$i' value='false'/>False</p>
					<input type='submit' name='quiz".$i."' value='Submit the quiz' /></div>";
			}
			$i++;
		}
		echo $string;   
 
	
     echo "<input type='hidden' name='eventid' value='$eventid' />";
	 echo "<input type='hidden' name='courseid' value='$courseid'/>";	
?>
    
   
    <p align="center">
     	<a id="next" href="#" onclick="nextquestion()">Next Question</a>
    </p>
    <span id="lab_feed">Give your feedback:</span>
    <input type="text" id="feedback" name="feedback"  />
</div><!-- /lightbox-panel -->

<div id="lightbox"> </div><!-- /lightbox -->
</form>
<div align="center" style="Float: bottom; margin-top: 480px;" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</body>
</html>