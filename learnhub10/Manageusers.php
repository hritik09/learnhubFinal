

<html>
<head>
<title> LearnHub: Manage Users</title>
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
<h1> Manage Users</h1><hr /><br />

<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("learnhub", $con);
$course=$_GET['courseid'];
$query="Select * from user_course where courseid='$course' and role in ('Student','Admin')";
$sql=mysql_query($query);
echo "<h2>Registered Users</h2><br />
    <table width=100%>
    <tr>
    <td style='font-size: 20px; text-align: left;'>User</td><td width='1' bgcolor='blue'><BR></td>
    <td style='font-size: 20px;'>Status</td><td width='1' bgcolor='blue'><BR></td>
    <td style='font-size: 20px;'>Current Role</td><td width='1' bgcolor='blue'><BR></td>
    <td style='font-size: 20px;'>Change</td><td width='1' bgcolor='blue'><BR></td>
    <td style='font-size: 20px;'>Submit</td><td width='1' bgcolor='blue'><BR></td>
    </tr><tr><td><hr /><td><td><hr /><td><td><hr /><td><td><hr /><td><td><hr /><td></tr>";
while($row=mysql_fetch_array($sql))
{
    if($row['status']=='Approved')
    {
    echo "
        <tr>
        <td style='text-align: left;'> <a target='_new' href='user.php?userid=".$row['userid']."' target='_new' >".$row['userid']."</a></td><td width='1' bgcolor='blue'><BR></td>
            <td>".$row['status']."</td><td width='1' bgcolor='blue'><BR></td>
                <td>".$row['role']."</td><td width='1' bgcolor='blue'><BR></td>
                <td><form action='updateuser.php' target='action_frame' method='post'>
				    <select name='role'>
                    <option value='Student'>Student</option>
                    <option value='Admin'>Admin</option>
                    </select>
					<input type='hidden' name='userid' value=$row[userid]>
					<input type='hidden' name='courseid' value=$course>
                    <input type='submit'  value='Change Role' />
					</form></td><td width='1' bgcolor='blue'><BR></td>
					<td><form action='deleteuser.php' target='action_frame' method='post'>
				    
					<input type='hidden' name='userid' value='$row[userid]'>
					<input type='hidden' name='courseid' value='$course'>
                    <input type='submit'  value='Delete User' />
					</form></td><td width='1' bgcolor='blue'><BR></td>
					
                </tr>
                ";
    }
}
echo "</table><hr /><br />";

$query1="Select * from user_course where courseid='$course' and role='Student'";
$sql1=mysql_query($query1);
echo "<br /><h2>Pending Users</h2><br />
    <form action='usr_update.php' method='Post'>
    <table width=100%>
    <tr>
    <td style='font-size: 20px; text-align: left;'>User</td><td width='1' bgcolor='blue'><BR></td>
    <td style='font-size: 20px;'>Status</td>
    </tr><tr><td><hr /></td><td><hr /></td><td><hr /></td></tr>";
while($row1=mysql_fetch_array($sql1))
{
    if($row1['status']=='Pending')
    {
    echo "
        <tr>
        <td style='text-align: left;'> <a target='_new' href='user.php?userid=".$row1['userid']."' target='_new' >".$row1['userid']."</a></td><td width='1' bgcolor='blue'><BR></td>
		<td><select name='$row1[userid]'>
                    <option value='Pending'>Pending</option>
                    <option value='Approved'>Approved</option>
					<option value='Disapproved'>Disapproved<option>
                    </select></td>
                    </td>
                </tr>
               ";
    }
}
echo "</table><input type='submit'  value='submit' /></form>";
session_start();
$_SESSION['temp']=$course;

?>
</div>
</body>
</html>