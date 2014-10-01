<?php
		session_start();
		$msg=$_GET['message'];
		$userid=$_SESSION['userid'];
		$courseid=$_GET['courseid'];
		$con=mysql_connect("localhost","root","root") or die("Error connecting a database");
			mysql_select_db("learnhub") or die("Error selecting a database");
			if(!file_exists("user/".$userid."/"))
			{
				mkdir("user/".$userid."/",0777);
			}
			$id=rand(1,999999);
	
			$query='SELECT fileid FROM file';
			$result=mysql_query($query);
	
			while($row=mysql_fetch_array($result))
			{
				if($id==$row['fileid'])
				{
					$id=rand(1,999999);
				    $result=mysql_query($query);
				}
			}
			$filestring="user/".$userid."/".$id.".json";
			$file=fopen($filestring,"w");
			fwrite($file,$msg);
			fclose($file);
			$query="INSERT INTO file values ('$id','$userid',NULL)";
			mysql_query($query) or die("Error executing a query");
			$time=date("Y-m-d H:i:s");
			$query="INSERT INTO event values (NULL,'$courseid','$id',NULL,'$time',NULL,NULL,NULL,'ETEST',NULL)";
			mysql_query($query) or die("Errror executing a query");
			mysql_close($con);
			echo $time;
?>
