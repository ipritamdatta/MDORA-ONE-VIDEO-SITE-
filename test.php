<?php
//here pritam will calculate likes

$total_width = 180;
$green = 0;
$red = 0;
$get_likes = mysqli_query("SELECT * FROM ratings WHERE videoid='$videoid' AND type='like'");
$num_of_likes = mysqli_num_rows($get_likes);

$get_dislikes = mysqli_query("SELECT * FROM ratings WHERE videoid='$videoid' AND type='dislike'");
$num_of_dislikes = mysqli_num_rows($get_dislikes);

$total_num = $num_of_likes + $num_of_dislikes;

$width_of_one = $total_width / $total_num;
$green = $width_of_one * $num_of_likes;
$red = $width_of_one * $num_of_dislikes;

echo $num_of_likes;

2 likes AND 0 dislikes
green = 100%;
red= 0;
1 like AND 1 dislike
green = 50%
red = 50%

//code
if red == 0 then 
	set green = 100
else if green == 0 then
	set red = 100
else if red == 1 AND green == 1 then
	set red and green = 50
	

	180 px == 100%
	1% = 18px
	
	3 likes 1 dislikes
	
	
	3 + 1 = 4
	
	4 = total = 100% = 180px
	
	180 / 4 = 45px * 3 = //num of pixels taken up by likes, remainder is amount of space taken up by dislikes

	
	
	?>