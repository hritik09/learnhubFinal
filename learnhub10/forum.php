<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style_user.css" rel="stylesheet" type="text/css" />
<title>MY Disussion Forum</title>
<?php  session_start();
if(isset($_SESSION['courseid'])){unset($_SESSION['courseid']);}
include "calendar.php" ?>
</head>


<body>


<div id="container">

	<div id="rightnav1">
	
     <?PHP 
	
     if(isset($_SESSION['userid']))
	{
    
   echo " <h2 align='center'>You are Logged in as "; 
   
	echo "<a href=user.php?userid=".$_SESSION['userid'].">";
    
		echo $_SESSION['firstname']."</h2></a>";
	
	
   
	echo"
     <a href='homepage.php'>
    Home
    </a>
    <a href='logout.php'>
     Logout
    </a>";}
	else
	{
	 echo "<a href='index.php'>
    Login
    </a>";
	
		
    }
	
	?>
	
	</div>
    <div id="header2">
<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>

</div>
<div align="center">
<div align="center" style="width: 500px;">
<?php

if(isset($_SESSION['userid']))
$userid=$_SESSION['userid'];
else
$userid="";
$disablePostsInURLs=0;

	function validatingmanager($courseid)
	{
		global $userid;
		OpenSQLConnection();
		$query="SELECT * from user_course where userid= '$userid' and courseid='$courseid'";
		$result=mysql_query($query) or die("Error exectuing a query".mysql_error());
		if(mysql_num_rows($result)==1)
		return true;
		else
		return false;
		
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
		print "<h3 style='font-size:16px;'>Question: <h3 style='color:red'><span class=\"pageHeadline\">$title</span></h3></h3>\n";
	}

	function PrintError($error)
	{
		print "<p class=\"errorText\">$error</p>\n";
	}
	
	function printAllThreads($courseid,$page=0)
	{
		global $disablePostsInURLs, $userid;
		$query = "SELECT * FROM ThreadList where courseid='$courseid' ORDER BY ThreadID DESC";
		$result = mysql_query($query) or die("Failed while trying to show thread list");

		$rows = mysql_num_rows($result);
		
		if( $rows > 0 && $rows > 30 )
		{
			while( $rows < $page * 30 + 1 )
			{
				$page--;
			}
		
			if( $page > 0 )
			{
				// shift results pointer forward to correct place
				mysql_data_seek( $result, $page * 30 );
			}
		}

		if( mysql_num_rows($result) > 0 )
		{
			// Printing results in HTML
			print "<div><h1>Discussions</h1><br /><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
			$count = 0;
			while ($count < 30 and $line = mysql_fetch_row($result)) 
			{
				$to_print = "\t<tr><td width=\"10\">&nbsp;</td><td><a href=\"forum.php?cmd=show&amp;thread=$line[0]&amp;courseid=".$courseid;
				if( $disablePostsInURLs != "1" )
					$to_print .= "&amp;posts=$line[4]";
				$to_print .= "\">$line[1]</a> ";
				print "$to_print";
				print "<small><i>$line[2] ";
			
				print "($line[4]";
				if( $count == 0 )
				{
					if( $line[5] == "1" )
						print " post";
					else
						print " posts";
				}
				print ")<hr />";
				
				print "</i></small></td></tr>\n";
				$count = $count + 1;
			}
	
			print "</table><p></p></div>\n";
		
			if( $rows > 30 )
			{
				print "<br /><div class=\"subtle\">";
				if( $page > 0 )
				{
					$prev = $page - 1;
					print "<a href=\"forum.php?cmd=offset&amp;page=$prev&amp;courseid=".$courseid."\">&lt; Previous 30 topics</a> ";
				}
				if( $rows > ( $page + 1 ) * 30 )
				{
					$next = $page + 1;
					print "<a href=\"forum.php?cmd=offset&amp;page=$next&amp;courseid=".$courseid."\">Next 30 topics &gt;</a>";
				}
			
				print "</div>";
			}
		}
		else
		{
			print "<p>There are no entries in the discussion forum. Why not create a new one below?</p>\n";
		}
		if($userid!="")
		print "<table><tr><td>Start a <a href=\"forum.php?cmd=new&courseid=".$courseid."\">New Topic</a></td><td width='1' bgcolor='blue'><BR></td>";
		if(validatingmanager($courseid))
		print "<td>Manage <a href=\"manage.php?courseid=".$courseid."\" >Forum</a></td></tr></table>";
	}

	function PrintThreadName($thread)
	{
				
		$query = "SELECT Title FROM ThreadList WHERE ThreadID = $thread";
		$result = mysql_query($query) or die("Failed while trying to find the thread name");

		$line = mysql_fetch_row($result);
	
		if ($line)
			$title = $line[0];
		
		return $title;
	}

	function PrintSingleThread($thread,$error,$courseid)
	{
		global $userid;
	
		if( strlen($error) > 0 )
		PrintError($error);
		
		$query = "SELECT *,DATE_FORMAT(CreationDate, '%W, %M %e, %Y') AS mydatestring FROM MessageList WHERE ThreadID = $thread ORDER BY CreationDate";
		$result = mysql_query($query) or die("Failed while trying to find the thread in the database");
	    
		if( mysql_num_rows($result) < 1 )
		{
			print "Message doesn't exist";
			print "<p>Topic $thread either doesn't exist or has been deleted.</p>\n";
			if($userid!="")
			{
			print "<br />View <a href=\"forum.php?courseid=".$courseid."\">Recent Topics</a>\n";
			print "Post <a href=\"forum.php?cmd=new&amp;courseid=".$cousreid."\">New Topic</a>";
			}
			if(validatingmanager($courseid))
			print "Manage <a href=\"manage.php?courseid=".$courseid."\" >Forum</a>";
			return;
		}
	
		$title = PrintThreadName($thread);
		PrintTitle($title);
        print "<h3 align='left' style='font-size:16px;'>Answers:</h3><div style='border: 1px solid'>";
		while ($line = mysql_fetch_row($result)) 
		{
			print "<p>$line[2]</p>\n";
			print "<p align=\"right\"><small><i>";
			if ($line[3] == "")
				$line[3] = "anon.";
			
			if ($line[4] == "")
				print "$line[3]";
			else
				print "<a title=\"Click to user profile\" href=\"user.php?userid=".$line[3]."\">".$line[3]."</a>";

			print "<br />$line[5]</i></small></p><hr />\n";
		}
         print "</div>";
			// Add a link to post a reply with
		if($userid!="")
		{
		print "<a href=\"forum.php?cmd=reply&amp;thread=$thread&amp;courseid=".$courseid."\">Reply</a> to this topic";
		}
		print "<br />View <a href=\"forum.php?courseid=".$courseid."\">Recent Topics</a>\n";
		if(validatingmanager($courseid))
			print "Manage <a href=\"manage.php?courseid=".$courseid."\" >Forum</a>";
	}

	function OpenSQLConnection()
	{
			
		$link = mysql_connect("localhost", "root","root") or die("Could not connect to the database");

		mysql_select_db("learnhub") or die("Could not select specified database");
	    
		return $link;
	}

	function ShowNewTopicForm($courseid,$pageTitle, $title, $message, $error)
	{
		global $userid;
		print "<span class=\"pageHeadline\">$title</span><p></p>\n";
		if( strlen($error) > 0 )
			PrintError($error);	
		?>
		<form method="post" action="forum.php">
	  		<div align="left">
			<h1 align="center">Start a new topic</h1><hr /><br />
	    		<table border="0" cellpadding="0" cellspacing="0" width="440">
	      			<tr>
	        			<td width="100" valign="top" align="left">Title:</td>
	        			<td width="340" valign="top" align="left"><input class="formBox" type="text" name="title" size="51" value="<?php print "$title" ?>" />		</td>
	    		    </tr>
	     		
                    <tr>
	        			<td valign="top" align="left">Message<span class="requiredWarning">*</span>:</td>
	        			<td valign="top" align="left"><textarea class="formBox" rows="7" name="msg" cols="43"><?php print "$message" ?></textarea></td>
	      			</tr>
	      
          			<tr>
            		    <td valign="top" align="left"></td>
                		<td valign="top" align="left"><span class="subtle">Do not use HTML tags. Surround URLs with spaces.</span></td>
              		</tr>
	      
          			<tr>
	        			<td valign="top" align="left"></td>
	        			<td valign="top" align="left">&nbsp;</td>
	      			</tr>
	      		
                	<tr>
                		<td valign="top" align="left"></td>
                		<td valign="top" align="left"><span class="requiredWarning">* - Required for processing</span></td>
              		</tr>
	      			
                    <tr>
                		<td valign="top" align="left"></td>
                		<td valign="top" align="left">&nbsp;</td>
              		</tr>
	      		
                	<tr>
	        			<td valign="top" align="left"></td>
	        			<td valign="top" align="left"><input type="submit" value="Post Message" /></td>
	      			</tr>
	    		</table>
	  
      		</div>
	  			<input type="hidden" name="cmd" value="submitnew" />
                <input type="hidden" name="courseid" value="<?php echo $courseid;?>"  />
		</form>
    
		<?php
    	print "<br />View <a href=\"forum.php?courseid=".$courseid."\">Recent Topics</a><hr />\n";
		if(validatingmanager($courseid))
		print "Manage <a href=\"manage.php?courseid=".$courseid."\" >Forum</a>";
	

}

	function HTMLEncode($text) 
	{ 
		$searcharray = array( "'([-_\w\d.]+@[-_\w\d.]+)'", 
							  "'((?:(?!://).{3}|^.{0,2}))(www\.[-\d\w\.\/?=]+)'", 
							  "'(http[s]?:\/\/[-_~\w\d\.\/?=]+)'"); 

		$replacearray = array( " <a href=\"mailto:\\1\">\\1</a> ", 
							   "\\1http://\\2", 
							   " <a href=\"\\1\"> \\1</a> "); 

	return nl2br(preg_replace($searcharray, $replacearray, stripslashes($text) )); 
}

function StripHTML($str)
{
	$str = str_replace("<", "&lt;", $str); 
	$str = str_replace(">", "&gt;", $str); 

	$str = str_replace("\n", "</p> <p>", $str); 
	$str = str_replace("\r", "", $str); 

	$str = HTMLEncode($str);

	list($words) = array (split (" ", $str)); 
	$str = ''; 
	foreach ($words as $c => $word) 
	{ 
		if (strlen ($word) > 45 and !ereg("^href=", $word) and !ereg ("[\[|\]|\/\/]", $word)) 
			$word = chunk_split ($word, 45, " "); 

		if ($c) 
			$str .= ' '; 

		$str .= $word; 
	}
	return addslashes($str);
}

function StripHTMLSimple($str)
{
	list ($words) = array (split (" ", $str)); 
	$str = ''; 
	foreach ($words as $c => $word) 
	{ 
		if (strlen ($word) > 45 and !ereg ("[\[|\]|\/\/]", $word)) 
			$word = chunk_split ($word, 45, " "); 

		if ($c) 
			$str .= ' '; 

		$str .= $word; 
         echo $str."<br/>";
	}
   
	$str = str_replace("<", "&lt;", $str); 
	$str = str_replace(">", "&gt;", $str); 
	
	$str = str_replace("\n", " ", $str); 
	$str = str_replace("\r", "", $str);
	return addslashes($str);
}

function CreateNewThread($title,$courseid)
{	
	global $userid;
	$datetime = date("Y-m-d H:i:s");
	$title = StripHTMLSimple($title);

	$messagecount = 0;

	$query = "SELECT * FROM ThreadList where courseid='$courseid'";
	$result = mysql_query($query)
	    or die("Failed to query the thread list");

	while ($line = mysql_fetch_row($result)) 
	{
		if ($line[1] == $title)
			return $line[0];
	}

	$query = "INSERT INTO ThreadList VALUES (NULL, '$title', '$userid','$courseid','$messagecount', '$datetime', '$datetime')";
	$result = mysql_query($query)
	    or die("Error:".mysql_error());
	    
	return mysql_insert_id();
}

function CreateNewMessage($msg,$thread,$courseid)
{

	global $userid;
	$datetime = date("Y-m-d H:i:s");
	$msg = StripHTML($msg);

	$query = "SELECT * FROM MessageList WHERE ThreadID = $thread ";
	$result = mysql_query($query)
	    or die("Failed to search the database for threads");

	while ($line = mysql_fetch_row($result)) 
	{
		if ($line[1] == $msg)
			return;
	}

	$query = "INSERT INTO MessageList VALUES (NULL, '$courseid','$msg','$userid', 'efwdwded', '$datetime', '$thread')";
	$result = mysql_query($query)
	    or die("Failed to add a new message");
	    
	$query = "UPDATE ThreadList set Posts=Posts+1 WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or die("Failed to update the posts counter");
	    
	$query = "UPDATE ThreadList set LastPostedTo='$datetime' WHERE ThreadID = $thread";
	$result = mysql_query($query)
	    or die("Failed to update the last posted to date");
	    
	return GetPostsCount($thread);
}

function GetPostsCount($thread)
{
	
	$query = "SELECT Posts FROM ThreadList WHERE ThreadID = $thread";
	$result = mysql_query($query)
		or die("Failed to find out how many posts there are");

	if( mysql_num_rows($result) == 1 )
	{
		$line = mysql_fetch_row($result);
		return $line[0];
	}
		
	return 0;
}

function ShowReplyForm($courseid,$thread, $error)
{

	if( strlen($error) > 0 )
		PrintError($error);
	?>
	<form method="post" action="<?php print "forum.php" ?>">
	  <div align="left">
	    <table border="0" cellpadding="0" cellspacing="0" width="440">
	      <tr>
	        <td valign="top" align="left">Message<span class="requiredWarning">*</span>:</td>
	        <td valign="top" align="left"><textarea class="formBox" rows="7" name="msg" cols="43"></textarea></td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="subtle">Do not use HTML tags. Surround URLs with spaces.</span></td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left">&nbsp;</td>
	      </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left"><span class="requiredWarning">* - Required for processing</span></td>
              </tr>
	      <tr>
                <td valign="top" align="left"></td>
                <td valign="top" align="left">&nbsp;</td>
              </tr>
	      <tr>
	        <td valign="top" align="left"></td>
	        <td valign="top" align="left"><input type="submit" value="Post Reply" /></td>
	      </tr>
	    </table>
	  </div>
	  <input type="hidden" name="thread" value="<?php print "$thread" ?>" />
	  <input type="hidden" name="cmd" value="submitreply" />
      <input type="hidden" name="courseid" value="<?php echo $courseid ?>" />
	</form>
   
	<?php
	
	 print "<br />View <a href=\"forum.php?courseid=".$courseid."\">Recent Topics</a>\n";
	 if(validatingmanager($courseid))
	 print "Manage <a href=\"manage.php?courseid=".$courseid."\" >Forum</a>";
}



if(isset($_POST['cmd'])|| isset($_GET['cmd']))
{
	if(isset($_POST['cmd']))
	$cmd=$_POST['cmd'];
	else
	$cmd=$_GET['cmd'];

if ($cmd == "new")
{
	$courseid=$_GET['courseid'];
	ShowNewTopicForm($courseid,"Start a New Topic", "", "", "");
}	
else if ($cmd == "submitnew")
{
	$title = $_POST['title'];
	$msg = $_POST['msg'];
	$courseid=$_POST['courseid'];
	if( strlen($title) == 0 || strlen($msg) == 0 )
	{
		ShowNewTopicForm($courseid,"Start a New Topic", $title, $msg, "Please complete all the required fields.");
	}
	else
	{
		$link = OpenSQLConnection()
			or die( "Unable to open a connection to the database" );
		if ($title != "" and $msg != "")
		{
			$thread = CreateNewThread($title,$courseid);
			CreateNewMessage($msg,$thread,$courseid);
		}
		mysql_close($link);
		redirectTo( "forum.php?courseid=".$courseid );
	}
}
else if ($cmd == "show")
{
	$courseid=$_GET['courseid'];
	$thread = $_GET['thread'];
	$link = OpenSQLConnection()
		or die( "Unable to open a connection to the database" );
	printSingleThread($thread, "",$courseid);
	mysql_close($link);
}
else if ($cmd == "reply")
{
	$courseid=$_GET['courseid'];
	$thread = $_GET['thread'];
	$link = OpenSQLConnection()
		or die( "Unable to open a connection to the database" );
	$title = "Reply to \"";
	$title .= PrintThreadName($thread);
	$title .= "\"";
	PrintTitle($title);
	mysql_close($link);
	
	ShowReplyForm($courseid,$thread, "");
}
else if ($cmd == "submitreply")
{
	$msg = $_POST['msg'];
	$thread = $_POST['thread'];
	$courseid=$_POST['courseid'];
	if( strlen($msg) == 0  )
	{
		$link = OpenSQLConnection()
			or die( "Unable to open a connection to the database" );
		$title = "Reply to \"";
		$title .= PrintThreadName($thread);
		$title .= "\"";
		PrintTitle($title);
		mysql_close($link);
		
		ShowReplyForm($courseid,$thread, "Please complete all the required fields.");
	}
	else
	{	
		$link = OpenSQLConnection()
			or die( "Unable to open a connection to the database" );
		$posts = CreateNewMessage($msg,$thread,$courseid);
		mysql_close($link);
		redirectTo( "forum.php?cmd=show&thread=$thread&posts=$posts&courseid=".$courseid);
	}
}
else if ($cmd == "newmailform" )
{
	$message = $_GET['message'];
	$link = OpenSQLConnection()
		or die( "Unable to open a connection to the database" );
	ShowNewMailForm($message, "", "");
	mysql_close($link);
}
else if ($cmd == "submitnewmail" )
{
	$message = $_POST['message'];
	$msg = $_POST['msg'];
	
	$link = OpenSQLConnection()
		or die( "Unable to open a connection to the database" );
	
	if( strlen($msg) == 0 )
		ShowNewMailForm($message, $msg, "Please complete all required fields!");
	else
	{
		$thread = SendEmailToPoster( $message, $msg, $fullname, $email );
		if( $thread > 0 )
		{
			$posts = GetPostsCount($thread);
			redirectTo( $g_ThisPage . "?cmd=show&thread=$thread&posts=$posts" );
		}
		else
		{
			PageHeader();
			PrintError( "An error has occurred. Sorry about that." );
			PrintStandardFooter("");
		}
	}
	
	CloseSQLConnection($link);
}
else if($cmd== "offset")
{
	$courseid=$_GET['courseid'];
	$page = $_GET['page'];
	$link = OpenSQLConnection()
		or die( "Unable to open a connection to the database" );
	printAllThreads($courseid,$page);
	mysql_close($link);
}
}
else 
{
	$link = OpenSQLConnection() or die( "Unable to open a connection to the database" );
	$courseid=$_GET['courseid'];
	
	printAllThreads($courseid);
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