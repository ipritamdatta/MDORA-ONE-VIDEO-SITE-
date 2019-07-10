<style>
input[type=text], select {
    width: 26%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	background-color: lightyellow;
    color: black;
}
input[type=password] {
    width: 26%;
    background-color: lightblue;
    color: black;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
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
include ( './includes/header.php' );
$error = "";
if (@$_POST['register']) {
 /*$firstname = stripslashes($_REQUEST['firstname']);
 $firstname = mysqli_real_escape_string($conn1,$firstname); 
 $lastname = stripslashes($_REQUEST['lastname']);
 $lastname = mysqli_real_escape_string($conn1,$lastname);
 $username = stripslashes($_REQUEST['username']);
 $username = mysqli_real_escape_string($conn1,$username); 
 $email = stripslashes($_REQUEST['email']);
 $email = mysqli_real_escape_string($conn1,$email);
 $password1 = stripslashes($_REQUEST['password']);
 $password1 = mysqli_real_escape_string($conn1,$password1);
 $password2 = stripslashes($_REQUEST['passwordrepeat']);
 $password2 = mysqli_real_escape_string($conn1,$password2);*/
 $date = date("m d Y");
 $firstname = strip_tags($_POST['firstname']);
 $lastname = strip_tags($_POST['lastname']);
 $username = strip_tags($_POST['username']);
 $email = strip_tags($_POST['email']);
 $password1 = strip_tags($_POST['password']);
 $password2 = strip_tags($_POST['passwordrepeat']);
 $day = strip_tags($_POST['day']);
 $month = strip_tags($_POST['month']);
 $year = strip_tags($_POST['year']);
 $dob = "$day/$month/$year";
 
 if ($firstname == "") {
  $error = "Firstname cannot be left empty.";
 }
 else if ($lastname == "") {
  $error = "Lastname cannot be left empty.";
 }
 else if ($username == "") {
  $error = "Username cannot be left empty.";
 }
 else if ($email == "") {
  $error = "Email cannot be left empty.";
 }
 else if ($password1 == "") {
  $error = "Password cannot be left empty.";
 }
 else if ($password2 == "") {
  $error = "Repeat Password cannot be left empty.";
 }
 else if ($day == "") {
  $error = "The day you were born cannot be left empty.";
 }
 else if ($month == "") {
  $error = "The month you were born cannot be left empty.";
 }
 else if ($year == "") {
  $error = "The year you were born cannot be left empty.";
 }
 //Check the username doesn't already exist
 $check_username = mysqli_query($conn1,("SELECT username FROM users WHERE username='$username'"));
 $numrows_username = mysqli_num_rows($check_username);
 if ($numrows_username != 0) {
  $error = 'That username has already been registered.';
 }
 else
 {
  $check_email = mysqli_query($conn1,("SELECT email FROM users WHERE email='$email'"));
 $numrows_email = mysqli_num_rows($check_email);
 if ($numrows_email != 0) {
  $error = 'That email has already been registered.';
 }
 else
 {
   $salt1 = "francis";
   $salt1 = md5($salt1);
   $salt2 = "cookie";
   $salt2 = md5($salt2);
   $salt3 = "php";
   $salt3 = md5($salt3);
   $password1 = $salt1.$password1.$salt3;
   $password1 = md5($password1.$salt2);
   $password2 = $salt1.$password2.$salt3;
   $password2 = md5($password2.$salt2);
 if ($password1 != $password2) {
 $error = 'The passwords don\'t match!';
 }
 else
 {
 //Register the user
 $register = mysqli_query($conn1,("INSERT INTO users VALUES('','$firstname','$lastname','$username','$email','$password1','$dob','no','','$date')"));
 die('Regsitered successfully!');
 }
 }
 }
}
?>
<div align="center">
<h2 style="color:darkgreen;"><font size="15">Create Your Account</font></h2>
<form action='join.php' method='POST'>
<input type="text" name="firstname" placeholder="Firstname ..." required /><p />
<input type="text" name="lastname" placeholder="Lastname ..." required /><p />
<input type="text" name="username" placeholder="Username ..." required /><p /> 
<input type="text" name="email" placeholder="Email ..." required /><p />
<input type="password" name="password" placeholder="Password ..." required /><p />
<input type="password" name="passwordrepeat" placeholder="Repeat Password ..." required /><p />
<input type="text" name="day" placeholder="Birth day" size='3' maxlength='2' required /><br>
<input type="text" name="month" placeholder="Birth month" size='6' maxlength='2' required /><br>
<input type="text" name="year" placeholder="Birth year" size='4' maxlength='4' required /><p />
<p>*By clicking “Create an account” below, you agree to our terms of service<br> and privacy statement. 
We’ll occasionally send you account related emails.</p>
<input type='submit' name='register' value='Create an Account' /><br>
<input name="reset" type="reset"/>
<?php echo $error; ?>
</form>
</div>
