<?php
	include('./includes/header.php');
	$videoid = $_GET['videoid'];
	
	if(isset($_FILES['thumbnail'])){
		if(($_FILES['thumbnail']['type']=='image/jpeg') || ($_FILES['thumbnail']['type']=='image/png') || ($_FILES['thumbnail']['type']=='image/gif'))
		{
			$chars ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$random_directory = substr(str_shuffle($chars),0,15);
			
			if(file_exists('data/users/videos/thumbnails/' . $random_directory. ''.$_FILES['thumbnail']['name']))
			{
				echo 'image exists';
			}else{
				move_uploaded_file($_FILES['thumbnail']['tmp_name'],'data/users/videos/thumbnails/' . $random_directory. ''.$_FILES['thumbnail']['name']);
				$img_name = $_FILES['thumbnail']['name'];
				$thumbnail = $random_directory.$img_name;
				$assoc_profile_pic = mysqli_query($conn1,"UPDATE videos SET thumbnail='$thumbnail' WHERE video_id='$videoid'");
				die('image uploaded successfully!');
			
			}			
			
		}
		if(($_FILES['thumbnail']['type']=='image/jpeg') || ($_FILES['thumbnail']['type']=='image/png') || ($_FILES['thumbnail']['type']=='image/gif')){
			
		}else{
			die('Invalid file');
		}
	}
?>
<h2>Upload your thumbnail image</h2>
<form action='upload_thumbnail.php?videoid=<?php echo $videoid;?>' method='POST' enctype='multipart/form-data'>
	<input type='file' name='thumbnail' value='Upload your image'>
	<input type='submit' name='submit' value='Upload image'>
</form>