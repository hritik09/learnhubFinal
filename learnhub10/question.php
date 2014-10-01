<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

   $id=$_GET['id'];
   if($id>=2)
   echo '<br /><br />';
   if($_GET['choice']==0)     
   {
   echo  '<div id='.$id.'>
         <label for="ques'.$id.'">('.$id.')Enter Question:</label><input type="text" id="ques'.$id.'" name="ques'.$id.'" size="60" max="150" onBlur="Focus(this)" /><span id="ques'.$id.'_1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
        <input type="radio" name="'.$id.'_answer" value="1" CHECKED /><label for="'.$id.'_option1">(a)</label><input type="text" id="'.$id.'_option1" name="'.$id.'_option1" onBlur="Focus(this)" /><span id="'.$id.'_option1_1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
        <input type="radio" name="'.$id.'_answer" value="2" /><label for="'.$id.'_option2">(b)</label><input type="text" id="'.$id.'_option2" name="'.$id.'_option2" onBlur="Focus(this)"/><span id="'.$id.'_option2_1" style="color: red; font-size: 9px; font-style:italic;" ></span><br />
        <input type="radio" name="'.$id.'_answer" value="3"/><label for="'.$id.'_option3">(c)</label><input type="text" id="'.$id.'_option3" name="'.$id.'_option3" onBlur="Focus(this)"/><span id="'.$id.'_option3_1" style="color: red; font-size: 9px; font-style:italic;"  ></span><br />
        <input type="radio" name="'.$id.'_answer" value="4"/><label for="'.$id.'_option4">(d)</label><input type="text" id="'.$id.'_option4" name="'.$id.'_option4" onBlur="Focus(this)"/><span id="'.$id.'_option4_1" style="color: red; font-size: 9px; font-style:italic;" ></span><br /><br />
		<label for="c_marks_'.$id.'" >Marks for Correct Answer</label><input type="text" id="c_marks_'.$id.'" name="c_marks_'.$id.'" onBlur="Focus(this)" /><span id="c_marks_'.$id.'_1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
		<label for="w_marks_'.$id.'" >Marks for Wrong Answer</label><input type="text" id="w_marks_'.$id.'" name="w_marks_'.$id.'" onBlur="Focus(this)" /><span id="w_marks_'.$id.'_1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
		<input type="hidden" name="'.$id.'_type" value="mcq" />
        </div>';
   }
	else
	{	
    echo '<div id='.$id.'>
	<label for="ques"'.$id.'">('.$id.')Enter Question:</label><input type="text" id="ques'.$id.'" name="ques'.$id.'" size="60" max="150" onBlur="Focus(this)" /><span id="'.$id.'_1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
	<input type="radio" name="'.$id.'_answer" value="true" CHECKED />True<br />
	<input type="radio" name="'.$id.'_answer" value="false"/>False<br />
	<label for="c_marks_'.$id.'">Marks for Correct Answer</label><input type="text" id="c_marks_'.$id.'" name="c_marks_'.$id.'" onBlur="Focus(this)" /><span id="c_marks_'.$id.'_1" style="color: red; font-size: 9px; font-style:italic;"></span><br />
	<label for="w_marks_'.$id.'">Marks for Wrong Answer</label><input type="text" id="w_marks_'.$id.'" name="w_marks_'.$id.'" onBlur="Focus(this)" /><span id="w_marks_'.$id.'_1" style="color: red; font-size: 9px; font-style:italic;" ></span><br />
	<input type="hidden" name="'.$id.'_type" value="tf" />	
	</div>';
	}
?>
</body>
</html>