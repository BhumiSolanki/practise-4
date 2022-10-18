<?php
	$con = mysqli_connect("localhost","root","","clg");
	$id = $_GET['id'];
	$sql = "DELETE FROM `student_data` WHERE id='$id'";
	mysqli_query($con,$sql);
	header("location:table.php");
?>