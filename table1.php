<?php
	$con =mysqli_connect("localhost","root","","clg");
	if(isset($_POST['txtsnm']))
	 {
		$snm =$_POST['txtsnm'];
		$cn =$_POST['txtcnm'];
		$cno =$_POST['txtcno'];
		$sql =" INSERT INTO `student_data` (`stud_name`,`course`,`contact`) VALUES ('$snm','$cn','$cno')";
		mysqli_query($con,$sql);
	 }
?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container mt-3">
		<form action="table.php" method="POST">
			<input type="text" name="txtsnm" class="form-control" placeholder="Enter Student name" required></br>
			<input type="text" name="txtcnm" class="form-control" placeholder="Enter course" required></br>
			<input type="text" name="txtcno" class="form-control" placeholder="Enter contact no" required></br>
			<input type="submit" class="btn btn-success w-100" value="save">
		</form>
		<table class="table table-bordered text-center">
			<tr>
				<th>id
				<th>stud_name
				<th>course
				<th>contact
				<th>action
				<?php
					$sql = " SELECT * FROM `student_data`";
					$res= mysqli_query($con,$sql);
					$i=1;
					while($row=mysqli_fetch_assoc($res))
					{
				?>
			<tr>
				<td><?php echo $i; ?>
				<td><?php echo $row['stud_name']; ?>
				<td><?php echo $row['course']; ?>
				<td><?php echo $row['contact']; ?>
				<td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-snm="<?php echo $row['stud_name']; ?>" data-bs-cnm="<?php echo $row['course']; ?>" data-bs-cno="<?php echo $row['contact']; ?>"  data-bs-id="<?php echo $row['id']; ?>">Update</button>
				<?php
					$i++;
					}
				?>
		</table>
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Update Record</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
			<form action="table.php" method="POST">
				<div class="mb-3">
					<input type="text" name="txtnm" class="form-control"  placeholder="Enter student name" id="nm">
					<input type="text" name="txtid" class="form-control" id="id" hidden>
				</div>
				<div class="mb-3">
					<input type="text" name="txtcor" class="form-control" placeholder="Enter course" id="cor">
				</div>
				<div class="mb-3">
					<input type="text" name="txtcon" class="form-control" placeholder="Enter contact" id="con">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary w-100">Update</button>
				</div>
			</form>
				</div>
			</div>      
		</div>	
	</div>
	</body>
</html>
<script>
	const exampleModal = document.getElementById('staticBackdrop')
	exampleModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const snm = button.getAttribute('data-bs-snm')
    const cnm = button.getAttribute('data-bs-cnm')
	const cno = button.getAttribute('data-bs-cno')
    const id = button.getAttribute('data-bs-id')
    const modalTitle = exampleModal.querySelector('.modal-title')
	modalTitle.textContent = `Update Record ID ${id}`
    document.getElementById('nm').value = snm;
	document.getElementById('cor').value = cnm;
	document.getElementById('con').value = cno;
	document.getElementById('id').value = id;
})
</script>
<?php
	if(isset($_POST['txtid']))
	{
		$id = $_POST['txtid'];
		$snm = $_POST['txtnm'];
		$cnm = $_POST['txtcor'];
		$cno = $_POST['txtcon'];
		$sql = "UPDATE `student_data` SET `stud_name`='$snm',`course`='$cnm' ,`contact`='$cno' WHERE `id`='$id'";
		mysqli_query($con,$sql);
	}
?>
