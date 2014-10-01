<?php
mysql_connect("localhost","root","root") or die("Error connecting a database");
			mysql_select_db("learnhub");
			
			$query="select coursename,courseid,((likes-dislikes)/b) as c from  (SELECT coursename,courseid,likes,dislikes FROM course  where (likes>0 or likes<0 or likes=0 ) and (dislikes>0 or dislikes<0 or dislikes=0) )as t1  natural join ((select courseid,count(userid) as b from  user_course group by courseid) as t2) order by c desc limit 0,5";
			
			$result=mysql_query($query);
			echo "<h2 style='color: blue' align='center'> Most popular courses on LearnHub </h2><hr />";
			while($row=mysql_fetch_array($result))
			{
				
				echo "<a style='color: red;' href='forum.php?courseid=".$row['courseid']."'>".$row['coursename']."</a><br />";
			}
?>