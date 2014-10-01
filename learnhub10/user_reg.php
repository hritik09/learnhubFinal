<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<title>LearnHub</title>
<META Name="Description" Content="description" />
<META Name="Keywords" Content="keywords separated by commas"/>
<link rel="Shortcut Icon" href="/favicon.ico" />
<link href="style_login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php ob_start(); ?>
<script type="text/javascript">
	
	function ValidateForm()
	{    
		var myForm=document.forms['userform'];
		if(myForm['userid'].value=="" ||myForm['password'].value==""||myForm['cpassword'].value==""||myForm['sec_ques'].value==""||myForm['sec_ans'].value==""|| myForm['fname'].value=="" || myForm['lname'].value=="" || myForm['email'].value=="" || (myForm['acode'].value!="" && isNaN(myForm['acode'].value)) || (myForm['phno'].value!="" && isNaN(myForm['phno'].value)) || (myForm['pcode'].value!="" && isNaN(myForm['pcode'].value)) || (myForm['ano'].value!="" && isNaN(myForm['ano'].value) ) || (myForm['password'].value!="" && myForm['cpassword'].value!="" && (myForm['password'].value!=myForm['cpassword'].value)) || !ValidateEmail())
		{
			if(myForm['userid'].value=="" )
			{
				var span=document.getElementById("1");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("1");
				span.innerHTML="";
			}
			if(myForm['password'].value=="" )
			{
				var span=document.getElementById("7");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("7");
				span.innerHTML="";
			}
			if(myForm['cpassword'].value=="" )
			{
				var span=document.getElementById("8");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("8");
				span.innerHTML="";
			}
			if(myForm['sec_ques'].value=="" )
			{
				var span=document.getElementById("2");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("2");
				span.innerHTML="";
			}
			if(myForm['sec_ans'].value=="" )
			{
				var span=document.getElementById("3");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("3");
				span.innerHTML="";
			}
			if(myForm['fname'].value=="" )
			{
				var span=document.getElementById("4");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("4");
				span.innerHTML="";
			}
			if(myForm['lname'].value=="" )
			{
				var span=document.getElementById("5");
				span.innerHTML="This field is required";
			}
			else
			{
				var span=document.getElementById("5");
				span.innerHTML="";
			}
			if(myForm['email'].value=="" )
			{
				var span=document.getElementById("6");
				span.innerHTML="This field is required";
			}
			else
			{
				if(!ValidateEmail())
				{
					var span=document.getElementById("6");
				span.innerHTML="Not a valid email address";
				}
				else
				{
				var span=document.getElementById("6");
				span.innerHTML="";
				}
			}
			if(myForm['acode'].value!="" && isNaN(myForm['acode'].value))
			{
				var span=document.getElementById("10");
				span.innerHTML="Not a numeric";
			}
			if(myForm['phno'].value!="" && isNaN(myForm['phno'].value))
			{
				var span=document.getElementById("12");
				span.innerHTML="Not a numeric";
			}
			if(myForm['pcode'].value!="" && isNaN(myForm['pcode'].value))
			{
				var span=document.getElementById("9");
				span.innerHTML="Not a numeric";
			}
			if(myForm['ano'].value!="" && isNaN(myForm['ano'].value))
			{
				var span=document.getElementById("11");
				span.innerHTML="Not a numeric";
			}
			if((myForm['password'].value!="" && myForm['cpassword'].value!="" && (myForm['password'].value!=myForm['cpassword'].value)))
			{
				var span=document.getElementById("8");
				span.innerHTML="Password doesnt match";
			}
			
			return false;
		}
		return true;
	}
	function ValidateEmail()
{
	var x=document.forms["userform"]["email"].value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
			document.forms["userform"]["email"].focus();
          var td1=document.getElementById("6");
		  td1.innerHTML="Not a valid Email Address";
		  return false;
        }
		else
		{
			
			var td1=document.getElementById("6");
		  	td1.innerHTML="";
			return true;
		}
}
function ValidateTextInner(myobj)
{
	if(myobj.value!="")
	{
		if(myobj.name=="userid")
		{
			var span=document.getElementById("1");
			span.innerHTML="";
		}
		if(myobj.name=="password")
		{
			var span=document.getElementById("7");
			span.innerHTML="";
		}
		if(myobj.name=="cpassword")
		{
			var span=document.getElementById("8");
			span.innerHTML="";
		}
		if(myobj.name=="sec_ques")
		{
			var span=document.getElementById("2");
			span.innerHTML="";
		}
		if(myobj.name=="sec_ans")
		{
			var span=document.getElementById("3");
			span.innerHTML="";
		}
		if(myobj.name=="fname")
		{
			var span=document.getElementById("4");
			span.innerHTML="";
		}
		if(myobj.name=="lname")
		{
			var span=document.getElementById("5");
			span.innerHTML="";
		}
		if(myobj.name=="pcode")
		{
			var span=document.getElementById("5");
			span.innerHTML="";
		}
		if(myobj.name=="acode")
		{
			var span=document.getElementById("10");
			span.innerHTML="";
		}
		if(myobj.name=="phno")
		{
			var span=document.getElementById("12");
			span.innerHTML="";
		}
		if(myobj.name=="ano")
		{
			var span=document.getElementById("11");
			span.innerHTML="";
		}
		
	}
}
</script>

</head>
<body> 

<div id="container">

<div id="header"><img border="0" src="images/LearnHub.jpg" width="300" height="100" /></div>
<div align="center">
<div align="left" style="width: 600px; margin-left: 40px;">


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Registration</title>

