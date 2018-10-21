<?php
include("DatabaseAction.php");
/**
 * 
 */
class Users extends db_operation
{
	
	public function login($uname,$pass)
	{
		session_start();
		$this->connect_db();
		$sql="select * from users where username='$uname' and password='$pass'";
   		$res=mysqli_query($this->con,$sql);
   		if(mysqli_num_rows($res)==1)
    	{
			$result=mysqli_fetch_array($res);
			$_SESSION['user'] = $result[1];
			session_write_close();
			$this->disconnect_db();
      		return true;
    	}
    	else
    	{
    		$this->disconnect_db();
      		return false;
    	}
	}
	public function logout()
	{
		session_start();
		unset($_SESSION['user']);
		session_write_close();
	}
	public function addAdmin($name,$uname,$pass,$cpass)
	{
		if($pass==$cpass)
		{
			$this->connect_db();
			$sql="SELECT * from users where username='$uname'";
   			$res=mysqli_query($this->con,$sql);
   			if(mysqli_num_rows($res)==1)
    		{
				echo"<script>alert('Account already exists');</script>";
				$this->disconnect_db();
    		}
    		else
    		{
				$sql="INSERT into users VALUES('$uname','$name','$pass')";
				mysqli_query($this->con,$sql);
				echo"<script>alert('Admin Added');</script>";
    			$this->disconnect_db();
    		}
		}
		else
		{
			echo"<script>alert('Password did't match');</script>";
		}
	}
	public function existAccount()
	{
		$this->connect_db();
		$sql="SELECT * from users";
   		$res=mysqli_query($this->con,$sql);
   		if(mysqli_num_rows($res)==0)
    	{
			$this->disconnect_db();
      		return false;
    	}
    	else
    	{
    		$this->disconnect_db();
      		return true;
    	}
	}
	public function createAccount($name,$uname,$pass,$cpass)
	{
		if($pass==$cpass)
		{
			$this->connect_db();
			$sql="INSERT into users VALUES('$uname','$name','$pass')";
			if(mysqli_query($this->con,$sql))
			{
				echo"<script>alert('Account Created');</script>";
			}
			else
			{
				echo"<script>alert('Account Creation failed');</script>";
			}
    		$this->disconnect_db();
		}
		else
		{
			echo"<script>alert('Password did't match');</script>";
		}
	}
	public function addUser($reg,$name)
	{
		$this->connect_db();
		$sql="INSERT into student_list VALUES('$reg','$name')";
		if(mysqli_query($this->con,$sql))
		{
			echo"<script>alert('User Added');</script>";
		}
		else
		{
			echo"<script>alert('Unable to add User');</script>";
		}
    	$this->disconnect_db();
	}
}