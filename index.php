<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lab Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/indexcss.css" />
</head>
<body>
	<?php
	include("include/header.php");
	include("core/Users.php");
	$uobj=new Users();
	if(!$uobj->existAccount())
	 {
		 header("Location:configAccount.php");
	 }
	if(isset($_SESSION['user'])) 
	{
		header("Location:admin.php");
	}?>
	<div>
		<center><img src="images/lab_layout.jpg" alt="MCA-LAB Layout" height="800px" width="90%"/></center>
	</div>
</body>
</html>
