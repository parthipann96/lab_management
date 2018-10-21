<html>
    <head>
    <title>Lab Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/reportcss.css"/>
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
        <form action="core\Report.php" target="_blank" method="post">
        <div id="menu">
            <label>Choose report option</label>
            <select id="opt" name="opt" onclick="optSelect()">
                <option value="1">All system->All RAM Size->All HDD Size</option>
                <option value="2">All system->All RAM Size->All 80GB HDD Size</option>
                <option value="3">All system->All RAM Size->All 320GB HDD Size</option>
                <option value="4">All system->All RAM Size->All 500GB HDD Size</option>
                <option value="5">All system->All RAM Size->All 1TB HDD Size</option>
                <option value="6">All system->All 2GB RAM Size->All HDD Size</option>
                <option value="7">All system->All 4GB RAM Size->All HDD Size</option>
                <option value="8">All system->All 8GB RAM Size->All HDD Size</option>
                <option value="9">Search system</option>
                <option value="10">Issues->Solved</option>
                <option value="11">Issues->Not Solved</option>
                <option value="12">Issues->system</option>
                <option value="13">Issues->All System</option>
            </select>
        </div>
        <div id="srch">
            <label>Host Name</label>
            <input type="text" name="host" placeholder="MC/CL/PC/id">
        </div>
        <div id="btn">
            <input type="submit" value="Generate" name="gene" target="_blank"/>
        </div>
    </body>
</html>
<script>
    function optSelect()
    {
        var x = document.getElementById("opt").value; 
        if(x=='1')
        {
            document.getElementById("srch").style.display = "none";
        }
        else if(x=='9' || x=='12')
        {
            document.getElementById("srch").style.display = "block";
        }
        else if(x=='10' || x=='11')
        {
            document.getElementById("srch").style.display = "none";
        }
    }
</script>