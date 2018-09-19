<?php
include('./includes/header.php');
$channel = $_GET['c'];
$check_subscribe = ("SELECT * FROM subscriptions WHERE user_who_subscribed='$user'");
	$result_s = mysqli_query($conn1,$check_subscribe);
	$count_s = mysqli_num_rows($result_s);
	if($count_s > 0){
		$subbutton = 'UNFOLLOW';
	}
	else{
		$subbutton = 'FOLLOW';
	}
$check_channel = ("SELECT * FROM channels WHERE channel_name='$channel'");
$result = mysqli_query($conn1,$check_channel);
$count = mysqli_num_rows($result);
if($count == 1){
	while($row = mysqli_fetch_assoc($result)){
		$id = $row['id'];
		$channel_name = $row['channel_name'];
		$created_by = $row['created_by'];
		$date_created = $row['date_created'];
		$channel_icon = $row['channel_icon'];
		
		if(isset($_POST['subscribe'])){
	$check_subscribe = ("SELECT * FROM subscriptions WHERE user_who_subscribed='$user'");
	$result_s = mysqli_query($conn1,$check_subscribe);
	$count_s = mysqli_num_rows($result_s);
	if($count_s > 0){
		$subscribe_query = ("DELETE FROM subscriptions WHERE user_who_subscribed='$user'");
		$result_s = mysqli_query($conn1,$subscribe_query);
		header("Location: channel.php?c=$channel_name");
	}
	else{
	$subscribe_query = ("INSERT INTO subscriptions VALUES ('','$user','$channel_name','no')");
	$result_s = mysqli_query($conn1,$subscribe_query);
	header("Location: channel.php?c=$channel_name");
	}
		}
?>
<div class='channeloptions'>
	<center><h2><mark><font><?php echo $channel_name;?></font></mark></h2>
	<img src='data/channels/images/icons/<?php echo $channel_icon;?>' height='200' width='200'/><br>
	<?php 
	echo "<b>Welcome to your channel<br>
	Channel Name: $channel_name</b><br><br><br>
	"
	;
	?>
	</center>
	<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<center><form action='channel.php?c=<?php echo $channel_name;?>' method='POST'>
	<input  type='submit' name='subscribe' value='<?php echo $subbutton;?>'/>
	 
	</form></center>
</div>
<div class='channelvideocontainer'>
		
</div>
<?php
	}
}else{
	header("Location: index.php");
}
?> 