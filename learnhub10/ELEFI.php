<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<title>LearnHub: Lecture File</title>
</head>

<body>
<?php
	session_start();
	$userid=$_SESSION['userid'];
	mysql_connect("localhost",'root','root') or die("Error connecting to database:".mysql_error());
	mysql_select_db("learnhub");
	$eventid=$_GET['eventid'];;
	$query="SELECT fileid,event_type,userid from event natural join file where eventid='$eventid'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	
	$filepath="user/".$row['userid']."/".$row[0].".json";
	
	$file=fopen($filepath,"r");
	$filedata=fread($file,filesize($filepath));
    $filestring=json_decode($filedata,true);
	$ass_name=$filestring['topic'];
	$ass_description=$filestring['description'];
	echo "<h1 align='center'>Lecture File</h1><hr /><br />";
	echo "<p>Lecture Name: ".$ass_name."</p>";
	echo "<p>Lecture Description: ".$ass_description."</p>";
	if($row[1]=="ELEFI")
	{
	if($filestring['file_link']!="")
	{
		$ass_link=$filestring['file_link'];
		$ass=$filestring['file_name'];
		
?>
		<p>Lecture File:<a href="Downloading.php?link=<?php echo $ass_link ?>&file=<?php echo $ass ?>"> <?php echo $ass ?></a></p>	
<?php        
	}
	}
	else
	 {
		 $link="user/".$row[2]."/".$row[0].".json";
 		$file=fopen($link,"r");
 		$string=fread($file,filesize($link));
 		fclose($file);
 		$data=json_decode($string,true);
 		$link=$data['file_link'];
		$url = parse_url($link);
		//print_r($url);
		parse_str($url['query']);
 		$ylink="http://www.youtube.com/embed/".$v;
?>
		<iframe id="you-tube" src="<?php echo $ylink ?>" width="430" height="340" type="text/html"></iframe>		
<?php	 
     }
?>	
</body>
</html>