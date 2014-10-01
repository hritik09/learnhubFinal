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
	$courseid=$_POST['courseid'];
	$filepath="user/".$userid."/";
	
	
	 addslashes($filepath);
	if(!file_exists($filepath))
	{
		
		mkdir($filepath,0777);
	}
    // 1_option1 1_opton2 1_option3  1_option4 ques1
	$no_of_questions=$_POST['no_of_question']; 
	$description=$_POST['description'];
	$name=$_POST['quiz_name'];
	$i=1;
	//echo $_POST['totalMarks'];
	$file_string=array("name"=>$name,"description"=>$description,"TotalQuestion"=>$no_of_questions,"TotalMarks"=>$_POST['totalMarks']);
	while($i<=$no_of_questions)
	{
		if($_POST[$i.'_type']=='mcq')
		{
		$file_string['questions'][]=array("question"=>$_POST['ques'.$i],
							 "type"=>$_POST[$i.'_type'],
							 "answer"=>$_POST[$i.'_answer'],
							 "option1"=>$_POST[$i.'_option1'],
							 "option2"=>$_POST[$i.'_option2'],
							 "option3"=>$_POST[$i.'_option3'],
							 "option4"=>$_POST[$i.'_option4'],
							 "correct_answer_marks"=>$_POST['c_marks_'.$i],
							 "wrong_answer_marks"=>$_POST['w_marks_'.$i]
							 );
		}
		else
		{
		$file_string['questions'][]=array("question"=>$_POST['ques'.$i],
										  "type"=>$_POST[$i.'_type'],
										 "answer"=>$_POST[$i.'_answer'],
										 "correct_answer_marks"=>$_POST['c_marks_'.$i],
							             "wrong_answer_marks"=>$_POST['w_marks_'.$i]);
	    }
		$i++;
	}
	$json_string=json_encode($file_string);
	
	//echo $json_string;
	//echo $file_string[0]["question"];
	$con=mysql_connect("localhost","root","root") ;
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());

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
	$link=$filepath.$id.".json";
	
	$file=fopen($link,"w");
	fwrite($file,$json_string);
	fclose($file);
	$query="INSERT INTO file(fileid,userid,filename) VALUES ($id,'$userid','$_POST[quiz_name]')";
	
	mysql_query($query) or die("Error executing query:".mysql_error());
	$date=$_REQUEST['date3'];
	$filename="EQCRE_".$id;
	$query="INSERT INTO event VALUES (NULL,'$courseid','$id',NULL,CURDATE(),'$date',NULL,NULL,'EQCRE','$name')";
	
	mysql_query($query) or die("Error executing query:".mysql_error());	
	
	echo 'You have sucessfully created a new quiz';
	
	
	
	
?>
</body>
</html>