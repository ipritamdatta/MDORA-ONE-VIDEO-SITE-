
<style>
.textdesign{
	float: left; 
	margin: 0px 0px 0px 50px; 
	border: 10px groove #ddd;
	background-color: f2f2f2;
	padding: 10px;
	min-height: 80px;
	width: 500px;
}
.h2class{
	color: darkblue;
}
.viewstyle{
	float: left; 
	margin: 0px 0px 0px 50px; 
	border: 10px groove #ddd;
	background-color: darkorange;
	padding: 10px;
	min-height: 20px;
	width: 500px;
	font-size: 15px;
	font-width: bold;
}
.commentstyle{
	float:left; 
	margin: 0px 0px 0px 50px; 
	border: 10px groove #ddd;
	background-color:#FFF;;
	padding: 10px;
	min-height: 20px;
	width: 1172px;
	font-size: 15px;
	font-width: bold;
}
.postcommentstyle{
	float:left; 
	margin: 0px 0px 0px 50px; 
	background-color:lightgreen;
	padding: 10px;
	min-height: 20px;
	width: 1190px;
	font-size: 15px;
	font-width: bold;
}
.ratingstyle{
	
	margin: 0px 0px 0px 50px; 
	background-color:hsla(89, 43%, 51%, 0.3);
	padding: 10px;
	min-height: 20px;
	width: 1190px;
	font-size: 15px;
	font-width: bold;
	
}

</style>
<?php
include('./includes/header.php');

$videoid = $_GET['videoid'];

$check = mysqli_query($conn1,"SELECT * FROM featured WHERE video_id='$videoid'");
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
	$featuredrc = $row['file_location'];//featuredrc is for file location by pritam
	
	$newviews = $views+1;
	$updateviews = mysqli_query($conn1,"UPDATE featured SET views='$newviews' WHERE video_id='$videoid'");
	}
	?>
	
	<hr><center><h1>Title:  <?php echo $video_title;?></h1></center><hr>
<div style="float: left; margin: 0px 0px 0px 50px;">
<center><video class="videoclass" width="623" height="431" controls><?php //623/431this 16/9 aspect ratio by pritam?>
<source src="<?php echo $featuredrc; ?>" type="video/mp4">
{message: Your browser doesn't support the HTML5 video tag }
</video></center>
</div>
<h1 class="h2class" align= "center"><strong>DETAILS</strong></h1>
<!--Now pritam will work on description -->
<div class="textdesign">
	<p><strong>DESCRIPTION:</strong></p>
	<?php echo $video_description; ?>
</div>
<!--Now pritam will work on keywords -->
<div class="textdesign">
	<p><strong>KEYWORDS:</strong></p>
	<?php echo $video_keywords; ?>
</div>
<!--Now pritam will work on views -->
<div class="viewstyle">
<strong>TOTAL VIEWS:</strong>
<strong><?php echo $views; ?></strong>
</div>

	<?php
}else{
	//otherwise
	header("Location: index.php");
	
}
?>
