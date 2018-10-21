<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lab Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/askuscss.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php include("include/header.php");
    // include("core/DatabaseAction.php");
    if(isset($_SESSION['user']))
    {
        include("include/menu.php");
    } ?>
    <div class="help"> 
        <div class="dodont">
            Rules to Follow in a computer Lab
        </div>
        <b>Do:</b>
        <ul>
            <li>Always shut down your computer properly</li>
            <li>Do regular Scan disk to check the hard disk surface for damage </li>
            <li>Delete all files and programs you no longer need from your computer </li>
            <li>Backup your data with you</li>
        </ul>
        <b>Don't:</b>
        <ul>
            <li>Don't eat & drink around the computer</li>
            <li>Don't unplug the any cable from computer</li>
            <li>Don't use magnets around a computer</li>
            <li>Don’t download unknown software from the Internet</li>
            <li>Don't install & update software without any permission</li>
        </ul>
    <div>
    <div class="qury-form">
		<div class="msg1">
			Have a Trouble <br>
			Post information here
		</div>
		<div class="box1">
			<form action="<?php $_POST_SELF ?>" method="POST">
            <div class="inputbox1">
				<label>Student Reg</label>
				<input list="reg" name="stu_id" required>
                <datalist id="reg">
                <option value="12212">
                <option value="1344">
                <?php
                include_once("core/DatabaseAction.php");
                $db_opr=new db_operation();
                $db_opr->student_reg();
                ?>
                </datalist>
			</div>
			<div class="inputbox1">
				<label>System Name</label>
				<input list="sys" name="sys_name" required>
                <datalist id="sys">
                <?php
                $db_opr->sys_host();
                ?>
                </datalist>
			</div>
			<div class="inputbox1">
				<label>Problem Description</label>
				<textarea name="pd" rows="4" cols="20" maxlength="100" placeholder="max 100 character" required></textarea>
			</div>
			<div class="butn1"  style="padding:5px;">
				<div class="butn1-1"><input type="submit" value="Post" name="pst"</div>
				<div class="butn1-1"><input type="reset" value="Clear" </div>
			</div>
			</form>
		</div>
    </div>
</body>
</html>
<?php
if(isset($_POST['pst']))
{
    $db_opr->post_complaint($_POST['sys_name'],$_POST['pd'],date("Y-m-d"),$_POST['stu_id']);
}
?>