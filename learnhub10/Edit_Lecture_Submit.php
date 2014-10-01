<strong></strong><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	session_start();
	$userid=$_SESSION['userid'];
	
	//$filename=$_FILES['lecture_file']['name'];
	//$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
	
	
	if($_POST['event_type']=="ELEFI")
	{   
	    $con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;	
		mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
		$eventid=$_POST['eventid'];
		$query="SELECT fileid,userid from event natural join file Where eventid='$_POST[eventid]'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
	    $filepath="user/".$row['userid']."/".$row[0].".json";
	     
		if($_FILES['lecture_file']['size']>0)
		{
			 $filename=$_FILES['lecture_file']['name'];
			$allowed_filetypes = array('.pdf','.ppt','.pptx');
		$max_filesize=8388608;
	
		$filename=$_FILES['lecture_file']['name'];
		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
		
		if(!in_array($ext,$allowed_filetypes)) 
			die("The file with this extension is not allowed");
		
		if(filesize($_FILES['lecture_file']['tmp_name']) > $max_filesize)
    	  die('The file you attempted to upload is too large.');
	      $id=rand(1,999999);
	
		$query="SELECT fileid FROM file where fileid='$id'";
		$result=mysql_query($query);
	
		while($row=mysql_fetch_array($result))
		{
			if($id==$row['fileid'])
			{
				$id=rand(1,999999);
				$query="SELECT fileid FROM file where fileid='$id'";
			    $result=mysql_query($query);
			}
		}
		
		$file_link="user/".$userid."/".$id.$ext;
		move_uploaded_file($_FILES['lecture_file']['tmp_name'],$file_link);
		$query="insert into file values ($id,$userid,$filename)";
		mysql_query($query);
		
		
		
		}
		else
		{
			
		$file=fopen($filepath,"r");
		$string=fread($file,filesize($filepath));
		$filestring=json_decode($string,true);
		$file_link = $filestring['file_link'];
		$filename=$filestring['file_name'];
		fclose($file);
		
		
			
		}
		
		$name=$_POST['topic'];
		$description=$_POST['description'];
		
	
		$finalstring=array("topic"=>$name,"description"=>$description,"file_link"=>$file_link,"file_name"=>$filename);
		$json_string=json_encode($finalstring);
		$file=fopen($filepath,"w");
		fwrite($file,$json_string);
		fclose($file);
        $query="update events set event_name='$name' where eventid='$eventid'";
		mysql_query($query);
	}
	else
	{
		$con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;	
		mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
		$eventid=$_POST['eventid'];
		$query="SELECT fileid,userid from event natural join file Where eventid='$eventid'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$filepath="user/".$row['userid']."/".$row[0].".json";
		$topic=$_POST['topic'];
		$description=$_POST['description'];
		$link=$_POST['lecture_video'];
		$new_data=array("topic"=>$topic,"description"=>$description,"file_link"=>$link);
		$json_string=json_encode($new_data);
		$file=fopen($filepath,"w");
		fwrite($file,$json_string);
		fclose($file);
		 $query="update events set event_name='$topic' where eventid='$eventid'";
		mysql_query($query);
		mysql_close($con);
	}
?>
The event has been edited successfully. Click here to <a href="timeline.php?courseid=<?php echo $_POST['courseid'];?>" target="action_frame">continue</a>
</body>
</html>

	
	