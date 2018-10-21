<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lab Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/cartdesigncss.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/reportcss.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/sysinfocss.css" />
</head>
<body>
    <?php 
        include("include/header.php"); 
		include("include/menu.php");
		session_start();
		if(!isset($_SESSION['user']))
        {
		   	echo"<script>
		   	var r = alert('Please Login');
		    if (r == true) {
			    window.location = 'login.php';
		    }
		    else
		   	{
		   		window.location = 'login.php';
		    }</script>";
		}
		session_write_close();
		echo"<div style='font-type:bold;font-size:25px;text-align:center'>BIN</div>";
        $db_opr=new db_operation();
        $db_opr->fetchBin();
    ?>
</body>
</html>
<?php
if(isset($_POST['res']))
{
    $host=$_POST['res'];
    $db_opr->restoreSystem($host);
}
if(isset($_POST['rem']))
{
    $host=$_POST['rem'];
    $db_opr->removeSystem($host);
}
?>