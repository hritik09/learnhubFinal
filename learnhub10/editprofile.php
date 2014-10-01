<html>
<head>
<title> LearnHub: Edit Profile</title>
<link href="style_user.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	
function ValidateFields()
{
	var myform=document.forms["myForm"];
	if(myForm['fnam'].value==null || myForm['fnam'].value==""||myForm['lnam'].value==null || myForm['lnam'].value==""|| myForm['em'].value==null || myForm['em'].value=="" || myForm['secq'].value==null || myForm['secq'].value=="" || myForm['seca'].value==null || myForm['seca'].value=="" || document.getElementById("8").innerHTML!="" || (myForm['arc'].value!="" && isNaN(myForm['arc'].value)) || (myForm['tel'].value!="" && isNaN(myForm['tel'].value)) || (myForm['pc'].value!="" && isNaN(myForm['pc'].value)) || (myForm['accid'].value!="" && isNaN(myForm['accid'].value) )|| !ValidateForm())
	{
		if (myForm['fnam'].value==null || myForm['fnam'].value=="")
		{
		var td1=document.getElementById("1");
		td1.innerHTML="This field is required";
		}
		else
		{
		var td1=document.getElementById("1");
		td1.innerHTML="";
		}
	if(myForm['lnam'].value==null || myForm['lnam'].value=="")
	{
		var td2=document.getElementById("2");
		td2.innerHTML="This field is required";
	}
	else
	{
		var td2=document.getElementById("2");
		td2.innerHTML="";
	}
	
	if(myForm['em'].value==null || myForm['em'].value=="")
	{
		var td2=document.getElementById("3");
		td2.innerHTML="This field is required";
	}
	else
	{
		if(!ValidateEmail())
		{
			var td2=document.getElementById("3");
		td2.innerHTML="Not a Valid Email Address";
		}
		else
		{
		var td2=document.getElementById("3");
		td2.innerHTML="";
		}
	}
	
	if(myForm['secq'].value==null || myForm['secq'].value=="")
	{
		var td2=document.getElementById("4");
		td2.innerHTML="This field is required";
	}
	else
	{
		var td2=document.getElementById("4");
		td2.innerHTML="";
	}
	if(myForm['seca'].value==null || myForm['seca'].value=="")
	{
		var td2=document.getElementById("5");
		td2.innerHTML="This field is required";
	}
	else
	{
		var td2=document.getElementById("5");
		td2.innerHTML="";
	}
	if(myForm['arc'].value!="" && isNaN(myForm['arc'].value))
			{
				var span=document.getElementById("7");
				span.innerHTML="Not a numeric";
			}
			if(myForm['tel'].value!="" && isNaN(myForm['tel'].value))
			{
				var span=document.getElementById("10");
				span.innerHTML="Not a numeric";
			}
			if(myForm['pc'].value!="" && isNaN(myForm['pc'].value))
			{
				var span=document.getElementById("8");
				span.innerHTML="Not a numeric";
			}
			if(myForm['accid'].value!="" && isNaN(myForm['accid'].value))
			{
				var span=document.getElementById("9");
				span.innerHTML="Not a numeric";
			}
		return false;
	}
	return true;
}

function ValidateEmail()
{
	var x=document.forms["myForm"]["em"].value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
        {
			document.forms["myForm"]["em"].focus();
          var td1=document.getElementById("3");
		  td1.innerHTML="Not a valid Email Address";
		  return false;
        }
		else
		{
			
			var td1=document.getElementById("8");
		  	td1.innerHTML="";
			return true;
		}
}

function ValidateTextInner(myobj)
{
	if(myobj.value!="")
	{
		if(myobj.name=="secq")
		{
			var span=document.getElementById("4");
			span.innerHTML="";
		}
		if(myobj.name=="seca")
		{
			var span=document.getElementById("5");
			span.innerHTML="";
		}
		if(myobj.name=="fnam")
		{
			var span=document.getElementById("1");
			span.innerHTML="";
		}
		if(myobj.name=="lnam")
		{
			var span=document.getElementById("2");
			span.innerHTML="";
		}
		if(myobj.name=="pc")
		{
			var span=document.getElementById("8");
			span.innerHTML="";
		}
		if(myobj.name=="arc")
		{
			var span=document.getElementById("7");
			span.innerHTML="";
		}
		if(myobj.name=="tel")
		{
			var span=document.getElementById("10");
			span.innerHTML="";
		}
		if(myobj.name=="accid")
		{
			var span=document.getElementById("9");
			span.innerHTML="";
		}
		
	}
}
</script>