<!DOCTYPE HTML>
<html>
    <head>
        <title> LearnHub Registration</title>
<?php
if(isset($_POST['userid']))
{
$userid=trim($_POST['userid']);
$con=mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect to the database: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);

$sql1="select userid from user where userid='$userid";
$res=mysql_query($sql1);
$row=mysql_fetch_array($res);
if(isset($row['userid']))
{
	
	echo "Username '$_POST[userid]' already taken please choose a new one"; 
	
}
else
{
$sql="INSERT INTO user (userid, password, firstname, lastname, user_address, city, state, country, pincode, email, areacode, telephone, accountid, balance,security_ques,security_ans,last_login)
values ('$userid', md5('$_POST[password]'),'$_POST[fname]', '$_POST[lname]', '$_POST[addr]', '$_POST[city]', '$_POST[state]', '$_POST[country]', '$_POST[pcode]', '$_POST[email]', '$_POST[acode]', '$_POST[phno]', '$_POST[ano]', 0,'$_POST[sec_ques]','$_POST[sec_ans]','0000-00-00 00:00:00')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mkdir("user/".$userid."/");
mysql_close($con);
session_start();
$_SESSION["userid"]=$userid;
	 $_SESSION["firstname"]=$_POST['fname'];
	 $_SESSION['last_login']='0000-00-00 00:00:00';
	 header("Location: homepage.php");
}
}

?> 
    


<script type="text/javascript" src="_js/userval.js"> 
</script>

</head>
<body>
<div>
<form name="userform" method="post" action="user_reg.php" onsubmit="return ValidateForm()">
<fieldset style="-moz-border-radius: 10px; 
            -webkit-border-radius: 10px;
            border-radius: 10px; 
            padding: 10px;
            "><legend align="center" style="font-family:Verdana, Geneva, sans-serif; color: blue">User Registration</legend>
<pre style="font-family: Verdana, Arial, sans serif;"> 
Username:*     		<input type="text" name="userid" onblur="ValidateTextInner(this)"  value="<?php if(isset($_POST['userid'])) { echo $_POST['userid'];}?>"/><span id="1" style='font-style:italic; color: red; font-size: 10px;'></span><br />
Password:*     		<input type="password" onblur="ValidateTextInner(this)" name="password" /><span id="7" style="font-style:italic; color: red; font-size: 10px;"></span><br />
Confirm Password:* 	<input type="password" onblur="ValidateTextInner(this)" name="cpassword" /><span id="8" style="font-style:italic; color: red; font-size: 10px;"></span><br />
Security Question:*	<input type="text" name="sec_ques" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['sec_ques'])) { echo $_POST['sec_ques'];}?>" /><span id="2" style='font-style:italic; color: red; font-size: 10px;'></span><br />
Security Answer:*	<input type="text" name="sec_ans" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['sec_ans'])) { echo $_POST['sec_ans'];}?>"/><span id="3" style='font-style:italic; color: red; font-size: 10px;'></span><br />
First Name:*   		<input type="text" name="fname" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname'];}?>"/><span id="4" style='font-style:italic; color: red; font-size: 10px;'></span><br />
Last Name:*    		<input type="text" name="lname" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname'];}?>"/><span id="5" style='font-style:italic; color: red; font-size: 10px;'></span><br />
Address: 			<input type="text" name="addr" size="40" /><br />
			 	<input type="text" name="addr" size="40" /><br />
City: 				<input type="text" name="city" value="<?php if(isset($_POST['city'])) { echo $_POST['city'];}?>"/><br />
State:			<input type="text" name="state" value="<?php if(isset($_POST['state'])) { echo $_POST['state'];}?>" /><br />
Country:			<input type="text" name="country" value="<?php if(isset($_POST['country'])) { echo $_POST['country'];}?>" /><br />
Pincode:			<input type="text" name="pcode" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['pcode'])) { echo $_POST['pcode'];}?>"/><span id="9" style='font-style:italic; color: red; font-size: 10px;'></span><br />
E-mail:*			<input type="text" name="email" onblur="return ValidateEmail()" value="<?php if(isset($_POST['email'])) { echo $_POST['email'];}?>"/><span id="6" style='font-style:italic; color: red; font-size: 10px;'></span><br />
Telephone:			<input type="text" name="acode" onblur="ValidateTextInner(this)" size="5" value="<?php if(isset($_POST['acode'])) { echo $_POST['acode'];}?>"/>-<input type="text" name="phno" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['phno'])) { echo $_POST['phno'];}?>"/><span id="10" style='font-style:italic; color: red; font-size: 10px;'></span><span id="12" style='font-style:italic; color: red; font-size: 10px;'></span><br />
Account Number:		<input type="text" name="ano" onblur="ValidateTextInner(this)" value="<?php if(isset($_POST['ano'])) { echo $_POST['ano'];}?>"/><span id="11" style='font-style:italic; color: red; font-size: 10px;'></span><br />
				<input type="submit" value="Submit" />  <input type="reset" value="Reset"/>
</pre>
</fieldset>
<p style="color: red; font-family:Verdana, Geneva, sans-serif; font-size:12px">* marked are mandatory</p>
</form>
</div>
</div>
<div align="center" id="footer">
<p class="smalltext">&copy; 2012 LearnHub </p>
<p class="smalltext">For queries please contact webmaster_learnhub@gmail.com</p>
</div>
</body>
</html>
<?php ob_end_flush(); ?>