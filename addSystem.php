<!DOCTYPE html>
<html>
<head>
<title>Lab Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/addSystemcss.css"/>
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
				<td><input type="submit" value="Upload" name="upl">
				<input type="reset" value="Clear" ></td>
			</tr>
			</form>
		</table>
		</span>
	</div>
	<div class="sys-info">
		<div class="msg">
			New System
		</div>
		<div class="box">
			<form action="<?php $_POST_SELF ?>" method="post" >
			<div class="inputboxfst">
				<label>System name:</label>
				<input type="text" name="sys_name" placeholder="System name" required/>
				<label>IP address</label>
				<input type="text" name="ip" placeholder="IP address" required/>
				<label>MAC address</label>
				<input type="text" name="mac" placeholder="MAC address" required/>
				<label>Brand</label>
				<input type="text" name="make" placeholder="Make" required/>
				<label>RAM</label>
				<input type="text" name="ram" placeholder="RAM" required/>
				<label>HDD</label>
				<input type="text" name="hdd" placeholder="HDD" required/>
			</div>
			<div class="inputboxfst">
				<label>Processor</label>
				<input type="text" name="proc" placeholder="Processor" required/>
				<label>OS1</label>
				<input type="text" name="os1" placeholder="Os1" required/>
				<label>OS2</label>
				<input type="text" name="os2" value="NA" placeholder="Os2" required/>
				<label>Purchase Month</label>
				<select name="mon">
					<?php for($i=1;$i<=12;$i++)
					{?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php } ?>
				</select>
				<label>Purchase Year</label>
				<select name="yrs">
					<?php $cr_yr=date("Y");
						for($i=2000;$i<=$cr_yr;$i++)
						{?>
						<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php } ?>
  				</select>
				<label>Purpose</label>
				<select name="user">
    				<option value="student">Student</option>
    				<option value="class">class</option>
					<option value="Staff">Staff</option>
  				</select>
			</div>
		</div>
		<div class="butn-1"><center>
				<input type="submit" value="Add" name="insert"/>&nbsp;&nbsp;&nbsp;
				<input type="reset" value="Reset"/></center>
		</div>
		</form>
	</div>
</body>
</html>
<?php
$db_opr=new db_operation();
if(isset($_POST['insert']))
{
	$name=$_POST['sys_name'];
	$mac=$_POST['mac'];
	$ip=$_POST['ip'];
	$ram=$_POST['ram'];
	$hdd=$_POST['hdd'];
	$proc=$_POST['proc'];
	$os1=$_POST['os1'];
	$os2=$_POST['os2'];
	$mo=$_POST['mon'];
	$yr=$_POST['yrs'];
	$usr=$_POST['user'];
	$make=$_POST['make'];
	$db_opr->addSystem($name,$mac,$ip,$ram,$hdd,$proc,$make,$os1,$os2,$mo,$yr,$usr);
	echo"<script>window.location='addSystem.php';</script>";
}
if(isset($_POST['upl']))
{
	$db_opr->connect_db();
	$file = $_FILES["uploadfile"]["tmp_name"]; // getting temporary source of excel file
  	include("core/PHPExcel/Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
	$objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file
	$i=0;  
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  	{	
		$highestRow = $worksheet->getHighestRow();
   		for($row=2; $row<$highestRow; $row++)
   		{
    		$host = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
			$ip = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
			$mac = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
			$make= mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
			$ram = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
			$hdd = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
			$proc = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
			$os1 = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
			$os2 = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
			$mon = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
			$yr = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
			$usr = mysqli_real_escape_string($db_opr->con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
    		$sql = "INSERT INTO conf_table VALUES('$host','$ip','$mac','$make','$ram','$hdd','$proc','$os1','$os2',$mon,$yr,'$usr')";
			if(mysqli_query($db_opr->con, $sql))
			{
				$i=$i+1;
			}
		}
		echo "<script>alert('No of System Added $i')</script>";
	} 
	echo"<script>window.location='addSystem.php';</script>";  
	$db_opr->disconnect_db(); 
}
?>