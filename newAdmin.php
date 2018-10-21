<html>
    <head><title>Lab management</title>
    <link rel="stylesheet" type="text/css" href="css/addAdmin.css"/>
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
        <div class="qury-form">
		<div class="msg1">
			Create Account
		</div>
		<div class="box1">
			<form action="<?php $_POST_SELF ?>" method="POST">
			<div class="inputbox1">
				<label>Name</label>
				<input type="text" name="name" required/>
			</div>
			<div class="inputbox1">
				<label>UserName</label>
				<input type="text" name="uname" required/>
            </div>
            <div class="inputbox1">
				<label>Password</label>
				<input type="password" name="pass" required/>
            </div>
            <div class="inputbox1">
				<label>Confirm Password</label>
				<input type="password" name="conf_pass" required/>
			</div>
			<div class="butn1"  style="padding:5px;">
				<div class="butn1-1"><input type="submit" value="Add account" name="add"</div>
				<div class="butn1-1"><input type="reset" value="Clear" </div>
			</div>
			</form>
		</div>
    </div>
    </body>
</html>
<?php
if(isset($_POST['add']))
{
    $name=$_POST['name'];
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    $cpass=$_POST['conf_pass'];
    $uobj=new Users();
    $uobj->addAdmin($name,$uname,$pass,$cpass);
}
?>