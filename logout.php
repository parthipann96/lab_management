<?php
include("core/Users.php");
$uobj=new Users();
$uobj->logout();
header('Location:index.php');
?>