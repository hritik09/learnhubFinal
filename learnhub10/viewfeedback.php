<html>
<head>
<title> LearnHub: Feedbacks</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<style type="text/css">
td
{
text-align: center;
}
</style>
</head>
<body>
<div align="center">
<h1> Feedbacks</h1><hr /><br />
<?php

$con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  
  
  mysql_select_db("learnhub", $con);
  
    $query="Select eventid,event_name,event_type from event where event_type in ('EQCRE','EASNY') and courseid='$_GET[courseid]'";
    $sql=mysql_query($query);
	echo <<<EOS
	<table width= 100%>
	<tr><td style='font-size: 20px; text-align: left;'>Event Name</td><td width='1' bgcolor='blue'><BR></td><td style='font-size: 20px;'>Action</td></tr><tr><td><hr /></td><td><hr /></td><td><hr /></td></tr>
	
	
EOS;
    while($row=mysql_fetch_array($sql))
	{    
	    echo "<tr><td style='text-align: left;'>";
		switch($row['event_type'])
		{
			case 'EQCRE':
			echo "<a  target='action_frame' href='EQCRE.php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' >".$row['event_name']."</a>";
			
			break;
			
			case 'EASNY';
			echo "<a  target='action_frame' href='EASNY.php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' >".$row['event_name']."</a>";
			break;
			
			
		}
		echo "</td><td width='1' bgcolor='blue'><BR></td><td ><a  target='action_frame' href='feedbackview.php?courseid=".$_GET['courseid']."&eventid=".$row['eventid']."' >View Feedback</a></td></tr>";
		
	}
    
     echo "</table>";   
		
?>
</div>
</body>
</html>
		