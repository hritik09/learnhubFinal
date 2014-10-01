<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Downloading</title>
</head>

<body>


<?php
    //this can only download pdf format files.
    $link=$_GET['link'];  
	$file=$_GET['file'];
	$ext=substr($file,strpos($file,".")+1);
    header("Content-disposition: attachment; filename=".$file);
    if($ext=="pdf")
	header('Content-type: application/pdf');
    readfile($link);
?> 

</body>
</html>