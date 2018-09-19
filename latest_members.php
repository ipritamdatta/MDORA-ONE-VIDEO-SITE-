<?php 
include('./includes/header.php');
?>
<br><br>
<h1>Recent Members</h1>
<?php
$get_users = mysqli_query($conn1,"SELECT * FROM users ORDER by date_joined DESC");
if(mysqli_num_rows($get_users)==0){
	echo "There are no users yet!!";
}else{
	//echo "There are some videos";
	while($row = mysqli_fetch_assoc($get_users)){
		$id = $row['id'];
		$username = $row['username'];
		//echo "<center><h2>";echo $username."<br>";echo "</h2></center>";
		echo "<center><h2><img src='./images/default.jpg' width='35px' height='30px'/><a href='profile.php?u=$username'>$username</a></center></h2>";
		echo "<br>";
	}
}
?>