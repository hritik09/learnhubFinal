<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Taking a Quiz</title>
	
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
<?php
		if(isset($_GET['courseid']) && isset($_GET['eventid']))
		{
		$i=1;
		$courseid=$_GET['courseid'];
		$eventid=$_GET['eventid'];
		//$date=date("Y:m:d H:i:s",mktime(0,0,0,$_GET['month'],$_GET['day'],$_GET['year']));
		//mysql_connect("localhost","root","root") or die("Error connecting a database");
		//mysql_select_db("learnhub");
		//$result=mysql_query("SELECT * FROM event where courseid='$courseid' and event_date='$date'");
		$file=fopen("user/U101/149903.json","r");
		$string=fread($file,filesize("user/U101/149903.json"));
		fclose($file);
		$filestring=json_decode($string,true);
?>		

<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
var present=1;
var timer=0;
var total=<?php echo $filestring['TotalQuestion']?>;
$(document).ready(function(){
 $("a#show-panel").click(function(){
    $("#lightbox, #lightbox-panel").fadeIn(300);
	$("#"+present).show();
	for(var i=2;i<=total+1;i++)
	$("#"+i).hide();
 });
 $("a#next").click(function() {
	 for(var i=1;i<=present;i++)
	 $("#"+i).hide();
	 present++;
	 $("#"+present).show();
	 for(var i=present+2;i<=total+1;i++)
	 $("#"+i).hide();
	 if(present==total)
	 $("#next").hide();});
		
 $("a#close-panel").click(function(){
     $("#lightbox, #lightbox-panel").fadeOut(300);
 });
}); 

function set_Timer()
 {
	 timer=timer+1;
	 
 }

</script>
</head>

<body>

<a id="show-panel" href="#" onclick="set_Timer()">Show Panel</a>
<form id="myform" action="Quiz_Process.php" method="POST">
<div id="lightbox-panel">
  <h2>Online Quiz</h2>
    
    <?php
		$string="";
		while($i<=$filestring['TotalQuestion'])
		{ 
			if($filestring['questions'][$i-1]['type']=="mcq")
			{
				$string.= "<div id='$i'>
					<p>($i)".$filestring['questions'][$i-1]['question']."</p>
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
	}  
 
	
     echo "<input type='hidden' name='eventid' value='$eventid' />";
	 echo "<input type='hidden' name='courseid' value='$courseid'/>";	
?>
    
    <p align="center">
        <a id="close-panel" href="#">Close this window</a>
    </p>
    <p align="center">
     	<a id="next" href="#">Next Question</a>
    </p>
    
</div><!-- /lightbox-panel -->

<div id="lightbox"> </div><!-- /lightbox -->
</form>
</body>
</html>