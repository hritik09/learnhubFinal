<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
	session_start();
	$userid=$_SESSION['userid'];
	$courseid=$_GET['courseid'];
	$posted="0";
	$con=mysql_connect("localhost","root","root") or die("Error connecting a database");
	mysql_select_db("learnhub");
	$query="SELECT fileid,userid,event_date FROM event natural join file where courseid='$courseid' and event_type='ETEST'";
	$result=mysql_query($query);
	$test="";
	echo "<h1 align='center'>Testimonial</h1><hr /><br />";
	while($row=mysql_fetch_array($result))
	{
		if($userid==$row[1])
		$posted="1";
		$date=$row[2];
		$filestring="user/".$row[1]."/".$row[0].".json";
		$file=fopen($filestring,"r");
		$data=fread($file,filesize($filestring));
		$test.="<p>".$data;
		$test.="<div align='right' style='font-style:italic; color: red; font-size: 10px;' class=\"time_user\">".$row[1]." ";
		$test.=$row[2]."</div></p><hr />";
		fclose($file);
	}
	//$test.="</div>";
	mysql_close($con);
?>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script type='text/javascript'>
    var posted="<?php echo $posted;?>";
	var user="<?php echo $userid; ?>";
	var courseid="<?php echo $courseid;?>";
	$(document).ready(function() {
			if(posted=="1")
			{
			$("#post").hide();
			$("#msg").hide();
			}
			});
 	function StoreinFile()
	{
		if(document.getElementById("msg").value=="")
		return false;
		var time;
		var date=new Date();
		var strdate=date.getFullYear()+"-";
		if(date.getMonth()<10)
		strdate+="0"+date.getMonth()+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
		else
		strdate+=date.getMonth()+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
		var msg=document.getElementById("msg").value;
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
    				time=xmlhttp.responseText;
    			}
  	}	  
		    xmlhttp.open("GET","Process_Testimon.php?message="+msg+"&courseid="+courseid ,true);
			xmlhttp.send();			
			$("#post").hide();
			$("#msg").hide();
			var parent=document.getElementById("main");
			var msge=document.getElementById('msg');
			var newp=document.createElement("p");
			newp.appendChild(document.createTextNode(msg));
			parent.insertBefore(newp,msge);
			var table=document.createElement("p");
			table.appendChild(document.createTextNode(user+" " +strdate));
			parent.insertBefore(table,msge);
	}
</script>

</head>

<body>
	<div id="main" align="center">
    	<?php echo $test;?>
        <?php $date=date("Y-m-d H:i:s"); ?>
    	<textarea id="msg" rows="10" cols="50"></textarea>
    	<button type="button" name="post" id="post" onclick="StoreinFile()">POST</button>
    </div>
</body>
</html>