<?php
include ( './includes/header.php' );

if(isset($_POST['create_channel'])){
	$channel_name = @$_POST['channel_name'];
	$date = date("y-m-d");
	$channel_check = mysqli_query($conn1,"SELECT channel_name FROM channels WHERE created_by='$user'");
$numrows_cc =  mysqli_num_rows($channel_check); 
if($numrows_cc < 5){
	
	$channel_name_db = "SELECT channel_name FROM channels WHERE channel_name='$channel_name'";
	$result = mysqli_query($conn1,$channel_name_db) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if($rows != 0){
		echo 'That channel is already exists. ';
		echo 'Try another one';
	}
	else if($channel_name == ''){
		echo '';
	}
	else{
	$create_channel = mysqli_query($conn1,("INSERT INTO channels VALUES('','$channel_name','$user','$date','')"));
	echo "Your channel has been created succesfully";
	}
}else{
	echo 'You can only create 5 channels per account';
}
}
?>
<h1 style="color:darkgreen;">Create Your Channel</h1>
<form action='create_channel.php' method='POST'>
<input type='text' size='40' maxlength='30' name='channel_name' placeholder='Give a channel name'>
<input type='submit' name='create_channel' value='Create channel'>
</form>
