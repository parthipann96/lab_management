<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #111;
}

.topnav a{
  float: right;
  display: block;
  color: red;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  color: whitesmoke;
}


.topnav .search-container {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: rgba(255, 0, 0, 0);
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.header  {
  padding-top: 10px;
  font-size: 30px;
  font-weight: bold;
  float:left;
  color:red;
}
@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, {
    float: left;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
}
</style>
</head>
<div class="topnav">
  <div style="width: 100%; background-color: #111;padding-top: 10px">
    <center>
    <img src="images/header.png" width="50%" height="110px" style="background-color: #111">
    </center>
  </div>
<div class="header">
  <img src="images/title.png"/>
</div>
  <a href="index.php">Home</a>
  <a href="askUs.php">Queries</a>
  <?php 
  session_start();
  if(!isset($_SESSION['user']))
  {
    echo"<a href='login.php'>Login</a>";
  }
  else
  {
    echo"<a href=#>Welcome,".$_SESSION['user']."</a>";
  }
  session_write_close();
  ?>
  <div class="search-container">
    <input style="padding: 6px;margin-top: 8px;font-size: 17px;border: none;width:400px;" type="text" placeholder="Coming Soon..." name="search">
  </div>
</div>

