<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Lecture file submission</title>
</head>

<body>
<?php
	
	$con=mysql_connect("localhost","root","root");
	mysql_select_db("learnhub");
	
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
	session_start();
	$userid=$_SESSION['userid'];
	$courseid=$_POST['courseid'];
	
	$filepath="user/".$userid."/";
	
	if(!file_exists($filepath))
	{
		mkdir($filepath,0777);
	}
	
	$id=rand(1,999999);
	
	$query="SELECT fileid FROM file where fileid='$id'";
	$result=mysql_query($query) or die("Error executing a query");
	
	while($row=mysql_fetch_array($result))
	{
		if($id==$row['fileid'])
		{
			$id=rand(1,999999);
			$query="SELECT fileid FROM file where fileid='$id'";
		    $result=mysql_query($query);
		}
	}
	
	$filestring=$filepath.$id;
	$topic=$_POST["topic"];
	$description=$_POST["description"];
	if($_POST['lecture']=='video')
	{
		 $link=$_POST['lecture_video'];
		 //$url = parse_url($link);
		 //print_r($url);
		 //parse_str($url['query']);
		 //echo $v;
		 $data=array("topic"=>$topic,"description"=>$description,"file_link"=>$link);
	}
	else if($_FILES['lecture_file']['size']>0)
	{
	    $filename=$_FILES['lecture_file']['name'];
		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
		
		$allowed_filetypes = array('.pdf','.ppt','.pptx');
		$max_filesize=8388608;
		
		if(!in_array($ext,$allowed_filetypes)) 
			die("The file with this extension is not allowed");
		
		if(filesize($_FILES['lecture_file']['tmp_name']) > $max_filesize)
    	  die('The file you attempted to upload is too large.');
	  
		
		//echo "Hello";
		$filename=$_FILES['lecture_file']['name'];
		$filename=str_replace(" ","_",$filename);
		$filetype=$_FILES['lecture_file']['type'];
		$filesize=$_FILES['lecture_file']['size'];
		$tmpname=$_FILES['lecture_file']['tmp_name'];
		$link=$filestring.$ext;
		move_uploaded_file($tmpname,$link);
		$data=array("topic"=>$topic,"description"=>$description,"file_link"=>$link,"file_name"=>$filename);
		$query="INSERT INTO file values ('$id','$userid','$filename')";
		mysql_query($query) or die("Error:".mysql_error());
	}
	$id=rand(1,999999);
	
	$query="SELECT fileid FROM file where fileid='$id'";
	$result=mysql_query($query) or die("Error executing a query");
	
	while($row=mysql_fetch_array($result))
	{
		if($id==$row['fileid'])
		{
			$id=rand(1,999999);
			$query="SELECT fileid FROM file where fileid='$id'";
		    $result=mysql_query($query);
		}
	}
	
	$jason_file_data=json_encode($data);
	
	$file=fopen($filepath.$id.".json",'w');
	fwrite($file,$jason_file_data);
	fclose($file);
	
	if($_POST['lecture']=="video")
	{
		$filename=$id.".json";
		$query="INSERT INTO file values ('$id','$userid','$filename')";
		mysql_query($query) or die("Error:".mysql_error());
		$date=date('Y-m-d H:i:s');
		$query="INSERT INTO event values (NULL,'$courseid','$id',NULL,'$date','$date',NULL,NULL,'ELEVI','$topic')";
		mysql_query($query) or die("Error:".mysql_error());
	}
	
	else
	{
		$filename=$id.".json";
		$query="INSERT INTO file values ('$id','$userid','$filename')";
		mysql_query($query) or die("Error:".mysql_error());
		$date=date('Y-m-d H:i:s');
		$query="INSERT INTO event values (NULL,'$courseid','$id',NULL,'$date','$date',NULL,NULL,'ELEFI','$topic')";
	    mysql_query($query) or die("Error:".mysql_error());
	}
	
	mysql_close($con);
?>
 The event has been created successfully.Click here to <a href="timeline.php?courseid=<?php echo $_POST['courseid'];?>" target="action_frame">continue</a>
</body>
</html>