<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forum Thread Management</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">

	<div id="rightnav1">
	<h2 align="center">You are Logged in as 
    <?PHP 
	session_start();
	echo "<a href=user.php?userid=".$_SESSION['userid'].">";
    
		echo $_SESSION['firstname'];
	
	?></h2>
     <a href="index.php">
    Home
    </a>
    </a>
    <a href="logout.php">
    Logout
    </a>
	</div>
    <div id="header2">
<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>

</div>
<div align="center">
<div align="center" style="width: 500px;">

<?php

    function OpenSQLConnection()
	{
	$link = mysql_connect("localhost", "root", "root") or die("Could not connect to the database");

	mysql_select_db("learnhub") or die("Could not select specified database");
	    
	return $link;
	}
	function redirectTo( $url )
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");   
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");                         

		$head = "Location: $url";
		header($head);
		exit;
	}
	
	function PrintTitle($title)
	{
		print "<span class=\"pageHeadline\">$title</span><p></p>\n";
	}
    
	function PrintThreadName($thread)
	{
		$query = "SELECT Title FROM ThreadList WHERE ThreadID = $thread";
		$result = mysql_query($query) or die("Failed while trying to find the thread name");
		
		if($result==0)
		$title="";
				
		$line = mysql_fetch_row($result);
		
		if ($line)
			$title = $line[0];
		
		return $title;
	}

	function ShowTopicManagementList($courseid)
	{
		PrintTitle("<h1>Manage Discussion Forum</h1><hr />");
		print "<p>Manage the topics and posts below:</p>";
	
		$query = "SELECT * FROM ThreadList where courseid='$courseid' ORDER BY ThreadID DESC";
		$result = mysql_query($query) or die("Failed while trying to show topic management list");

		if( mysql_num_rows($result) > 0 )
		{
			print "<div><table border=\"1\" cellpadding=\"4\" cellspacing=\"0\">\n";
			print "<tr><th>Thread</th><th>Action</th><th>Title</th><th>Author</th><th>Posts</th></tr>\n";
			while ($line = mysql_fetch_row($result)) 
			{
				print "<tr><td>$line[0]</td><td><a href=\"manage.php?cmd=manage_deleteThread&amp;thread=$line[0]&amp;courseid=".$courseid."\" ";
				print "onclick=\"return confirm('Delete this thread?')\">delete</a></td>";
				print "<td><a href=\"manage.php?cmd=manage_showThread&amp;thread=$line[0]&amp;courseid=".$courseid."\">$line[1]</a></td><td>$line[2]</td><td>$line[5]</td></tr>\n";
			}
	
			print "</table><p></p></div>\n";
		}
		else
		{
			print "<p>There are no entries in the discussion forum.</p>\n";
		}
		print "<p>View Recent<a href='forum.php?courseid=".$courseid."'> Topics</a>";
	}

	function ShowThisThread( $thread,$courseid)
	{
		$query = "SELECT * FROM MessageList WHERE ThreadID = $thread ORDER BY CreationDate";
		$result = mysql_query($query) or die("Failed while trying to show thread");
		
		if( mysql_num_rows($result) > 0)
		{
		$title = PrintThreadName($thread);
		
		PrintTitle( "<h1>Manage Thread</h1><hr />" );
		print "<p>Manage thread '$title'</p>";
		}

		
	    
		if( mysql_num_rows($result) < 1 )
		{
			redirectTo("manage.php?courseid=".$courseid);
		}

		print "<div><table border=\"1\" cellpadding=\"4\" cellspacing=\"0\">\n";
		print "<tr><th>ID</th><th>Action</th><th>Message</th><th>Author</th></tr>\n";

		while ($line = mysql_fetch_row($result)) 
		{
			print "<tr><td>$line[0]</td><td><a href=\"manage.php?cmd=manage_deletePost&amp;thread=$line[6]&amp;message=$line[0]&amp;courseid=".$courseid."\"";
			print "onclick=\"return confirm('Delete this post?')\">";
			print "delete</a></td><td>$line[2]</td><td>$line[3]</td></tr>\n";
		}
	
		print "</table><p></p></div>\n";
		print "View <a href=\"manage.php?courseid=".$courseid."\">Management Page</a>";
	}

function DeleteThisPost( $thread, $message )
{	
	$query = "SELECT Posts FROM ThreadList WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or die("Failed while trying to delete post");
	    
	if( mysql_num_rows($result) == 1 )
	{
		$line = mysql_fetch_row($result);
		if( $line[0] == "1" )
			$query1 = "DELETE FROM ThreadList WHERE ThreadID = '$thread'";
		else
			$query1 = "UPDATE ThreadList set Posts=Posts-1 WHERE ThreadID = '$thread'";

		$query2 = "DELETE FROM MessageList WHERE MessageID = '$message'";
		mysql_query( $query1 ) or die("Error deletig a thread");
		mysql_query( $query2 ) or die("Error deleting a post");
	}
}


function DeleteThisThread( $thread )
{	
	$query1 = "DELETE FROM ThreadList WHERE ThreadID = '$thread'";
	$query2 = "DELETE FROM MessageList WHERE ThreadID = '$thread'";
	mysql_query($query1) or die("Error deleting a thread");
	mysql_query($query2) or die("Error deleting messages of thread");
}
	if(isset($_POST['cmd']))
	$cmd=$_POST['cmd'];
  	else if(isset($_GET['cmd']))
	$cmd=$_GET['cmd'];
	else
	$cmd="";
	
	
 if ($cmd == "manage_deleteThread" )
{
	$courseid=$_GET['courseid'];
	$thread = $_GET['thread'];

		$link = OpenSQLConnection()
			or die( "Unable to open a connection to the database" );
		DeleteThisThread( $thread );		
		ShowTopicManagementList($courseid);
		mysql_close($link);
}
	else if ($cmd == "manage_showThread" )
{
	$courseid=$_GET['courseid'];
	$thread = $_GET['thread'];
		$link = OpenSQLConnection()
			or die( "Unable to open a connection to the database" );
		ShowThisThread($thread,$courseid);
		mysql_close($link);
	
}
else if ($cmd == "manage_deletePost" )
{
	$courseid=$_GET['courseid'];
	$thread = $_GET['thread'];
	$message = $_GET['message'];
	$link = OpenSQLConnection() or die( "Unable to open a connection to the database" );
		DeleteThisPost( $thread, $message );
		ShowThisThread( $thread ,$courseid);
		mysql_close($link);
}
else 
	{
		$courseid=$_GET['courseid'];
		$link = OpenSQLConnection()
			or die( "Unable to open a connection to the database" );
		ShowTopicManagementList($courseid);
		mysql_close($link);
	}
?>

</div>
<div align="center" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</div>
</body>
</html>