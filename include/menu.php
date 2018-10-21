<style>
.sidenav {
    margin-top:0px;
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: rgba(255, 7, 7, 0.767);
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: -6px;
    right: 10px;
    font-size: 50px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
    margin-top: 0px;
    width: 30px;
    height: auto;
    background: #111;
    font-size:50px;
    cursor:pointer;
}
#main span
{
    color: rgba(255, 7, 7, 0.767);
}
#main span:hover
{
    color: #f1f1f1;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<?php include("core/Users.php");?>
        <div id="main">
                <span onclick="openNav()">&raquo;</span>
            </div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&laquo;</a>
  <a href="admin.php">Home</a>
  <a href="addSystem.php">Add System</a>
  <a href="systemInfo.php">View/Edit/Delete System</a>
  <a href="report.php">Report</a>
  <a href="newAdmin.php">New Admin</a>
  <a href="uploadUsers.php">Add user</a>
  <a href="trash.php">Recycle Bin</a>
  <a href="logout.php">Logout</a>
</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("main").style.display="none";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.getElementById("main").style.display="block";
}
</script>