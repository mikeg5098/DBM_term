<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
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
                <li><a href="login_index.php">LOGIN</a></li>
            </ul>
            <div id="boxnav"></div>
        
        
        </div>
    
    
    </div>
<body id="body">
    <div id="container">
        <img id="namelogo" src="images/open-road_00436494.png">
        <div class="page">
        <div id="stylebar"></div>

            
            
            
            <div class="display_area">
                <div id="login_area">
                <div class="login">
                    <h1>DriverSide Login</h1>
                    <div class="sep_bar"></div>
            
                    
                    <form action="" method="post">
                        <label>UserName :</label>
                        <input id="name" name="username" placeholder="username" type="text"><br><br>
                        <label>Password :</label>
                        <input id="password" name="password" placeholder="**********" type="password">
                        <br><br>
                        <input name="submit" type="submit" value=" Login ">
                        <span><?php echo $error; ?></span>
                    </form>
                </div>
                    
                    
                    
                    
                <div style="float: right;" class="login">
                    <h1>Register Now</h1>
                    <div class="sep_bar"></div>
                    
                    
                    <form action="" method="post">
                        <label>First Name :</label>
                        <input id="fname" name="fname" placeholder="First Name" type="text"><br><br>
                        
                        <label>Last Name :</label>
                        <input id="lname" name="lname" placeholder="Last Name" type="text"><br><br>
                        
                        <label>UserName :</label>
                        <input id="name" name="username" placeholder="username" type="text"><br><br>
                        <label>Password :</label>
                        <input id="password" name="password" placeholder="**********" type="password">
                        <br><br>
                        <input name="register" type="submit" value=" Register ">
                        <span><?php echo $error; ?></span>
                    </form>
                
                
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <div id="bottom_bar"></div>
</html>