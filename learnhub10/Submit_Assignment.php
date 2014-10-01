<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
    session_start();
	$userid=$_SESSION['userid'];
	$con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());
		
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	
	if(isset($_POST['eventid']))
	{
	$eventid=$_POST['eventid'];
	
	$query="SELECT courseid from event where eventid='$eventid'";
	$result=mysql_query($query) or die("Error executing a query".mysql_error());
	$row=mysql_fetch_array($result);
	$courseid=$row[0];
	
	}
	if($_FILES['ass_file']['size']>0)
	{
	$filepath="user/".$userid."/";
	$allowed_filetypes = array('.pdf','.ppt','.pptx',);
	$max_filesize=8388608;
	
	if(!file_exists($filepath))
	{
		mkdir($filepath,0777);
	}
	$filename=$_FILES['ass_file']['name'];
	$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
	
	if(!in_array($ext,$allowed_filetypes))
		die("The file with this extension is not allowed");
	
	if(filesize($_FILES['ass_file']['tmp_name']) > $max_filesize)
    	die('The file you attempted to upload is too large.');
	
	$id=rand(1,999999);
	
	$query="SELECT fileid FROM file where fileid='$id'";
	$result=mysql_query($query);
	
	while($row=mysql_fetch_array($result))
	{
		if($id==$row['fileid'])
		{
			$id=rand(1,999999);
		    $result=mysql_query($query);
		}
	}
	 
	 if(isset($_POST['feedback']))
	 {$feedback=$_POST['feedback'];}
	 else
	 {$feedback='';}
	 $query="INSERT INTO file values('$id','$userid','$filename')";
	 mysql_query($query) or die("Error executing a query");
	 $date=date("Y-m-d H:i:s");
	 $filename='EASUP_'.$id;
	 $query="select eventid,userid from event natural join file where resp_eventid='$eventid' and event_type='EASUP' and userid='$userid'";
	 $result=mysql_query($query);
	 if($row=mysql_fetch_array($result))
	 { $query="Update event set fileid='$id',event_eval='',event_feedback='$feedback',event_name='$filename' where eventid=$row[eventid]"   ;  }
	 else
	 {$query="INSERT INTO event values(NULL,'$courseid','$id','$eventid','$date',NULL,NULL,'$feedback','EASUP','$filename')";}
	  mysql_query($query) or die("Error executing a query");
	
	}
	$filepath="user/".$userid."/".$id.$ext;
	move_uploaded_file($_FILES['ass_file']['tmp_name'],$filepath);
	mysql_close($con);
?>
 The assigment has been successfully submitted.Click here to <a href="timeline.php?courseid=<?php echo $courseid;?>" target="action_frame">continue</a>
</body>
</html>