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
    ?>
	<form action="<?php $_POST_SELF?>" method="post">
        <div id="menu">
            <label>Choose Category</label>
            <select id="opt" name="opt" onclick="optSelect()">
                <option value="1">All system->All RAM Size->All HDD Size</option>
                <option value="2">All system->All RAM Size->All 80GB HDD Size</option>
                <option value="3">All system->All RAM Size->All 320GB HDD Size</option>
                <option value="4">All system->All RAM Size->All 500GB HDD Size</option>
                <option value="5">All system->All RAM Size->All 1TB HDD Size</option>
                <option value="6">All system->All 2GB RAM Size->All HDD Size</option>
                <option value="7">All system->All 4GB RAM Size->All HDD Size</option>
                <option value="8">All system->All 8GB RAM Size->All HDD Size</option>
                <option value="9">search system</option>
            </select>
        </div>
        <div id="srch">
            <label>Host Name</label>
            <input type="text" name="host" placeholder="MC/CL/PC/id">
        </div>
        <div id="btn">
            <input type="submit" value="View" name="view"/>
		</div>
	</form>
</body>
</html>
<?php
$db_opr=new db_operation();
if(isset($_POST['del']))
{
	$host=$_POST['del'];
	$db_opr->delSystem($host);
}

if(isset($_POST['edit']))
{
	$sys=$_POST['edit'];
	echo"<script>alert('$sys')</script>";
	$result=$db_opr->fetchDetail($sys);
	$res=mysqli_fetch_array($result);
?>
	<div class="sys-info" id="sys_edit">
		<div class="msg">
		<?php echo "HOST Address ".$res[0];?><br><form><button onclick="closeEdit()">Close</button></form>
		</div>
		<div class="box">
			<form action="<?php $_POST_SELF ?>" method="post" >
			<div class="inputboxfst">
				<input type="hidden" name="sys" value="<?php echo $res[0];?>" required/>
				<label>IP address</label>
				<input type="text" name="ip" value="<?php echo $res[1];?>" required/>
				<label>MAC address</label>
				<input type="text" name="mac" value="<?php echo $res[2];?>" required/>
				<label>Brand</label>
				<input type="text" name="make" value="<?php echo $res[3];?>" required/>
				<label>RAM</label>
				<input type="text" name="ram" value="<?php echo $res[4];?>" required/>
				<label>HDD</label>
				<input type="text" name="hdd" value="<?php echo $res[5];?>" required/>
				<label>Processor</label>
				<input type="text" name="proc" value="<?php echo $res[6];?>" required/>
			</div>
			<div class="inputboxfst">
				<label>OS1</label>
				<input type="text" name="os1" value="<?php echo $res[7];?>" required/>
				<label>OS2</label>
				<input type="text" name="os2" value="<?php if($res[8]=="")echo "NA";else echo $res[8];?>" required/>
				<label>Purchase Month</label>
				<input type="text" name="mon" value="<?php echo $res[9];?>" required/>
				<label>Purchase Year</label>
				<input type="text" name="yrs" value="<?php echo $res[10];?>" required/>
				<label>Purpose</label>
				<select name="user">
    				<option value="Student">Student</option>
    				<option value="class">class</option>
					<option value="Staff">Staff</option>
  				</select>
			</div>
		</div>
		<div class="butn-1"><center>
				<input type="submit" value="Update" name="update"/>
		</div>
		</form>
	</div>
<?php
}
if(isset($_POST['update']))
{
	$name=$_POST['sys'];
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
	$db_opr->sysUpdate($name,$mac,$ip,$ram,$hdd,$proc,$make,$os1,$os2,$mo,$yr,$usr);
	echo"<script>window.location='systemInfo.php';</script>";
}
?>
<?php
if(isset($_POST['view']))
{
    include("core/searchResult.php");
    $srch=new Search();?>
    <?php
    $opt=$_POST['opt'];
    if($opt==1)
    {
        $srch->allSystem();
    }
    else if($opt==9)
    {
        $host=$_POST['host'];
        $srch->searchSystem($host);
    }
    else
    {
        $srch->categorySystem($opt);
    }?>
    </table>
<?php
}
?>
<script>
    function optSelect()
    {
        var x = document.getElementById("opt").value; 
        if(x=='1')
        {
            document.getElementById("srch").style.display = "none";
        }
        else if(x=='9')
        {
            document.getElementById("srch").style.display = "block";
        }
        else if(x=='10')
        {
            document.getElementById("srch").style.display = "none";
        }
    }
</script>
