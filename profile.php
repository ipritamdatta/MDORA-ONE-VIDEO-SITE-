.tag{
	margin:50px;
}

<div align="center">
	<img style="float:right;"src="./images/giphy4.gif" width="250" height="256"/> 
</div>
<?php
include('./includes/header.php');
$username = $_GET['u'];
$query = ("SELECT * FROM users WHERE username='$username'");
$result = mysqli_query($conn1,$query);
$count = mysqli_num_rows($result);
if($count == 1){
	while($row = mysqli_fetch_assoc($result)){
		$id = $row['id'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$username = $row['username'];
		$email = $row['email'];
		$password = $row['password'];
		$date_of_birth = $row['dob'];
		
		echo "<font size=4><h2>$username's Profile</h2><br />
		Name: $firstname $lastname <br />
		Email: $email</font>
		";
		echo "<br><br>";
		?>
		
		<?php 
		
	}
}else{
	header("Location: index.php");
}
?> 