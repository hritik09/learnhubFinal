<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quiz Creation</title>
<script type="text/javascript">
     var id=0;
    function add_question(choice)
	{
		 var i= id.toString(); 
		 alert(choice);
		 var xmlhttp;
		 if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  			}
		 else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	  {
    		document.getElementById(i).innerHTML=xmlhttp.responseText;
          }
          }
			xmlhttp.open("GET","question.php?id="+ i+"&"+"choice="+choice,true);
			xmlhttp.send();

	}
	
	function new_question(choice)
	{
		id++;
		//if(id==2)
		//alert(document.getElementById("ques1").value);
		 var i=id.toString();
		 //var id="2";
		 //alert(id);
		 var div2=document.createElement("div");
		 var form1=document.getElementById("questions");
		 form1.appendChild(div2);
		 div2.id=i;
		 add_question(choice);
	}
	
	function number_of_question()
	{
		var totalMarks=0;;
		var questions=document.getElementById("no_of_question");
		questions.value=id;
		for(var j=1;j<=id;j++)
		{
			totalMarks+=parseInt(document.getElementById("c_marks_"+j).value);
		}
		document.getElementById("totalMarks").value=totalMarks;
		//alert(totalMarks);
	}
	
	
</script>
</head>

<body >
<form id="form1" action="quiz_file_creation.php" method="POST" >
	<fieldset>
    	<legend>Quiz Creation</legend>
        <input type="text" name="quiz_name"  />
        <div id="questions">
        
        </div>
        
         <input type="button" id="multiple_choice" name="multiple_choice"  value="Add a Multiple-Choice question" onclick="new_question(0)"/>
         <input type="button" id="true_false" name="true_false"  value="Add a True-False question" onclick="new_question(1)"/>
         <input type="hidden" id= "no_of_question" name="no_of_question" value="" />
         <input type="hidden" name="totalMarks" id="totalMarks" />
        <input type="submit" id="submit_quix" name="quiz" value="Create Quiz" onclick="number_of_question()" />
    </fieldset>
</form>




</body>
</html>