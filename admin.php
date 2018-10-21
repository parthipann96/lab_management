<!DOCTYPE html>
<html lang="en">
	<head><title>Lab Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/admincss.css"/>
	<link rel="stylesheet" type="text/css" href="css/cartdesigncss.css"/>
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
		?>
		<div class="err-form">
		<div class="msg1">
			Done a job <br>
			update here
		</div>
		<div class="box">
			<form action="<?php $_POST_SELF ?>" method="POST">
			<div class="inputbox">
			<th>
				<label>Complaint ID</label>
				<input type="text" name="complaint_id" required/>
			<th>
			</div>
			<div class="inputbox">
			<th>
				<label>Solution Description</label>
				<input type="text" name="sol" required/>
			</th>
			</div>
			<div class="butn">
			<th>
				<div class="butn-1"><input type="submit" value="Solve" name="solve"></div>
				<div class="butn-1"><input type="reset" value="Clear" ></div>
			<th>
			</div>
			</form>
		</div>
	</div>
		<?php
		$db_opr=new db_operation();
		$db_opr->systemComplaint();
		?>
		   
</body>
</html>
<?php
if(isset($_POST['sol']))
{
	$c_id=$_POST['complaint_id'];
	$solu=$_POST['sol'];
	$date=date("Y-m-d");
	$db_opr->postSolution($c_id,$solu,$date,$_SESSION['user']);
}
?>