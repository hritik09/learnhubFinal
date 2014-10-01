<?php ob_start(); ?>

<?php
session_start();
$con=mysql_connect("localhost","root","root");
	if(!$con)
	{
		die("Error connecting:".mysql_error());
	}
	
	mysql_select_db('learnhub') or die("Error selecting a database:".mysql_error());
	$query="select password,userid,firstname,last_login from user where userid='".$_POST['user']."'";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if(isset($row['password']))
	{
	if($row['password']==md5($_POST['pass']))
	{
	 
	 $_SESSION["userid"]=$row["userid"];
	 $_SESSION["firstname"]=$row["firstname"];
	 $_SESSION["last_login"]=$row["last_login"];
	 $dat=date("Y/m/d");
	 $query="update user set last_login='$dat' where userid='".$_POST['user']."'";
	 echo $query;
	 if(mysql_query($query,$con))
	 {
	 header("Location: homepage.php");}
	 echo "noob";
	 
	
	}
	else
	{
		//$_SESSION["userid"]=$row["userid"];
		$_SESSION["login_error"]="<p style='color: red; font-style: italic; font-size: 12px;'>Wrong Password</p>";
		header("Location: index.php");
	}
	
	}
	else
	{
	$_SESSION["login_error"]="<p style='color: red; font-style: italic; font-size: 12px;'>Invalid Username</p>";
	header("Location: index.php");
	}
	

?>
<?php ob_end_flush(); ?>