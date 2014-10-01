<html>
<head>
<title>LearnHub: Forgot Password</title>
<link href="style_login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function Validate()
	{
		var myForm=document.forms['form1'];
		if(window['security_ans']==undefined)
		{
		if(myForm['userid'].value=="" || myForm['email'].value=="")
		{
			if(myForm['userid'].value=="")
			{
				document.getElementById("1").innerHTML="Thid field is required";
			}
			else
			{
				document.getElementById("1").innerHTML="";
			}
			if(myForm['email'].value=="")
			{
				document.getElementById("2").innerHTML="Thid field is required";
			}
			else
			{
				document.getElementById("2").innerHTML="";
			}
		/*	if(myForm['security_ans'].value=="")
			{
				document.getElementById("3").innerHTML="Thid field is required";
			}
			else
			{
				document.getElementById("2").innerHTML="";
			}*/
			return false;
		}
		return true;
		}
		else
		{
			if(myForm['security_ans'].value=="")
		{
		
			if(myForm['security_ans'].value=="")
			{
				document.getElementById("3").innerHTML="Thid field is required";
			}
			else
			{
				document.getElementById("3").innerHTML="";
			}
			return false;
		}
		return true;
		}
	}
	
</script>
</head>
<body>
<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>
<div style="margin-bottom:400px; background-color:#F1F1F1; text-align:center; margin-top:150px; margin-left:500px; margin-right:500px; margin-bottom:250px">
<?php $con=mysql_connect("localhost","root","root");
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	
	
	echo '<form id="form1" name="form1" method="post" action="forgotpassword.php" onsubmit="return Validate()">';
	if(!isset($_POST['new_pass']) && !isset($_POST['userid']) && !isset($_POST['security_ans']))
	{
	echo 'User ID :	<input type="text" name="userid" id="Security_Answer" /><span id="1"></span><br />';
	echo 'E-Mail ID :	<input type="text" name="email" id="email" /><span id="2"></span><br />';	
	}
	else if(isset($_POST['userid']))
	{		$query="select security_ques,email,security_ans from user where userid='$_POST[userid]'";
	        $result=mysql_query($query) or die("Error ");
			$row=mysql_fetch_array($result);
			if($row)
			{
				if($row['email']!=$_POST['email'])
				{   //echo $_POST['email'];
					echo "Wrong email Id for this userid<br />";
					echo 'User ID :	<input type="text" name="userid" id="Security_Answer" /><span id="1"></span><br />';
	        		echo 'E-Mail ID :	<input type="text" name="email" id="email" /><span id="2"></span><br />';
					
				}
				else
				{
				session_start();
				echo "Security Question :".$row['security_ques']."<br />";
	        	echo 'Security Answer :	<input type="text" name="security_ans" id="email" /><span id="3"></span><br />';	
			    $_SESSION['userid']=$_POST['userid'];
				}
				
			}
			else
			{
			echo "Invalid User ID<br />";
			echo 'User ID :	<input type="text" name="userid" id="Security_Answer" /><span id="1"></span><br />';
	        echo 'E-Mail ID :	<input type="text" name="email" id="email" /><span id="2"></span><br />';	
			
				
			}
	
	}
	else if(isset($_POST['security_ans']))
	{session_start();
	$query="select security_ans,security_ques from user where userid='$_SESSION[userid]'";
	
	        $result=mysql_query($query);
			$row=mysql_fetch_array($result);
			
		
	if($_POST['security_ans']==$row['security_ans'])
	{
		echo 'New password :	<input type="password" name="new_pass" id="email" /><br />';
		echo 'Confirm New password :	<input type="password" name="confirm_pass" id="email" /><br />';
		
	}
	else
	{
		echo "Wrong answer to Security Question<br />";
		echo "Security Question :".$row['security_ques']."<br />";
	    echo 'Security Answer :	<input type="text" name="security_ans" id="email" /><span id="3"></span><br />';

		
		}
		
	}
	else
	{
	echo "Success";
     session_start();
	 $pass=md5($_POST['new_pass']);
	 
	$que= "UPDATE user SET password='$pass' WHERE userid='$_SESSION[userid]'";
	mysql_query($que) or die(mysql_error());
	echo '<br>'.'<a href="index.php">Login</a>';
	exit;
    //echo  $que;
	}
	echo '<input type="submit" value="Send">';
	echo "</form>";
	
	?>
    </div>
    <div align="center" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</body>
</html>

