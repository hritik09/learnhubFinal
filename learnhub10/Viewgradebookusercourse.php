<html>
<head>
<title> LearnHub: User Gradebook</title>
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
<h1>My Gradebook</h1><hr /><br />

<?php
session_start();
$con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  $course=$_GET['courseid'];;
  $user=$_SESSION['userid'];
  mysql_select_db("learnhub", $con);
  
  $sql="Select * from event natural join file where courseid='$course' and userid='$user' and event_type in ('EASUP', 'EQEVAL')";
  $query=mysql_query($sql);
  echo"<table width=100%>
              <tr>
              <td style='font-size: 20px; text-align: left;'>Event Name</td><td width='1' bgcolor='blue'><BR></td>
              <td style='font-size: 20px;'>Event Date</td><td width='1' bgcolor='blue'><BR></td>
              <td style='font-size: 20px;'>Grade</td>
              </tr><tr><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td></tr>
          ";
  while($row=mysql_fetch_array($query))
  {
     echo "
              <tr>
              <td style='text-align: left;'>".$row['event_name']."</td><td width='1' bgcolor='blue'><BR></td>
                  <td>".$row['event_date']."</td><td width='1' bgcolor='blue'><BR></td>";
                      if($row['event_eval']==null)
                      {
                          echo "<td>Not Graded</td>";
                      }
                      else
                      {
                       echo "<td>".$row['event_eval']."</td>";
                      }
                echo "</tr>";
  }
  echo "</table>";
?>
</div>
</body>
</html>
