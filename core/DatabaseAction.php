<?php
include_once("config/config.php");
/**
 * database operation
 */
class db_operation extends DATABASE
{
	var $con;
	public function connect_db()
	{
		$this->con = mysqli_connect($this->HOST,$this->MYSQL_USERNAME,$this->MYSQL_PASSWORD,$this->DB_NAME);
	}
	public function disconnect_db()
	{
		mysqli_close($this->con);
	}
	public function systemComplaint()
	{
		$this->connect_db();
		$sql="SELECT * from complaint_info where status='Not Solved'";
		$result=mysqli_query($this->con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($res=mysqli_fetch_array($result))
			{
				echo"<div class='card'>
					<img src='images/pc.png' alt='Computer' style='width:100%'>
					<h1>ID ".$res[0]."</h1>
					<p class='price'>".$res[1]."</p>
					<p class='price'>".$res[2]."</p>
					<p class='price'>".$res[3]."</p>
					<p class='price'>REQ BY ".$res[8]."</p>
					</div>";
			}
		}
		else
		{
			echo"<tr><td colspan='5'>Computers health is good</td></tr>";
		}
		$this->disconnect_db();
		session_write_close();
	}
	public function addSystem($name,$mac,$ip,$ram,$hdd,$proc,$make,$os1,$os2,$mo,$yr,$user)
	{
		$this->connect_db();
		$sql = "INSERT INTO conf_table VALUES('$name','$ip','$mac','$make','$ram','$hdd','$proc','$os1','$os2',$mo,$yr,'$user')";
		if(mysqli_query($this->con,$sql))
		{
			echo "<script>alert('System added')</script>";
		}
		else
		{
			echo "error".mysqli_error($this->con);
			//echo "<script>alert('Failed to insert')</script>";
		}
		$this->disconnect_db();
	}
	public function post_complaint($sys,$pd,$date,$stu)
	{
		$this->connect_db();
		$sql="select sys_name from conf_table where sys_name='$sys'";
		$result=mysqli_query($this->con,$sql);
		if(mysqli_num_rows($result)==1)
		{
			$result=mysqli_fetch_array($result);
			$sys=$result['sys_name'];
			$sql="INSERT INTO complaint_info(sys_name, complaint_info, rec_date,post_by) VALUES ('$sys','$pd','$date','$stu')";
			if(mysqli_query($this->con,$sql))
			{
				echo"<script>
				var r = alert('Your Query will resolved Soon');
				if (r == true) {
					window.location = 'askUs.php';
				}
				else
				{
					window.location = 'askUs.php';
				}</script>";
			}
			else
			{
				echo"Invalid data".mysqli_error($this->con);
			}
		}
		else
		{
			echo"<script>alert('Check your system name')</script>";
		}
		$this->disconnect_db();
	}
	public function sysUpdate($name,$mac,$ip,$ram,$hdd,$proc,$make,$os1,$os2,$mo,$yr,$usr)
	{
		$this->connect_db();
		$sql="UPDATE conf_table SET ip_addr='$ip',mac_addr='$mac',brand='$make',ram='$ram',hdd='$hdd',
		processor='$proc',os1='$os1',os2='$os2',purch_month='$mo',purch_year='$yr',
		user_type='$usr' where sys_name='$name'";
		if(mysqli_query($this->con,$sql))
		{
			echo"<script>alert('Your System is Updated')</script>";
		}
		else
		{
			echo"<script>alert('Failed to Update')</script>";
		}
		$this->disconnect_db();
	}
	public function postSolution($c_id,$solu,$date,$user)
	{
		$this->connect_db();
		$sql="select * from complaint_info where complaint_id=$c_id";
		$result = mysqli_query($this->con,$sql);
		if(mysqli_num_rows($result)==1)
		{
			$sql="UPDATE complaint_info SET solution='$solu',status='solved',retified_date='$date',done_by='$user' where complaint_id=$c_id";
			if(mysqli_query($this->con,$sql))
			{
				echo"<script>alert('Solution posted and problem solved')
				window.Location=admin.php</script>";
				
			}
			else
			{
				echo"error".mysqli_error($this->con);
			}
		}
		else
		{
			echo"<script>alert('Check your complaint ID')</script>";
		}
		$this->disconnect_db();
	}
	public function delSystem($host)
	{
		$this->connect_db();
		$sql="SELECT * from conf_table where sys_name='$host'";
		$result=mysqli_query($this->con,$sql);
		$res=mysqli_fetch_array($result);
		$name=$res['0'];$ip=$res['1'];
		$mac=$res['2'];$make=$res['3'];
		$ram=$res['4'];$hdd=$res['5'];
		$proc=$res['6'];$os1=$res['7'];
		$os2=$res['8'];$mo=$res['9'];
		$yr=$res['10'];$user=$res['11'];
		$sql="INSERT INTO del_table VALUES('$name','$ip','$mac','$make','$ram','$hdd','$proc','$os1','$os2',$mo,$yr,'$user')";
		mysqli_query($this->con,$sql);
		echo"error".mysqli_error($this->con);
		$sql="DELETE from conf_table where sys_name='$host'";
		if(mysqli_query($this->con,$sql))
		{
			echo"<script>
				var r = alert('Moved to Recycle Bin');
				if(r == true) {
				window.location = 'systeminfo.php';
				}
				else
				{
					window.location = 'systeminfo.php';
				}</script>";
		}
		$this->disconnect_db();
	}
	public function fetchDetail($sys)
	{
		$this->connect_db();
		$sql="select * from conf_table where sys_name='$sys'";
		$result=mysqli_query($this->con,$sql);
		return $result;
	}
	public function fetchBin()
	{
		$this->connect_db();
        $sql = "SELECT * FROM del_table";
		$result = mysqli_query($this->con,$sql);
		echo"<div class='cont'>";
		while($res = mysqli_fetch_array($result))
		{
			echo"<div class='card'>
					<img src='images/pc.png' alt='Computer' style='width:100%'>
					<h1>".$res[0]."</h1>
					<p class='price'>".$res[1]."</p>
					<p>".$res[11]."</p>
					<form action='' method='POST'>
					<p><button value=".$res[0]." name='res'>Restore</button>
					<button value=".$res[0]." name='rem'>Remove</button></p></div>";
		}
		echo"</div>";
		$this->disconnect_db();
	}
	public function restoreSystem($host)
	{
		$this->connect_db();
		$sql="select * from del_table where sys_name='$host'";
		$result=mysqli_query($this->con,$sql);
		$res=mysqli_fetch_array($result);
		$name=$res['0'];$ip=$res['1'];
		$mac=$res['2'];$make=$res['3'];
		$ram=$res['4'];$hdd=$res['5'];
		$proc=$res['6'];$os1=$res['7'];
		$os2=$res['8'];$mo=$res['9'];
		$yr=$res['10'];$user=$res['11'];
		$sql="INSERT INTO conf_table VALUES('$name','$ip','$mac','$make','$ram','$hdd','$proc','$os1','$os2',$mo,$yr,'$user')";
		mysqli_query($this->con,$sql);
		$sql="DELETE from del_table where sys_name='$host'";
		if(mysqli_query($this->con,$sql))
		{
			echo"<script>
				var r = alert('System Restored');
				if (r == true) {
					window.location = 'trash.php';
			}
			else
			{
				window.location = 'trash.php';
			}</script>";
		}
		$this->disconnect_db();
	}
	public function removeSystem($host)
	{
		$this->connect_db();
		$sql="DELETE from del_table where sys_name='$host'";
		if(mysqli_query($this->con,$sql))
		{
			echo"<script>
				var r = alert('System removed');
				if (r == true) {
					window.location = 'trash.php';
			}
			else
			{
				window.location = 'trash.php';
			}</script>";
		}
		$this->disconnect_db();
	}
	public function student_reg()
	{
		$this->connect_db();
		$sql="select reg from student_list";
		$result=mysqli_query($this->con,$sql);
		while($res=mysqli_fetch_array($result))
		{
			echo"<option value=".$res[0].">";
		}
		$this->disconnect_db();
	}
	public function sys_host()
	{
		$this->connect_db();
		$sql="select sys_name from conf_table";
		$result=mysqli_query($this->con,$sql);
		while($res=mysqli_fetch_array($result))
		{
			echo"<option value=".$res[0].">";
		}
		$this->disconnect_db();
	}
}
?>