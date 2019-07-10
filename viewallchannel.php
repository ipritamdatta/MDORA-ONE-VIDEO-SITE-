<?php
include('./includes/header.php');


$view_channel = mysqli_query($conn1,"SELECT channel_name FROM channels ORDER by date_created DESC");
$numrows_cc =  mysqli_num_rows($view_channel); 
if($numrows_cc == 0){
	echo ''; //Don't have any channel and need to create one.
?>
	There are no channels available
	<?php
	}else{
	while($row = mysqli_fetch_assoc($view_channel)){
		$channel_name = $row['channel_name'];
		echo "<center><h2><img src='./images/Pointing_hand.png' width='35px' height='30px'/><a href='channel.php?c=$channel_name'>$channel_name</a></center></h2>";
		echo "<br>";
	}
	}
?>