</head>
<body>
<div align="center">
<h1>Edit Profile</h1><hr /><br />

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
?>
  <div style='font-family: Verdana, Arial, sans serif;'>
     <form name='myForm' action='editprofile_submission.php'  onsubmit="return ValidateFields()" method='GET'>
	 <table width=100%>
    	<tr>
			<td>UserID:</td>
			<td> <?php echo $row['userid'] ?><input type='hidden' name='us' value='<?php echo $row['userid'] ?>' /></td>
		</tr><tr><td><br /></td></tr>
    	
		<tr>
			<td>First Name:</td>
			<td>         <input type='text' name='fnam' onBlur="ValidateTextInner(this)" value='<?php echo $row['firstname'] ?>' /></td>
			<td id='1' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
    
		<tr>
			<td>Last Name:</td><td>         <input type='text' name='lnam' onBlur="ValidateTextInner(this)" value='<?php echo $row['lastname'] ?>' /><br /></td>
			<td id='2' style="color: red; font-size: 9px; font-style:italic;"></td>		
		</tr><tr><td><br /></td></tr>
    	
		<tr>
			<td>Address:</td><td>             <input type='text' name='addr' value='<?php echo $row['user_address'] ?>' /></td>
			<td></td>	
		</tr><tr><td><br /></td></tr>
    
		<tr>
			<td>City:</td><td>                  <input type='text' name='ct' value='<?php echo $row['city'] ?>' /></td>
			<td></td>
		</tr><tr><td><br /></td></tr>
    
		<tr>
			<td>State:</td><td>              <input type='text' name='stat' value='<?php echo $row['state'] ?>' /></td>
			<td></td>
		</tr><tr><td><br /></td></tr>
    	
		<tr>
			<td>Country:</td><td>            <input type='text' name='count' value='<?php echo $row['country'] ?>' /></td>
			<td></td>
		</tr><tr><td><br /></td></tr>

	    <tr>
			<td>Pincode:</td><td>            <input type='text' name='pc' value='<?php echo $row['pincode'] ?>' onBlur="ValidateTextInner(this)" /></td>
			<td id='8' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
    
		<tr>
			<td>Email:</td><td>              <input type='text' name='em' value='<?php echo $row['email'] ?>' onBlur="return ValidateEmail()" /></td>
			<td id='3' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
    
		<tr>
			<td>Telephone:</td><td>          <input type='text' name='arc' size='3' onBlur="ValidateTextInner(this)" value='<?php echo $row['areacode'] ?>' />-<input type='text' name='tel' onBlur="ValidateTextInner(this)" value='<?php echo $row['telephone'] ?>' /></td>
			<td id='7' style="color: red; font-size: 9px; font-style:italic;"></td><td id='10' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
    	<tr>
			<td>AccountID:</td><td>          <input type='text' name='accid' value='<?php echo $row['accountid'] ?>' onBlur="ValidateTextInner(this)"/></td>
			<td id='9' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
    	
		<tr>
			<td>Security Question:</td><td>  <input type='text' name='secq' value='<?php echo $row['security_ques'] ?>' onBlur="ValidateTextInner(this)"/></td>
			<td id='4' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
    	
		<tr>
			<td>Security Answer:</td><td>    <input type='text' name='seca' value='<?php echo $row['security_ans'] ?>' onBlur="ValidateTextInner(this)"/></td>
			<td id='5' style="color: red; font-size: 9px; font-style:italic;"></td>
		</tr><tr><td><br /></td></tr>
      </table>
    <input type='submit' value='submit' target='action_frame'/></form>
     </div> 
<?php
}
?>
