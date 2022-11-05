<?php
	
	include("include/connection.php");
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_ID']);
	unset($_SESSION['SESS_NAME']);
	unset($_SESSION['SESS_TYPE']);
	mysqli_query($con,"UPDATE `login_master` SET `LogoutTime`=now() WHERE id='$_SESSION[loginId]'");
	unset($_SESSION['loginId']);

   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logged Out</title>

</head>
<body>

<!----<p align="center">&nbsp;</p>
<h4 align="center" class="err">You have been logged out.</h4>
<center><a href="login-form.php">Login</a> | <a href="/">Scribzoo</a></center><br/><br/><br/><br/> ----->
<?php session_destroy();
header("location: index.php");
 ?>
</body>
</html>
