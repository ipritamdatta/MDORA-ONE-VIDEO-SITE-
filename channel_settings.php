<?php
include ( './includes/header.php' );

$channel = $_GET['c'];

$channel_check = mysqli_query($conn1,"SELECT * FROM channels WHERE channel_name = '$channel' ");
$numrows = mysqli_num_rows($channel_check);
if($numrows == 0){
	header("Location: index.php");
}
else{
	//Channel Image Upload Code
	if(isset($_FILES['channel_pic'])){
		if(($_FILES['channel_pic']['type']=='image/jpeg') || ($_FILES['channel_pic']['type']=='image/png') || ($_FILES['channel_pic']['type']=='image/gif'))
		{
			$chars ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$random_directory = substr(str_shuffle($chars),0,15);
			mkdir('data/channels/images/icons/' . $random_directory. '');
			
			if(file_exists('data/channels/images/icons/' . $random_directory. ''.$_FILES['channel_pic']['name']))
			{
				echo 'image exists';
			}else{
				move_uploaded_file($_FILES['channel_pic']['tmp_name'],'data/channels/images/icons/' . $random_directory. ''.$_FILES['channel_pic']['name']);
				
				$img_name = $_FILES['channel_pic']['name'];
				$profile_pic = $random_directory.$img_name;
				$assoc_profile_pic = mysqli_query($conn1,"UPDATE channels SET channel_icon='$profile_pic' WHERE channel_name='$channel'");
				die('image uploaded successfully!');
			
			}			
			
		}
		if(($_FILES['channel_pic']['type']=='image/jpeg') || ($_FILES['channel_pic']['type']=='image/png') || ($_FILES['channel_pic']['type']=='image/gif')){
			
		}else{
			die('Invalid file');
		}
	}
}
?>
<h2>Channel Settings</h2>
<form action="channel_settings.php?c=<?php echo $channel;?>" method='POST' enctype='multipart/form-data'>
	<input type='file' name='channel_pic' value='Upload your channel image'>
	<input type='submit' name='submit' value='Upload Channel image'>
</form>