<?php
$conn1=mysqli_connect("localhost","root","","momentube");
if($conn1)
{
	echo "<script>console.log('Connection ok');</script>";
}else{
	echo "<script>console.log('Connection not ok');</script>";
}
?>