<?php
	include('./includes/header.php');
	
	if(isset($_FILES['video'])){
		$title=$_POST['video_title'];
		$desc=$_POST['video_description'];
		$keywords=$_POST['video_keywords'];
		$privacy=@$_POST['privacy'];
		if(!empty($title) || ($desc) || ($keywords) || ($privacy)){
		//insert into the database	
		$chars ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$video_id = substr(str_shuffle($chars),0,15);
		$video_id = md5($video_id);
		
		//die ('Your video was successfully uploaded');
			
		}
		else{
			die('empty fields');
		}
		if(($_FILES['video']['type']=='video/mp4'))
		{
			$chars ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$random_directory = substr(str_shuffle($chars),0,15);
			
			if(file_exists('data/users/featured/' . $random_directory. ''.$_FILES['video']['name']))
			{
				echo 'video exists';
			}else{

				move_uploaded_file($_FILES['video']['tmp_name'],'data/users/featured/' . $random_directory. ''.$_FILES['video']['name']);
				
				$img_name = $_FILES['video']['name'];
				$filename = "data/users/featured/".$random_directory.$_FILES['video']['name'];
				$md5_file = md5_file($filename); //md5 file function by pritam
				$check_md5 = mysqli_query($conn1,"SELECT file_md5 FROM featured WHERE file_md5='$md5_file'");
				if(mysqli_num_rows($check_md5) != 0){
					unlink($filename);//this function stops the file from being stored into the database by pritam
					die("This is a duplicate upload");
				}else{
				
				$date = date("F j,Y"); //ex: March 19, 2018
				$insert = mysqli_query($conn1,"INSERT INTO featured VALUES ('','$title','$desc','$keywords','$user','$privacy','$date','0','$video_id','','$filename','images/thumbnail.png','no')");
				mysqli_query($conn1,"UPDATE featured SET file_md5='$md5_file' WHERE video_id='$video_id'");
				
				die('video uploaded successfully!');
				}
			
			}			
			
		}
		
	}
?>
<center><h2>Upload a feature video</h2>
<form action='uploadfeaturedvideos.php' method='POST' enctype='multipart/form-data'>
	
	Video Title: <input type='text' name='video_title' value=''/><br>
	Video Description: 
	<textarea rows='10' cols='40' name='video_description'></textarea><br>
	Video Keywords: <input type='text' name='video_keywords' value=''/><br>
	Privacy: <input type='radio' name='privacy' value='public'/> Public&nbsp;&nbsp;<input type='radio' name='privacy' value='private'/> Private<br><br><br>
	Upload your video:<br>
	<input type='file' name='video' value='Upload your video'>
	<input type='submit' name='submit' value='Upload'>
</form></center>