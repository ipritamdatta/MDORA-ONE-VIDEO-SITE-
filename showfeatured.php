
<?php 
include('./includes/header.php');
?>
<br><br>
<h2>featured videos</h2>
<?php
$get_featured = mysqli_query($conn1,"SELECT * FROM featured");
if(mysqli_num_rows($get_featured)==0){
	echo "There are no featured yet!!";
}else{
	//echo "There are some featured";
	while($row = mysqli_fetch_assoc($get_featured)){
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
		
		<div class="myfeatureddiv" style="margin-left: 125px;">
			<div style="float: left;">
			<a href="<?php echo $uploaded_by; ?>"><img src="data/users/featured/thumbnails/<?php echo $thumbnail;?>" width="200px;" height="100px;"></a>
			</div>
			<h2 style="float: left;"><?php echo $video_title;?></h2><br><br><br><br>
			<div class="myfeatureddiv_desc"><?php echo $video_description;?></div>
			Views: <?php echo $views;?>
			<div><a href="watchfeatured.php?videoid=<?php echo $video_id;?>"><h3>Watch video</h3></a></div>
		</div><br><br>
		<?php
	}
}
?>