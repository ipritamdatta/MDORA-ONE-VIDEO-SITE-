<?php
session_start();
include ( './includes/functions.php' );
include ( './includes/connect_to_mysql.php' );
$user ="";
if(isset($_SESSION['username'])){
	$user =$_SESSION['username'];
}else{
	$user ="";
}
?>
<!doctype html>
<html>
	<head>
	<title>MDORA ONE &bull; <?php echo page_title( 'Share Your Videos with the World!' ); ?></title>
    <?php if ($browser == "Google Chrome" || $browser == "Apple Safari") {
	echo '
	<link rel="stylesheet" type="text/css" href="/project/mdoraone/css/sitestyle.css" />
    <link id="edu_menu" rel="stylesheet" type="text/css" href="/project/mdoraone/css/webkit/menu_black.css" />
	';
	}
	else if ($browser == "Mozilla Firefox") {
	echo '
	<link rel="stylesheet" type="text/css" href="/project/mdoraone/css/sitestyle.css" />
    <link id="edu_menu" rel="stylesheet" type="text/css" href="/project/mdoraone/css/firefox/menu_black.css" />
	';
	}
	else if ($browser == "Internet Explorer") {
	echo '
	<link rel="stylesheet" type="text/css" href="/project/mdoraone/css/sitestyle.css" />
    <link id="edu_menu" rel="stylesheet" type="text/css" href="/project/mdoraone/css/ie/menu_black.css" />
	';
	}
        else
        {
        echo '
        <link rel="stylesheet" type="text/css" href="/project/mdoraone/css/sitestyle.css" />
    <link id="edu_menu" rel="stylesheet" type="text/css" href="/project/mdoraone/css/webkit/menu_black.css" />
        ';
        }?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
	</head>
<body style="background-color:#FFF;">
<div class="menu_bg"></div>
	<div id="wrapper" style="background-color: #FFF;"><br />&nbsp;<h1 align="center"><font size="18" color="coral">MDORA</font><font size="18">ONE<img src="./images/mdorapic.png" width="70" height="65"/></font></h1>  
    		<div id="menu" >
            		<ul >
						<li class="menu_featured"><a href="index.php">HOME</a></li>
                        <li class="menu_featured"><a href="showfeatured.php">FEATURED</a></li>
	                <li class="menu_popular"><a href="popular.php">POPULAR VIDEOS</a></li>
                        <li class="menu_latest"><a href="latest_videos.php">LATEST VIDEOS</a></li>
                        <li class="menu_newmembers"><a href="latest_members.php">RECENT MEMBERS</a></li>
                        <li class="menu_channels"><a href="viewallchannel.php">CHANNELS</a></li>
						<?php if($user == "") { echo '
                        <li class="menu_login"><a href="login.php">LOGIN</a></li>
                        <li class="menu_join"><a href="join.php">CREATE AN ACCOUNT</a></li>
						'; 
						}
						else
						{
							echo '<li class="menu_login"><a href="members.php">PROFILE</a></li>
							<li class="menu_login"><a href="logout.php">LOGOUT</a></li>';
							
						}
						?>
	                </ul>
                    <form action="search.php" id="search_form" method="POST" >
                     <?php if ($browser == "Google Chrome" || $browser == "Safari") {
					echo '
					<input type="text" name="search" id="search_box"  value="" placeholder="search.."/>
					';
					}
					else if ($browser == "Mozilla Firefox") {
					echo '
					<input type="text" name="search"  id="search_box"  value="" placeholder="search.."/>
					';
					}
					else if ($browser == "Internet Explorer") {
					echo '
					<input type="text" name="search"  value="" placeholder="search.."/>
					';
					}
					else
					{
					echo '
					<input type="text" name="search"  id="search_box"  value="" placeholder="search.."/>
					';
					}?>
					<input type="submit"  id="search_button" value=""/>
                    </form>
            </div>