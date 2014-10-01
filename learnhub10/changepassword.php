
<html>
<head>
<title> LearnHub: Change Password</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function ValidateFields()
	{
		if(document.forms['myForm']['old_pass'].value==null || document.forms['myForm']['old_pass'].value=="" || document.forms['myForm']['pass'].value=="" || document.forms['myForm']['pass'].value==null || document.forms['myForm']['cpass'].value=="" || document.forms['myForm']['cpass'].value==null || (myForm['pass'].value!="" && myForm['cpass'].value!="" && (myForm['pass'].value!=myForm['cpass'].value)) )
		{
			if(document.forms['myForm']['old_pass'].value==null || document.forms['myForm']['old_pass'].value=="")
			{
				var sp=document.getElementById("1");
				sp.innerHTML="This field is required";
			}
			else
			{
				var sp=document.getElementById("1");
				sp.innerHTML="";
			}
			if(document.forms['myForm']['pass'].value==null || document.forms['myForm']['pass'].value=="")
			{
				var sp=document.getElementById("2");
				sp.innerHTML="This field is required";
			}
			else
			{
				var sp=document.getElementById("2");
				sp.innerHTML="";
			}
			if(document.forms['myForm']['cpass'].value==null || document.forms['myForm']['cpass'].value=="")
			{
				var sp=document.getElementById("3");
				sp.innerHTML="This field is required";
			}
			else
			{
				var sp=document.getElementById("3");
				sp.innerHTML="";
			}
			if((myForm['pass'].value!="" && myForm['cpass'].value!="" && (myForm['pass'].value!=myForm['cpass'].value)))
			{
				var span=document.getElementById("3");
				span.innerHTML="Password doesnt match";
			}
			else
			{
				var span=document.getElementById("3");
				span.innerHTML="";
			}
			return false;
		}
		return true;
	}
</script>
</head>
<body>
<div align="center">
<h1>Change Password</h1><hr /><br />

<?php
session_start();
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$use=$_SESSION['userid'];
$query="Select * from user where userid='$use'";
$sql=mysql_query($query);
while($row=mysql_fetch_array($sql))
{
    echo "<form name='myForm' action='changepassword_submission.php' method='post' style='font-family: Verdana, Arial, sans serif;' onsubmit='return ValidateFields()'><table width=100%>        
          <tr><td>Old Password:</td><td> <input type='password' name='old_pass' id='old_pass' /><span id='1' style='color: red; font-style: italic; font-size: 7px;'></span></td></tr>
		  <tr><td><input type='hidden' name='us' value='".$row['userid']."' id='us' />Enter New Password:</td><td> <input type='password' name='pass' id='pass' /><span id='2' style='color: red; font-style: italic; font-size: 7px;'></span></td></tr>
          <tr><td>Confirm New Password:</td><td> <input type='password' name='cpass' id='cpass' /><span id='3' style='color: red; font-style: italic; font-size: 8px;'></span></td></tr></table>
          <input type='submit' value='Submit' target='action_frame' /></form>";
}
?>
</div>
</body>
</html>
