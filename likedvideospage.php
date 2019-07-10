<?php
include ( './includes/header.php' );
?>
<h2>Liked Videos<h2/>
<?php
	$sql = "SELECT * FROM videos WHERE type='like'";
	$check = mysqli_query($conn1,$sql);
	if(mysqli_num_rows($check)==0){
		echo "Dear ".$user." you haven't liked any videos!";
	}else{

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
		$thumbnail = $row['thumbnail'];
		$deleted = $row['deleted'];
		$type = $row['type'];
		
	?>
	<!--<br><br>
		<video class="videoclass" width="200" height="100" controls>
		<source src="<?php echo $videosrc; ?>" type="video/mp4">
		{message: Your browser doesn't support the HTML5 video tag }
		</video>-->
		<div class="myvideosdiv" style="height: 100px;">
			<div style="float: left;">
			<img src="data/users/videos/thumbnails/<?php echo $thumbnail;?>" width="150px;" height="80px;">
			</div>
			<h2 style="float: left;"><?php echo $video_title;?></h2><br><br><br><br>
			<div class="myvideosdiv_desc"><?php echo $video_description;?></div>
			Views: <?php echo $views;?>
		
		</div><br><br>
<?php
	}
	}

?>