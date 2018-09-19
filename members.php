<?php
include ( './includes/header.php' );

if(isset($_POST['create_channel'])){
	header("Location: create_channel.php");
}

$get_profile_pic = mysqli_query($conn1,"SELECT profile_pic FROM users WHERE username='$user'");
$numrows_profile_pic = mysqli_num_rows($get_profile_pic);
if($numrows_profile_pic == 1){
	while($row = mysqli_fetch_assoc($get_profile_pic)){
		$profile_pic = $row['profile_pic'];
		
		if($profile_pic == ''){
			echo "<img src='./data/users/images/icons/default.jpg' height='120' width='130'>";
		}else{
		echo "<img src='./data/users/images/icons/$profile_pic' height='120' width='130'>";
		}
	}
}else{
	die('unknown error');
}

?><br />
<h2 style="color:darkgreen;"><font size="6">Profile Page</font></h2>
<hr />
Your channels:<p />
<?php
$channel_check = mysqli_query($conn1,"SELECT channel_name FROM channels WHERE created_by='$user'");
$numrows_cc =  mysqli_num_rows($channel_check); 
if($numrows_cc == 0){
	echo ''; //Don't have any channel and need to create one.
	?>
	You haven't made any channels. click here to create.
	<form action = 'create_channel.php'>
	<input type='submit' name='goto_channel_create' value='Create my channel'/>
	</form>
	<?php
	}else{
	while($row = mysqli_fetch_assoc($channel_check)){
		$channel_name = $row['channel_name'];
		echo "<b>$channel_name</b>-<a href='channel.php?c=$channel_name'>View Your Channel</a> | <a href='channel_settings.php?c=$channel_name'>Channel Settings</a><p /> ";
	}
	echo "$numrows_cc/5 channels created ";
}
?>
<br><br><br><br><br><br>
<div style="color: Blue;">
			<h1>View & Edit Videos</h1>
			<h3>Click Here to view and edit your videos: </h3>
			<h2 class="tag"><a href='my_videos.php'>Edit videos</a></h2>
		</div>
<br><br>
<h2><a href="create_channel.php">Create channel</a><?php echo "        |        ";?></h2>
<?php
echo "<h3><a href='upload.php'>Upload a video</a></h3>";
		echo "<h3><a href='uploadfeaturedvideos.php'>Upload a feature video</a></h3>";
		 echo "<h3><a href='myfeatured_videos.php'>Edit featured videos thumbnail</a></h3>";
echo "<h3>";echo "<a href='profile.php?u=$user'>Go to profile</a>";echo "<br />";echo "<br />";echo "</h3>";
echo "<h3>";echo "<a href='upload_image.php'>Upload Member page image</a>";echo "<br />";echo "<br />";echo "</h3>";
echo "<h3>";echo "<a href='#'>Check liked vides</a>";echo "<br />";echo "<br />";echo "</h3>";//likedvideospage.php
?>