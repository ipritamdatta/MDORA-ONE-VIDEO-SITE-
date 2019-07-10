<?php
include('./includes/header.php');
$videoid = $_GET['videoid'];

$check = mysqli_query($conn1,"SELECT * FROM videos WHERE video_id='$videoid'");
if (mysqli_num_rows($check) == 1){

while($row = mysqli_fetch_assoc($check)){
	$id = $row['id'];
	$video_title = $row['video_title'];
	$video_description = $row['video_description'];
	$video_keywords = $row['video_keywords'];
	$uploaded_by = $row['uploaded_by'];
	$privacy = $row['privacy'];
	$date_uploaded = $row['date_uploaded'];
	$views = $row['views'];
	$video_id = $row['video_id'];
	$videosrc = $row['file_location'];//videosrc is for file location by pritam
	
	$newviews = $views+1;
	$updateviews = mysqli_query($conn1,"UPDATE videos SET views='$newviews' WHERE video_id='$videoid'");
	//Pritam will now assume that privacy is public
	if($privacy == 'public'){
		$c = 'checked';
		$c2 = '';
	}else{
		$c = '';
		$c2 = 'checked';
	}
	//Now pritam will do the main work
	if(isset($_POST['submit'])){
		$v_title = $_POST['video_title'];
		$v_desc = $_POST['video_description'];
		$v_keywords = $_POST['video_keywords'];
		$v_privacy = $_POST['privacy'];
		if($v_title == ""){
			die("You can't leave the title field blank!!");
		}else if($v_desc == ""){
			die("You can't leave the description field blank!!");
		}else if($v_keywords == ""){
			die("You can't leave the keywords field blank!!");
		}else if($v_privacy == ""){
			die("You can't leave the privacy field blank!!");
		}
		else{
			//now as everything is fine, pritam will do mysql query to update the database
			mysqli_query($conn1,"UPDATE videos SET video_title='$v_title',video_description='$v_desc', video_keywords='$v_keywords', privacy='$v_privacy' WHERE video_id='$videoid'");
			die("Success");
		}
		
	}
	
	}
}
?>

<center><h2>Edit & upload video</h2>
<form action='edit_video.php?videoid=<?php echo $videoid;?>' method='POST' enctype='multipart/form-data'>
	
	Video Title: <input type='text' name='video_title' value='<?php echo $video_title;?>'/><br>
	Video Description: 
	<textarea rows='10' cols='40' name='video_description'><?php echo $video_description;?></textarea><br>
	Video Keywords: <input type='text' name='video_keywords' value='<?php echo $video_keywords;?>'/><br>
	Privacy: <input type='radio' name='privacy' <?php echo $c;?> value='public'/> Public&nbsp;&nbsp;
	<input type='radio' name='privacy' <?php echo $c2;?> value='private'/> Private<br><br><br>
	<input type='submit' name='submit' value='Edit video'>
</form></center>