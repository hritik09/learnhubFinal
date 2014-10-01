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
echo "Registered Users<br />
    <table border=1>
    <tr>
    <td>User</td>
    <td>Status</td>
    <td>Current Role</td>
    <td>Change</td>
    <td>Submit</td>
    </tr>";
while($row=mysql_fetch_array($sql))
{
    if($row['status']=='Approved')
    {
    echo "
        <tr>
        <td>".$row['userid']."</td>
            <td>".$row['status']."</td>
                <td>".$row['role']."</td>
                <td><form action='updateuser.php' target='action_frame'>
				    <select name='role'>
                    <option value='Student'>Student</option>
                    <option value='Admin'>Admin</option>
                    </select>
					<input type='hidden' name='userid' value=$row['userid']>
					<input type='hidden' name='courseid' value=$course>
                    <input type='submit'  value='Change Role' />
					</form></td>
					<td><form action='deleteuser.php' target='action_frame'>
				    
					<input type='hidden' name='userid' value=$row['userid']>
					<input type='hidden' name='courseid' value=$course>
                    <input type='submit'  value='Delete User' />
					</form></td>
					
                </tr>
                ";
    }
}
echo "</table><input type='submit' name='chang' value='Submit' />
    </form>";

$query1="Select * from user_course where courseid='C103' and role='Student'";
$sql1=mysql_query($query1);
echo "<br />Pending Users<br />
    <form action='usr_update.php' method='Post'>
    <table border=1>
    <tr>
    <td>USER</td>
    <td>Status</td>
    <td>Confirm</td>
    </tr>";
while($row1=mysql_fetch_array($sql1))
{
    if($row1['status']=='Pending')
    {
    echo "<input type='hidden' name='id' value='".$row1['userid']."'> 
        <tr>
        <td>".$row1['userid']."</td>
            <td>".$row1['status']."</td>
                    <td><input type='submit' name='".$row1['userid']."' value='Confirm' /></td>
                </tr>
               ";
    }
}
echo "</table></form>";
    

?>