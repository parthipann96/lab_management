<?php
class Search extends DATABASE
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
    public function allSystem()
    {
        $this->connect_db();
        $sql = "SELECT * FROM conf_table";
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
					<p><button value=".$res[0]." name='edit'>Edit</button>
					<button value=".$res[0]." name='del'>delete</button></p></div>";
		}
		echo"</div>";
		$this->disconnect_db();
    }
    public function categorySystem($opt)
    {
        $this->connect_db();
        
        if($opt=='2')
        {
            $sql="SELECT * FROM conf_table where hdd='80GB'";
        }
        else if($opt=='3')
        {
            $sql="SELECT * FROM conf_table where hdd='320GB'";
        }
        else if($opt=='3')
        {
            $sql="SELECT * FROM conf_table where hdd='320GB'";
        }
        else if($opt=='4')
        {
            $sql="SELECT * FROM conf_table where hdd='500GB'";
        }
        else if($opt=='5')
        {
            $sql="SELECT * FROM conf_table where hdd='1TB'";
        }
        else if($opt=='6')
        {
            $sql="SELECT * FROM conf_table where ram='2GB'";
        }
        else if($opt=='7')
        {
            $sql="SELECT * FROM conf_table where ram='4GB'";
        }
        else if($opt=='8')
        {
            $sql="SELECT * FROM conf_table where ram='8GB'";
        }
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
					<p><button value=".$res[0]." name='edit'>Edit</button>
					<button value=".$res[0]." name='del'>delete</button></p></div>";
		}
		echo"</div>";
		$this->disconnect_db();
    }
    public function searchSystem($host)
    {
        $this->connect_db();
        $sql = "SELECT * FROM conf_table where sys_name='$host'";
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
					<p><button value=".$res[0]." name='edit'>Edit</button>
					<button value=".$res[0]." name='del'>delete</button></p></div>";
		}
		echo"</div>";
		$this->disconnect_db();
    }
}
?>