<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quiz</title>
<?php
			mysql_connect("localhost","root","root") or die("Error connecting a database");
			mysql_select_db("learnhub");
			$result=mysql_query("SELECT * from event where resp_eventid=33") or die("Error".mysql_error());
			
?>
<script type="text/javascript">
	function ValidateUserQuiz()
	{
		if(<?php echo $result==0;?>)
		return true;
		else
		{
		document.getElementById("fail").innerHTML="Quiz already given";	
		return false;
		}
	}
</script>
</head>

<body>
<a href="Taking_Quiz.php?courseid=C102&eventid=33" onclick=" return ValidateUserForQuiz()">Give a Quiz</a>
<div id="fail"> </div>
</body>
</html>