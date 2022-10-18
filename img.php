<?php
	$con=mysqli_connect("localhost","root","","test");
	if(isset($_FILES['fileupload']))
	{
		$filename=$_FILES['fileupload'];
		if(!file_exists("images"))
		{
			mkdir("images");
		}
		$target_dir="images/";
		$target_file=$target_dir.basename($_FILES["fileupload"]["name"]);
		$tmp=explode(".",$_FILES["fileupload"]["name"]);
		$newfilename=rand(35000,3500000).'.'.end($tmp);
		move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_dir.$newfilename);
		$sql="INSERT INTO `imag`(`image`) VALUES ('$newfilename')";
		$res=mysqli_query($con,$sql);
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container mt-3">
		<form action="img.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileupload" class="form-control"></br>
			<input type="submit" class="btn btn-primary w-100" value="save">
		</form>
		<table class="table table-sm table-bordered text-center">
		<tr>
			<th>image
		<?php
			$con=mysqli_connect("localhost","root","","test");
			$sql="SELECT * FROM `imag`";
			$res=mysqli_query($con,$sql);
			while($row=mysqli_fetch_assoc($res))
			{
		?>
		<tr>
			<td><img src="<?php echo "images/".$row['image'];?>" height="100" width="100">
		<?php
			}
		?>
		</table>
		</div>
	</body>
</html>
