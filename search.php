<?php
include ( './includes/header.php' );
if(isset($_POST['search'])){
$search = mysqli_real_escape_string($conn1,trim($_POST['search']));
$find_videos = mysqli_query($conn1,"SELECT * FROM videos WHERE video_keywords LIKE '%$search%'") or die("couldn't search!");
if(mysqli_num_rows($find_videos)==0){
	echo "<center>Your result for <strong>".$search."</strong> is not available</center>";
}else{
	echo "<center>Search result for <strong>".$search."</strong> is given below</center>";
while($row=mysqli_fetch_assoc($find_videos)){
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
			<a href="<?php echo $uploaded_by; ?>"><img src="data/users/videos/thumbnails/<?php echo $thumbnail;?>" width="150px;" height="80px;"></a>
			</div>
			<h2 style="float: left;"><?php echo $video_title;?></h2><br><br><br><br>
			<div class="myvideosdiv_desc"><?php echo $video_description;?></div>
			Views: <?php echo $views;?>
			<div><a href="watch.php?videoid=<?php echo $video_id;?>">Watch video</a></div>
		</div><br><br>
		<?php
	}
}}else{
	echo "";
}
?>