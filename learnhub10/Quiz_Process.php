<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing a Quiz</title>
</head>

<body>
	<?php
	    ob_start();
		session_start();
		$userid=$_SESSION['userid'];
		$eventid=$_POST['eventid'];
		$courseid=$_POST['courseid'];
		if(isset($_POST['feedback'])){ $feedback=$_POST['feedback'];} else { $feedback="";}
		$con=mysql_connect("localhost","root","root") or die("Error connecting a database");
		mysql_select_db("learnhub") or die("Error selecting a database");
		$query="SELECT fileid,userid from event natural join file where eventid='$eventid'";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$filelink="user/".$row[1]."/".$row[0].".json";
		$file=fopen($filelink,"r");
		$string=fread($file,filesize($filelink));
		fclose($file);
		$filestring=json_decode($string,true);
		
		
		$questions=$filestring['TotalQuestion'];
		$i=1;
		$totalmarks=0;
		
		while($i<=$questions)
		{
			$correct=$filestring['questions'][$i-1]['answer'];
			if(isset($_POST[$i]))
			{
			$user_answer=$_POST[$i];
			if($user_answer==$correct)
			$totalmarks+=$filestring['questions'][$i-1]['correct_answer_marks'];
			else
			$totalmarks-=$filestring['questions'][$i-1]['wrong_answer_marks'];
			$answers['answers'][''.$i]=$user_answer;
			}
			else
			$answers['answers'][''.$i]="";
			$i++;
		}
		mysql_select_db("learnhub");
		$valid="SELECT userid from event natural join file where resp_eventid='$eventid' and event_type='EQEVAL' and userid='$userid'";
		$result=mysql_query($valid) or die("Error".mysql_error());
		$a=mysql_num_rows($result);
		if($row=mysql_fetch_array($result))
		{
		echo "You have already given a quiz.<br />";	
		echo "Total Marks Scored in this attempt=".$totalmarks;
		}
		else
		{
		$id=rand(1,999999);	
		$query="SELECT fileid from file where fileid='$id'";
		$result=mysql_query($query) or die("Error executing a query");
		
		while($row=mysql_fetch_array($result))
		{
			if($id==$row[0])
			{
				$id=rand(1,999999);
				$query="SELECT fileid from file where fileid='$id'";
			    $result=mysql_query($query) or die("Error executing a query");
			}
				
			
		}
		$openlink="user/".$userid."/";
		if(!file_exists($openlink))
		{
			mkdir($openlink,0777);
		}
		$file=fopen("user/".$userid."/".$id.".json","w");
		$answers['TotalMarks']=$filestring['TotalMarks'];
		$answers['MarksScores']=$totalmarks;
		$string=json_encode($answers);
		fwrite($file,$string);
		fclose($file);
		//Entering entries in the table
		//$userid=$_SESSION['userid'];
		$filename='Quiz_s'.$id;
		mysql_query("INSERT INTO file values ('$id','$userid','$filename')") or die("Error executing a query");
		$date=date("Y-m-d H:i:s");
		$filename="EQEVAL_".$id;
		 $query="INSERT INTO event values (NULL,'$courseid','$id','$eventid','$date','$date','$totalmarks','$feedback','EQEVAL','$filename')";
		mysql_query($query) or die("Error executing query  ".mysql_error());
		echo "Your quiz has been submitted and you have scored ".$totalmarks."/".$filestring['TotalMarks'];
		}
		
		
	?>
</body>
click here to <a href='course.php?courseid=<?php echo $courseid;?>' >continue</a>
</html>