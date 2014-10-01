<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Lecture file submission</title>
</head>

<body>

<?php
	
	session_start();
	$userid=$_SESSION['userid'];
	$courseid=$_POST['courseid'];
	
	$filepath="user/".$userid."/";
	$allowed_filetypes = array('.pdf','.ppt','.pptx');
	$max_filesize=8388608;
	
	if(!file_exists($filepath))
	{
		mkdir($filepath,0777);
	}
	
	
	$con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;
		
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	
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

	
	$name=$_POST['ass_name'];
	$description=$_POST['ass_description'];
	
	if($_FILES['ass_file']['size']>0)
	{
		$filename=$_FILES['ass_file']['name'];
		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
	
		if(!in_array($ext,$allowed_filetypes))
			die("The file with this extension is not allowed");
	
		if(filesize($_FILES['ass_file']['tmp_name']) > $max_filesize)
			die('The file you attempted to upload is too large.');
		$file_link=$filepath.$id.$ext;
		move_uploaded_file($_FILES['ass_file']['tmp_name'],$file_link);
		mysql_query("INSERT INTO file values ('$id','$userid','$filename')") or die("Error executing a query");
		$assignment=array('name'=>$name,'description'=>$description,'file_link'=>$file_link,'file_name'=>$filename);
		
	}
	else
	{
		$assignment=array('name'=>$name,'description'=>$description,'file_link'=>"",'file_name'=>"");
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
	
	$ass_data=json_encode($assignment);
	
	$link=$filepath.$id.".json";
	
	$file=fopen($link,"w");
	fwrite($file,$ass_data);
	fclose($file);
	
	$filesize=filesize($link);
	$filetype=filetype($link);
	$filename=$id.".json";
	$query="INSERT INTO file(fileid,userid,filename) VALUES ('$id','$userid','$filename')"; 
	
	mysql_query($query) or die("Error executing query:".mysql_error());
	
	$query="INSERT INTO event VALUES (NULL,'$courseid','$id',NULL,CURDATE(),CURDATE(),NULL,NULL,'EASNY','$name')";
	
	mysql_query($query) or die("Error executing query:".mysql_error());
    mysql_close($con);
	
?>

 The event has been created successfully.Click here to <a href="timeline.php?courseid=<?php echo $_POST['courseid'];?>" target="action_frame">continue</a>
</body>
</html>