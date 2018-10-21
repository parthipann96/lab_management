<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lab Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/logincss.css" />
</head>
<body>
	<?php include("include/header.php");
	include("core/Db.php");
	include("core/Users.php");
	$uobj=new Users();
	session_start();
	if(isset($_SESSION['user']))
    {
		session_write_close();
		header("Location:admin.php");
	}
	if(!$uobj->existAccount())
	 {
		 header("Location:configAccount.php");
	 }
	session_write_close();
	?>
	<div class="login-info">
		<div class="msg">
			LOGIN
		</div>
		<div class="box">
			<form action="<?php $_POST_SELF ?>" method="post" >
			<div class="inputbox">
				<label>Username</label>
				<input type="text" name="username" placeholder="USERNAME" required/>
			</div>
			<div class="inputbox">
				<label>Password</label>
				<input type="password" name="password" placeholder="PASSWORD" required/>
			</div>
			<div class="butn">
				<div class="butn-1"><input type="submit" value="Login" name="go"</div>
				<div class="butn-1"><input type="reset" value="Reset" </div>
			</div>
			
			</form>
			<div class="frgt-pass" >
				<a href="#forgot">Forget Password?</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php
if(isset($_POST['go']))
{
    $user=$_POST["username"];
	$pass=$_POST["password"];
	$uobj=new Users();
    if($uobj->login($user,$pass))
    {
        header("Location:admin.php");
    }
    else
    {
        echo"<script>alert('Invalid Login')</script>";
	}
}
?>