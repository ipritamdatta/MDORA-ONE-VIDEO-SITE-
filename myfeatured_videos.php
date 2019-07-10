<?php
include('./includes/header.php');
?>
<br ><br >
<?php

$getfeatured = mysqli_query($conn1,"SELECT * FROM featured WHERE uploaded_by='$user'");
if(mysqli_num_rows($getfeatured)==0){
	echo "you haven't uploaded any featured yet!!";
}else{
	while($row = mysqli_fetch_assoc($getfeatured)){
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
		<div class="myfeatureddiv">
			<div style="float: left;">
			<img src="data/users/featured/thumbnails/<?php echo $thumbnail;?>" width="150px;" height="80px;">
			</div>
			<h2 style="float: left;"><?php echo $title;?></h2><br><br><br><br>
			<div class="myfeatureddiv_desc"><?php echo $desc;?></div>
			<div class="myfeatureddiv_tags"><strong>Tags: </strong><?php echo $keywords;?></div>
			<div><a href="editfeatured_video.php?videoid=<?php echo $video_id;?>">Edit video</a> | <a href="uploadfeaturedthumbnail.php?videoid=<?php echo $video_id;?>">Edit Thumbnail</a> |</div>
		
		</div>
		<?php
		}
		else{
			echo "";
		}
	}
}

?>