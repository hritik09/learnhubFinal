<html>
<head>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
$eventid=$_GET['eventid'];
$con=mysql_connect("localhost","root","root") or die("Error connecting a database".mysql_error());
mysql_select_db("learnhub");
$result=mysql_query("SELECT due_date from event where eventid='$eventid'") or die("Error executing a query".mysql_error());
$row=mysql_fetch_array($result);
$date=substr($row[0],0,strpos($row[0]," "));
 
?>
<?php
        $con=mysql_connect("localhost","root","root");
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
		if(isset($_GET['eventid']))
		{
		$i=1;	
		;
		$eventid=$_GET['eventid'];
		//$date=date("Y:m:d H:i:s",mktime(0,0,0,$_GET['month'],$_GET['day'],$_GET['year']));
		// mysql_connect("localhost","root","root") or die("Error connecting a database");
		// mysql_select_db("learhub");
		$result=mysql_query("SELECT fileid,userid,courseid FROM event natural join file where eventid='$eventid' ");
		$row=mysql_fetch_array($result);
		$file=fopen("user/".$row[1]."/".$row[0].".json","r");
		$string=fread($file,filesize("user/".$row[1]."/".$row[0].".json"));
		fclose($file);
		$filestring=json_decode($string,true);
		
		echo "<h1 align='center'>Quiz</h1><hr /><br />";
		echo "Name: ".$filestring['name']."<br /><br />";
		echo "Description: ".$filestring['description']."<br /><br />";

		
		}
?>

		<form method="post" action="EQCRE1.php" target="_parent" >
        <input type="hidden" name="courseid" value="<?php echo $row['courseid']?>">
        <input type="hidden" name="eventid" value="<?php echo $_GET['eventid']?>">
        Quiz Due-Date: <?php echo $date ?> <br /><br />
        <?php
        if($date >date("Y-m-d"))
        echo '<input type="submit" value="Take Quiz">';
		else
		{
			echo '<input type="submit" value="Take Quiz" disabled="disabled">';
			echo 'The due date for this quiz is over'; 
		}
		?>
</form>
</body>
</html>

