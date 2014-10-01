<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="jquery-1.6.4.min.js" type="text/javascript" > </script>

<style type="text/css">

.lightbox_fade
{
	background-color:#CCC;
	-moz-opacity:0.4;
	opacity:0.4;
	position:absolute;
	top:0;
	left:0;
	padding:0;
	margin:0;
	width: 100%;
	height: 100%;
}

.lightbox_content
{
	position:fixed;
	border-radius: 1em;
	margin-top:100px;
	margin-left:400px;
	width:500px;
	padding:3px; 
	height:420px;
	background-color:#FFF;
	padding:5px;
	color:#000;
	-moz-box-shadow: GRAY 0 -2px 6px;
	box-shadow: GRAY 0 -2px 6px;;
}


.lightbox_close
{
	float:right;
	margin-bottom:0;
}

.lightbox_close:hover
{
	cursor:pointer;
}

</style>


<script type="text/javascript">

$("document").ready(function(){
	$('#lightbox').hide();
	$('#content').hide();
});
 
function aler()
{
	alert("YEs");
}


function show_box(){
	$('#lightbox').show();
	$('#content').fadeIn(300).show();
	$('body').css("overflow","hidden");
}

function hide_box(){
	$('#content').fadeOut(300);
	$('#lightbox').fadeOut(300);
	$('body').css("overflow","auto");
}

</script>

</head>

<body>

<h1 style="color:#286bb2; font-family:Tahoma, Geneva, sans-serif;font-size:larger"> Bongo..!! </h1>

<input type="button" onclick="show_box()" value="Click Me..!!" />

<div id="lightbox" class="lightbox_fade">
</div>
<div id="content" class="lightbox_content">
 <?php
echo "ccjcjc";
?>
<form onclick="return aler()" action="test2.php" target="action_frame" >
<input type="submit" value="See Bongo" />
</form>
<span onclick="hide_box()" class="lightbox_close" > X Close </span>
</div>



</body>
</html>
