<style>
input[type=text], select {
    width: 26%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
	background-color: lightgray;
	color: black;
    box-sizing: border-box;
}

input[type=submit] {
    width: 26%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=password] {
    width: 26%;
    background-color: lightgray;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 4px;
    background-color: #f2f2f2;
    padding: 4px;
}
</style>
<?php
include('./includes/header.php');
// If form submitted, insert values into the database.
if (isset($_POST['username']) && ($_POST['password'])){
        // removes backslashes
	/*$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($conn1,$username);
	$password1 = stripslashes($_REQUEST['password']);
	$password1 = mysqli_real_escape_string($conn1,$password1);*/
	$username = strip_tags($_POST['username']);
	$password1 = strip_tags($_POST['password']);
	//Checking is user existing in the database or not
    $query = "SELECT username FROM users WHERE username='$username'";
	$result = mysqli_query($conn1,$query);
	
	$numrows = mysqli_num_rows($result);
	//echo $rows;
        if($numrows==1){
	    //$_SESSION['username'] = $username;
		 $salt1 = "francis";
   $salt1 = md5($salt1);
   $salt2 = "cookie";
   $salt2 = md5($salt2);
   $salt3 = "php";
   $salt3 = md5($salt3);
   $password1 = $salt1.$password1.$salt3;
   $password1 = md5($password1.$salt2);
  $check_password = mysqli_query($conn1,("SELECT password FROM users WHERE password='$password1' && username='$username'"));
  while ($row = mysqli_fetch_assoc($check_password)) {
   $password_db = $row['password'];
   
   if ($password_db == $password1) {
     $_SESSION['username'] = $username;
    header("Location: members.php");
	}
    }
	}else{//user doesn't exists
	echo "<h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a>";
	}
}
?>
<br><br><br><br>
<center><h2 style="color:darkgreen;"><font size="15">LOGIN</font></h2>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required /><br><br>
<input type="password" name="password" placeholder="Password" required /><br>
<input name="submit" type="submit" value="Login" /><br>
<input name="reset" type="reset"/>
</form>
<p><center>Not registered yet?</center> <a href="join.php">Register Here</a></p></center>

