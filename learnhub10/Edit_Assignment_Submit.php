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
   
        $con=mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;	
		mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
		$eventid=$_POST['eventid'];
	    $query="SELECT fileid,userid from event natural join file Where eventid='$_POST[eventid]'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
	    $filepath="user/".$row['userid']."/".$row[0].".json";
	
	if($_FILES['ass_file']['size']>0)
	{
	$allowed_filetypes = array('.pdf','.ppt','.pptx');
	$max_filesize=8388608;
	
	$file_name=$_FILES['ass_file']['name'];
	$ext = substr($file_name, strpos($file_name,'.'), strlen($file_name)-1);
	
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
			$query="SELECT fileid FROM file where filed='$id'";
		    $result=mysql_query($query);
		}
	}
	$file_link="user/".$userid."/".$id.$ext;
	move_uploaded_file($_FILES['ass_file']['tmp_name'],$file_link);
	
	
	}
	else
	{
	$file=fopen($filepath,"r");
	$string=fread($file,filesize($filepath));
	$filestring=json_decode($string,true);
	$file_link = $filestring['file_link'];
    $file_name=$filestring['file_name'];
	fclose($file);
	
		
		
	}

	

	$name=$_POST['ass_name'];
	$description=$_POST['ass_description'];

	
	$finalstring=array("name"=>$name,"description"=>$description,"file_link"=>$file_link,"file_name"=>$file_name);
	$json_string=json_encode($finalstring);
	$file=fopen($filepath,"w");
	fwrite($file,$json_string);
	fclose($file);
    $query="UPDATE event set event_name='$name', due_date='$_POST[date3]' where eventid='$_POST[eventid]'";
	mysql_query($query) or die("Error executing a query");
?>
The event has been edited successfully.Click here to <a href="timeline.php?courseid=<?php echo $_POST['courseid'];?>" target="action_frame">continue</a>;
</body>
</html>