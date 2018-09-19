
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
	}
	?>
	
	<hr><center><h1>Title:  <?php echo $video_title;?></h1></center><hr>
<div style="float: left; margin: 0px 0px 0px 50px;">
<center><video class="videoclass" width="623" height="431" controls><?php //this 16/9 aspect ratio by pritam?>
<source src="<?php echo $videosrc; ?>" type="video/mp4">
{message: Your browser doesn't support the HTML5 video tag }
</video></center>
</div>
<h2 class="h2class" align= "center"><strong>DETAILS</strong></h2>
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
//now pritam will check if it is already liked or disliked!
$check_l = mysqli_query($conn1,"SELECT * FROM ratings WHERE videoid='$videoid' AND username='$user'");
if(mysqli_num_rows($check_l) != 0){
	while($rating = mysqli_fetch_assoc($check_l)){
		$videoid_l = $rating['videoid'];//this is just getting the values from the database of videoid
		$type = $rating['type'];
		$user_l = $rating['username'];
		//echo $type;  this echo will show the like on the page
		$d  = "";//pritam wants to get the actual type of the video
		$d2 = "";
		if($type =='like'){
			$d = 'disabled';
		}else{
			$d2 = 'disabled';
		}
		
		if(isset($_POST['like'])){
		mysqli_query($conn1,"UPDATE ratings SET type='like' WHERE videoid='$videoid' AND username='$user'");
		header("Location: watch.php?videoid=$videoid");
	
		}
		if(isset($_POST['dislike'])){
		mysqli_query($conn1,"UPDATE ratings SET type='dislike' WHERE videoid='$videoid' AND username='$user'");
		header("Location: watch.php?videoid=$videoid");
	
		}
	
	}
}else{
	$d  = "";//pritam wants to get the actual type of the video
	$d2 = "";
	
	if(isset($_POST['like'])){
		mysqli_query($conn1,"INSERT INTO ratings VALUES('','$videoid','like','$user')");
		header("Location: watch.php?videoid=$videoid");
	
	}
	if(isset($_POST['dislike'])){
		mysqli_query($conn1,"INSERT INTO ratings VALUES('','$videoid','dislike','$user')");
		header("Location: watch.php?videoid=$videoid");
	
	}
	
}
//here pritam will write comment post code
				
				if(isset($_POST['post_comment'])){
					$comment_text = trim(htmlentities(strip_tags(mysqli_real_escape_string($conn1,$_POST['write_comment']))));
					$date_commented = date("d F Y"); // 23 March 2018
					
					mysqli_query($conn1,"INSERT INTO comments VALUES ('','$user','$comment_text','$date_commented','$videoid')");
				
				}
				
				
//here pritam will calculate likes as ratings
$total_width = 180;
$green = 0;
$red = 0;
$get_likes = mysqli_query($conn1,"SELECT * FROM ratings WHERE videoid='$videoid' AND type='like'");
$num_of_likes = mysqli_num_rows($get_likes);

$get_dislikes = mysqli_query($conn1,"SELECT * FROM ratings WHERE videoid='$videoid' AND type='dislike'");
$num_of_dislikes = mysqli_num_rows($get_dislikes);

$total_num = $num_of_likes + $num_of_dislikes;

$width_of_one = @($total_width / $total_num);
$green = $width_of_one * $num_of_likes;
$red = $width_of_one * $num_of_dislikes;


?>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<br>
	<?php //Here pritam will create like dislike button
	
	
	?>
				<div class="ratingstyle" style="float: left;  ">
				<div style=" margin: 10px 0px 0px 500px;">
				<form action='watch.php?videoid=<?php echo $videoid;?>' method="POST">
					<input class="button" type='submit' name='like' value='Like'<?php echo $d;?> >
					<input class="button" type='submit' name='dislike' value='Dislike' <?php echo $d2;?> >
				</form>
				</div>
				</div>
				<br/>
				<div title="Ratings"  class="ratingstyle"> 
					<div style="float: left; height: 30px; width: 282px;"></div>
					<div style="float: left; width: <?php echo $total_width;?>;">
					<div title="<?php echo $num_of_likes; ?>likes" style="float: left; width: <?php echo $green;?>px; height: 15px; background-color:green;"></div>
					<div title="<?php echo $num_of_dislikes; ?>dislikes" style="float: left; width: <?php echo $red;?>px; height: 15px; background-color:red;"></div>
				</div></div>
				
				<div class="postcommentstyle"><div style="float: left;">
					WRITE COMMENTS
					<form action="watch.php?videoid=<?php echo $videoid;?>" method="POST">
						<textarea name="write_comment" rows="2" cols="72"></textarea>
						<input type="submit" name="post_comment" value="post comment">
					</form>
				</div></div>
	
	
	
	
	<?php
	//Now pritam will test the comment 
	$select_comment= mysqli_query($conn1,"SELECT * FROM comments WHERE video_id='$videoid' ORDER BY id DESC");
	if(mysqli_num_rows($select_comment) != 0){
		//means the video has some comments
		while($r = mysqli_fetch_assoc($select_comment)){
				$id = $r['id'];
				$user_commented = $r['user_commented'];
				$comment = $r['comment'];
				$date_posted = $r['date_posted'];
				
				?>

				<div class="commentstyle">
				<strong>Comments</strong><br>
					<strong><?php echo "<a href='profile.php?u=$user'>".$user_commented.'</a><sub>'.$date_posted.'</sub>'; 
					echo ' : ';?></strong><?php echo $comment.'<br><br>';?><hr>
				</div>
				<?php
		}
		
	}else{
		//The video has no comments
	}
	
	
}else{
	//otherwise
	header("Location: index.php");
	
}
?>
