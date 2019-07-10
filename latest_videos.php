<?php 
include('./includes/header.php');
?>
<br><br>
<h2>Latest videos</h2>
<?php
$get_videos = mysqli_query($conn1,"SELECT * FROM videos ORDER by id DESC");
if(mysqli_num_rows($get_videos)==0){
	echo "There are no videos yet!!";
}else{
	//echo "There are some videos";
	while($row = mysqli_fetch_assoc($get_videos)){
		$id = $row['id'];
		$video_title = $row['video_title'];
		$video_description = $row['video_description'];
		$video_keywords = $row['video_keywords'];
		$uploaded_by = $row['uploaded_by'];
		$privacy = $row['privacy'];
		$date_uploaded = $row['date_uploaded'];
		$views = $row['views'];
		$video_id = $row['video_id'];
		$thumbnail = $row['thumbnail'];
		$deleted = $row['deleted'];
		?>
		
		<div class="myvideosdiv" style="height: 100px;">
			<div style="float: left;">
			<a href="<?php echo $uploaded_by;?>"><img src="data/users/videos/thumbnails/<?php echo $thumbnail;?>" width="150px;" height="80px;"></a>
			</div>
			<h2 style="float: left;"><?php echo $video_title;?></h2><br><br><br><br>
			<div class="myvideosdiv_desc"><?php echo $video_description;?></div>
			Views: <?php echo $views;?>
		<div><a href="watch.php?videoid=<?php echo $video_id;?>">Watch video</a></div>
		</div><br><br>
		<?php
	}
}
?>