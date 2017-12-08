<?php
include('session.php');
?>
<!DOCTYPE html>
<html style="background-color: #e8e8e8">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <head>
        <title>DriverSide</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>


    <div id="header">
        <div class="container">
            <ul id="header-nav">
                <li><a href="index.html">HOME</a></li>
                <li><a href="DataBaseTerm.php">DATABASE</a></li>
                <li><a href="team.html">TEAM</a></li>
                <li><a href="login.html">LOGIN</a></li>
                <?php if($id_session == 1 OR $id_session == 2 OR $id_session == 3){
									echo "<li><a href=\"admin.php\">ADMIN</a></li>";
								}
								?>
            </ul>
            <div id="boxnav"></div>


        </div>


    </div>
<body id="body">
    <div id="container">
        <img id="namelogo" src="images/open-road_00436494.png">
        <div class="page">
        <div id="stylebar"></div>

            <div id="profile">
                <div id="bound">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>
            </div>
                </div>
                </div>
</body>
    <div id="bottom_bar"></div>
</html>
