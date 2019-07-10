<?php
include('./includes/header.php');
?>
<br ><br >

<?php

$getvideos = mysqli_query($conn1,"SELECT * FROM videos WHERE uploaded_by='$user'");
if(mysqli_num_rows($getvideos)==0){
	echo "you haven't uploaded any videos yet!!";
}else{
	while($row = mysqli_fetch_assoc($getvideos)){
		$title = $row['video_title'];
		$desc = $row['video_description'];
		$keywords = $row['video_keywords'];
		$uploaded_by = $row['uploaded_by'];
		$privacy = $row['privacy'];
		$date_uploaded = $row['date_uploaded'];
		$thumbnail = $row['thumbnail'];
		$video_id = $row['video_id'];
		$deleted = $row['deleted'];
		
		if($deleted=='no'){
		?>
		<div class="myvideosdiv">
			<div style="float: left;">
			<img src="data/users/videos/thumbnails/<?php echo $thumbnail;?>" width="150px;" height="80px;">
			</div>
			<h2 style="float: left;"><?php echo $title;?></h2><br><br><br><br>
			<div class="myvideosdiv_desc"><?php echo $desc;?></div>
			<div class="myvideosdiv_tags"><strong>Tags: </strong><?php echo $keywords;?></div>
			<div><a href="edit_video.php?videoid=<?php echo $video_id;?>">Edit video</a> | <a href="upload_thumbnail.php?videoid=<?php echo $video_id;?>">Edit Thumbnail</a> | <a href="delete_video.php?videoid=<?php echo $video_id;?>">Delete video</a></div>
		
		</div>
		
		<?php
		}
		else{
			echo "";
		}
	}
}

?>