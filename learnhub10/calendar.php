<script src="prototype.js" type="text/javascript"></script>
<?PHP
	    
		ob_start();
		if(isset($_GET['courseid']))
		$courseid=$_GET['courseid'];
		else
		$courseid=0;
		
		function isAjax() 
		{
 			return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
     					 $_SERVER ['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest';
		}

		if(isAjax() && isset($_POST['month']))
		{
			$month = $_POST['month'];
			$year = !isset($_POST['year']) ? date('Y', time()) : $_POST['year'];
			die(Calendar($month,$year,$_POST['courseid']));
		}
		if(isset($_GET['courseid']))
		   $d=$_GET['courseid'];
		 else
		   $d="";

		// Assign variables for the break down of today -- day, month and year
		$month = date('m', time());
		$year = date('Y', time());
	?>

<script type="text/javascript" language="javascript">
	var current_month = <?PHP echo @$month ?>;
	var current_year = <?PHP echo @$year ?>;
	
	//var courseid="";
	//if(courseid=="")
	//var 
	//else
	//var paramse = 'month='+current_month+'&year='+current_year+&'courseid='+courseid;
	function getPrevMonth(courseid)
	{
		if(current_month == 1)
		{
			current_month = 12;
			current_year = current_year - 1;
		}
		else
		{
			current_month = current_month - 1;
		}
			params = 'month='+current_month+'&year='+current_year+"&courseid="+courseid;
			new Ajax.Updater('calendar_wrapper',window.location.pathname,{method:'post',parameters: params});
		
	}
		function getNextMonth(courseid)
		{
			if(current_month == 12)
			{
				current_month = 1;
				current_year = current_year + 1;
			}
			else
			{
				current_month = current_month + 1;
			}
			params = 'month='+current_month+'&year='+current_year+"&courseid="+courseid;
			new Ajax.Updater('calendar_wrapper',window.location.pathname,{method:'post',parameters: params});
		}
</script>

      
	
	<?php
		$calendar = Calendar($month,$year,$courseid);

		function Calendar($month,$year,$courseid)
		{
		
			$current_time = time();
	
			// Get the first day of the month
			$month_start = mktime(0,0,0,$month, 1, $year); 
	
			// Get the name of the month
			$month_name = date('F', $month_start); 
	
			// Figure out which day of the week the month starts on.
			$first_day = date('D', $month_start);
	
			// Assign an offset to decide which number of day of the week the month starts on.
			switch($first_day)
			{
				case "Sun":
				$offset = 0;
				break;
				case "Mon":
				$offset = 1;
				break;
				case "Tue":
				$offset = 2;
				break;
				case "Wed":
				$offset = 3;
				break;
				case "Thu":
				$offset = 4;
				break;
				case "Fri":
				$offset = 5;
				break;
				case "Sat":
				$offset = 6;
				break;
			} 
	
		// determine how many days were in last month.
		//	Note: The cal_days_in_month() function returns the number of days in a month for the specified year and calendar.
		//  Gregorian Calendar: http://en.wikipedia.org/wiki/Gregorian_calendar
		//  Define this using the constant: CAL_GREGORIAN
			if($month == 1)
				$num_days_last = cal_days_in_month(CAL_GREGORIAN, 12, ($year -1));
			else
				$num_days_last = cal_days_in_month(CAL_GREGORIAN, ($month - 1), $year);
	
		// determine how many days are in the this month.
			$num_days_current = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
	
		// Count through the days of the current month -- building an array
			for($i = 0; $i < $num_days_current; $i++)
			{
				$num_days_array[] = $i+1;
			} 
			
		// Count through the days of last month -- building an array
			for($i = 0; $i < $num_days_last; $i++)
			{
				$num_days_last_array[] = '';        ///  Bhavin: Change made
			}
	
			if($offset > 0)
			{ 
				$offset_correction = array_slice($num_days_last_array, -$offset,$offset);
				$new_count = array_merge($offset_correction, $num_days_array);
			$offset_count = count($offset_correction);
			}
			else
			{ 
				$new_count = $num_days_array;
			}
	
		// How many days do we now have?
			$current_num = count($new_count); 
	
		// Our display is to be 35 cells so if we have less than that we need to dip into next month
			if($current_num > 35)
			{
				$num_weeks = 6;
				$outset = (42 - $current_num);
			}
			else if($current_num < 35)
			{
				$num_weeks = 5;
				$outset = (35 - $current_num);
			}
			if($current_num == 35)
			{
				$num_weeks = 5;
				$outset = 0;
			}
	
		// Outset Correction
			for($i = 1; $i <= $outset; $i++)
			{
				$new_count[] = '';
			}
		
		// Now let's "chunk" the $new_count array
		// into weeks. Each week has 7 days
		// so we will array_chunk it into 7 days.
			$weeks = array_chunk($new_count, 7);
		//echo "<br />";
		//print_r($week);
	// Start the output buffer so we can output our calendar nicely
			
	
			$last_month = $month == 1 ? 12 : $month - 1;
			$next_month = $month == 12 ? 1 : $month + 1;
	
			//Match date with any present date in the database in the table 'event
	    
    		mysql_connect("localhost","root","root") or die("Error connecting:".mysql_error());;
		
			mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
			$userid=$_SESSION['userid'];
			if($courseid==0)
			{
				$query="SELECT courseid FROM user_course where userid='$userid' and role=\"Student\"";
				$result=mysql_query($query);
				if (!$result) 
				{
    				die('Invalid query: ' . mysql_error());
    			}
				while($course=mysql_fetch_array($result))
				{
					
					$query="SELECT due_date FROM event where courseid='$course[0]' and event_type in ('EQCRE','EASNY','ELEFI','ELEVI')";
					$result2=mysql_query($query);
	
					if (!$result2) 
					{
    					die('Invalid query: ' . mysql_error());
    				}
					while($event=mysql_fetch_array($result2))
					{
						$datetime=(string)$event[0];
						$date=strpos($datetime," ");
						$dates[]=substr($datetime,0,$date);
					}
			}
            if(!isset($dates))
				{
					$i=0;
					$finaldays[]="";
					$thisyear="";
					$thismonth="";
				}
			else
				{
					$i=sizeof($dates);
				}
		}
		else
		{
			//echo "Heloo";
			//$courseid=$_GET['courseid'];
			$query="SELECT due_date FROM event where courseid='$courseid' and event_type in ('EQCRE','EASNY','ELEFI','ELEVI')";
			//echo "Hello";
			//echo $courseid;
			$result2=mysql_query($query);
			if (!$result2) 
			{
    			die('Invalid query: ' . mysql_error());
    		}
			else
			{
			while($event=mysql_fetch_array($result2))
			{
				$datetime=(string)$event[0];
				$date=strpos($datetime," ");
				$dates[]=substr($datetime,0,$date);
			}
			}
			if(!isset($dates))
			{
				$i=0;
				$finaldays[]="";
				$thisyear="";
				$thismonth="";
			}
			else
				$i=sizeof($dates);
		}
	 	$d=0;
	 	while($d<$i)	
	 	{
		$dd=explode("-",$dates[$d]);
		$thisyear=$dd[0];
		$thismonth=$dd[1];
		$thisday=$dd[2];
		if($dd[0]==$year && $dd[1]==$month)
		{
		  $finaldays[]=$thisday;
		}
		else
		{
			$finaldays[]='';
		}
		$d=$d+1;
	  } 
	  $d="";
	if($courseid==0)
	// Build the heading portion of the calendar table
	echo 
	'<table id="calendar">
	<tr>
		<td><a href="#" class="monthnav" onclick="getPrevMonth('.$courseid.');return false;">&laquo; Prev</a></td>
		<td colspan=5 class="month">'.$month_name.' '.$year.'</b></td>
		<td><a href="#" class="monthnav" onclick="getNextMonth('.$courseid.');return false;">Next &raquo;</a></td>
	</tr>
	<tr class="daynames"> 
		<td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td>
	</tr>';
	else
		echo '<table id="calendar">
	<tr>
		<td><a href="#" class="monthnav" onclick="getPrevMonth('.$courseid.');return false;">&laquo; Prev</a></td>
		<td colspan=5 class="month">'.$month_name.' '.$year.'</b></td>
		<td><a href="#" class="monthnav" onclick="getNextMonth('.$courseid.');return false;">Next &raquo;</a></td>
	</tr>
	<tr class="daynames"> 
		<td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td>
	</tr>';
	
	foreach($weeks AS $week){
		echo '<tr class="week">'; 
		foreach($week as $day)
		{   
			if(in_array($day,$finaldays))
				{
					echo "<td class=\"events_dates\">"." <a target=\"action_frame\" href=\"events.php?day=".$day."&month=".$thismonth."&year=".$thisyear; 
					echo "&courseid=".$courseid;  
					   echo "\">".$day."</a>"." </td>";
				}
				else
				echo '<td class="today">'.$day.'</td>';
					}
		echo '</tr>';
	}
	
	echo '</table>';
	echo '<div id="center"></div>';
	
	return ob_get_clean();
}

?>
