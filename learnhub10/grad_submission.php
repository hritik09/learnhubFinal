<?php

$con=  mysql_connect("localhost", "root", "root");
  if(!$con)
  {
      die('Could not connect to databse'.mysql_error());
  }
  
  $res=$_POST['resp_eventid'];
  mysql_select_db("learnhub", $con);
  
    $query="Select eventid,courseid from event where resp_eventid='$res'";
    $sql=mysql_query($query);
    while($row=mysql_fetch_array($sql))
    
        
    {
        $courseid=$row['courseid'];
        $grad=$row['eventid'];
        
        if(isset($_POST[$grad]))
        {
        $query1="UPDATE event SET event_eval='$_POST[$grad]' where eventid='$grad'";
        if (!mysql_query($query1,$con))
        {
            die('Error: ' . mysql_error());
        }
            
        }
    }
  
?>
Grades have been saved successfully.Click here to <a href="timeline.php?courseid=<?php echo $courseid;?>" target="action_frame">continue</a>