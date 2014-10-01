<?php ob_start(); ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>LearnHub</title>
<META Name="Description" Content="description" />
<META Name="Keywords" Content="keywords separated by commas"/>
<link rel="Shortcut Icon" href="/favicon.ico" />
<link href="style_login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script type="text/javascript">
	function ValidateloginPage()
	{
		var myForm=document.forms['login'];
		if(myForm['user'].value<1 || myForm['pass'].value<1)
		{
			if(myForm['user'].value<1)
				{
					var span=document.getElementById("1");
					span.innerHTML="Field is required";
				}
			else
			{
				var span=document.getElementById("1");
					span.innerHTML="";
			}
			 if(myForm['pass'].value<1)
			{
				var span=document.getElementById("2");
				span.innerHTML="Field is required";
			}
			else 
			{
				var span=document.getElementById("2");
				span.innerHTML="";
			}
			return false;
		}
		return true;
	}
</script>

</head>
<body> 

<div id="container">

<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>

<div id="leftnav">
<div style="height=300px;" align="center">
<?php include 'popular.php';?></div>	
</div>

<div id="content" align="center">
	<h1 align= "center">Login / Sign Up</h1><hr />
		<br />
		<?php 
		session_start();
		  if (isset($_SESSION['login_error']))
	{       
			echo $_SESSION['login_error'];
	}  
		 
		  
		  ?>
		 <form name="login" action="login.php" method="post" onsubmit="return ValidateloginPage()">
        	<p align="center">
   			<strong>Username:</strong>
   			<input type="text" name="user" title="text input sample"><p id="1" style="text-align: right;color: #F00; font-style:italic; font-size: 9px;" ></p>
 			<strong>Password:</strong>
 			<input type="password" name="pass" title="pwd sample"><p id="2" style="text-align: right;color: #F00; font-style:italic; font-size: 9px;"></p>
 			<input type="submit" value="Log In">
 			<input type="reset" />
       	</form>
 		<br />
 		<br />
 			<a align="center" href="user_reg.php">Sign up</a>
 		<br />
 		<br />
 			<a align="center" href="forgotpassword.php">Forgot Password ?</a>
      
</div>
<div style="margin-left: 30px;">
<?php /*
<div id="Prezi">

<div class="prezi-player"><style type="text/css" media="screen">.prezi-player { width: 900px; } .prezi-player-links { text-align: center; }</style><object id="prezi_wwe-a06vsfrn" name="prezi_wwe-a06vsfrn" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="900" height="400"><param name="movie" value="http://prezi.com/bin/preziloader.swf"/><param name="allowfullscreen" value="true"/><param name="allowscriptaccess" value="always"/><param name="bgcolor" value="#ffffff"/><param name="flashvars" value="prezi_id=wwe-a06vsfrn&amp;lock_to_path=0&amp;color=ffffff&amp;autoplay=no&amp;autohide_ctrls=0"/><embed id="preziEmbed_wwe-a06vsfrn" name="preziEmbed_wwe-a06vsfrn" src="http://prezi.com/bin/preziloader.swf" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="900" height="400" bgcolor="#ffffff" flashvars="prezi_id=wwe-a06vsfrn&amp;lock_to_path=0&amp;color=ffffff&amp;autoplay=no&amp;autohide_ctrls=0"></embed></object><div class="prezi-player-links"><p></div></div>
</div>
</div>
*/


?>
<div align="center" id="footer">
<p class="smalltext">&copy; 2013 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</div>

</body>
</html>

<?php ob_end_flush(); ?>
  
  