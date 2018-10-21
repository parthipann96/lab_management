<!DOCTYPE html>
<html>
<head>
<title>Lab Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/addSystemcss.css"/>
<link rel="stylesheet" type="text/css" href="css/addAdmin.css"/>
</head>
<body>
<?php include("include/header.php"); 
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
	<div class="xl_db">
		<div class="info">
			Upload xls to database
		</div>
		<table>
		<span class="upload">
			<form action="<?php $_POST_SELF ?>" method="POST" enctype="multipart/form-data">
			<th>
				<label>Choose file</label>
				<input type="file" name="uploadfile" accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" required/>
			<th>
			<tr>
				<td><div class="butn1-1">
                <input type="submit" value="Upload" name="upl">
				<input type="reset" value="Clear" ></div></td>
			</tr>
			</form>
		</table>
		</span>
	</div>
    <div class="qury-form" style="height:300px">
		<div class="msg1">
			Add a User
		</div>
		<div class="box1">
			<form action="<?php $_POST_SELF ?>" method="POST">
			<div class="inputbox1">
				<label>Register Number</label>
				<input type="text" name="reg" required/>
			</div>
			<div class="inputbox1">
				<label>Name</label>
				<input type="text" name="name" required/>
            </div>
			<div class="butn1"  style="padding:5px;">
				<div class="butn1-1"><input type="submit" value="Add User" name="add"</div>
				<div class="butn1-1"><input type="reset" value="Clear" ></div>
			</div>
			</form>
		</div>
    </div>
</body>
</html>
<?php
if(isset($_POST['add']))
{
	$reg=$_POST['reg'];
	$name=$_POST['name'];
	$db_opr=new Users();
	$db_opr->addUser($reg,$name);
}
if(isset($_POST['upl']))
{
	include_once("config/config.php");
	$db=new DATABASE();
	$db_opr->connect_db();
	//$con = mysqli_connect(,"root","","lab_management");
	$file = $_FILES["uploadfile"]["tmp_name"]; // getting temporary source of excel file
  	include("core/PHPExcel/Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
	$objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file
	$i=0;  
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  	{	
		$highestRow = $worksheet->getHighestRow();
   		for($row=2; $row<$highestRow; $row++)
   		{
    		$reg = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
			$name = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    		$sql = "INSERT INTO conf_table VALUES('$reg','$name')";
			if(mysqli_query($db_opr->con, $sql))
			{
				$i=$i+1;
			}
		}
		echo "<script>alert('No of User Added $i')</script>";
	} 
	echo"<script>window.location='addSystem.php';</script>";  
	$db_opr->disconnect_db(); 
}
?>