<?php 
include('./includes/header.php');
$videoid = $_GET['videoid'];

//mysqli_query($conn1,"UPDATE videos SET deleted ='yes' WHERE video_id ='$videoid'") or die(mysqli_error());
$delete = mysqli_query($conn1,"SELECT * FROM videos WHERE uploaded_by='$user'") ;
$result = mysqli_num_rows($delete);
if($result==0){

header("Location: my_videos.php");
}
else {
	while($row = mysqli_fetch_assoc($delete)){
		$title = $row['video_title'];
		$desc = $row['video_description'];
		$keywords = $row['video_keywords'];
		$uploaded_by = $row['uploaded_by'];
		$privacy = $row['privacy'];
		$date_uploaded = $row['date_uploaded'];
		$thumbnail = $row['thumbnail'];
		$video_id = $row['video_id'];
		$deleted = $row['deleted'];
	mysqli_query($conn1,"DELETE FROM videos WHERE video_id ='$videoid'") ;
	header("Location: my_videos.php");
	}
}?>
