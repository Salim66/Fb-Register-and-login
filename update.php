
<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $fdata -> id; ?></title>
	<!-- CSS LINK -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">
	
	<?php 

		// Get data url
		$id = $_GET['id'];


		$mess = '';
		if ( isset($_POST['update']) ) {
			// Get Data
			$name = $_POST['name'];
			$uname = $_POST['uname'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];

			// Photo Receive
			$new_photo = $_FILES['new_photo']['name'];
			$old_photo = $_POST['old_photo'];

			if ( empty($new_photo) ) {
				$photo_name = $old_photo;
			}else{
				// new photo upload
				$data = fileUpload($_FILES['new_photo'], $location = 'photos/users/');
				$photo_name = $data['file_name'];
			}



			// Validate database
			if ( empty($name) || empty($uname) || empty($email) || empty($cell) ) {
				$mess = "<p class='alert alert-danger'>All fields are required !<button class='close' data-dismiss='alert'>&times;</button></p>";

			}elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
				$mess = "<p class='alert alert-warning'>Invalid email format !<button class='close' data-dismiss='alert'>&times;</button></p>";

			}else {

				// Upload single user registration data
				$sql = "UPDATE users SET name='$name', uname='$uname', email='$email', cell='$cell', photo='$photo_name' WHERE id='$id'";
				$connection -> query($sql);

				$mess = "<p class='alert alert-success'>Update Data Successfully !<button class='close' data-dismiss='alert'>&times;</button></p>";
				
				
			} 
			
		}

		// Old data
		$sql = "SELECT * FROM users WHERE id='$id'";
		$data = $connection -> query($sql);
		$fdata = $data -> fetch_object();


	 ?>

	<div class="container mt-lg-5">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="myform" class="form-group">
			<div class="jumbotron bg-secondary shadow w-50 m-auto">
				<a class="btn btn-sm btn-primary ml-auto d-table" href="users.php">Show Table</a>
				<?php 

					if ( isset($mess) ) {
						
						echo $mess;

					}

				 ?>
				<h3 class="mb-3 font-weight-bold text-warning">Update <?php echo $fdata -> name; ?> Data</h3>
				<hr class="border-warning">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Name</div>
							</div>
							<input name="name" class="form-control" style="background-color: #6C757D" value="<?php echo $fdata -> name; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Username</div>
							</div>
							<input name="uname" class="form-control" style="background-color: #6C757D" value="<?php echo $fdata -> uname; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Email</div>
							</div>
							<input name="email" class="form-control" style="background-color: #6C757D" value="<?php echo $fdata -> email; ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Cell</div>
							</div>
							<input name="cell" class="form-control" style="background-color: #6C757D" value="<?php echo $fdata -> cell; ?>" type="text">
						</div>
					</div>
					<div class="form-group ">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Photo</div>
							</div>
							<img style="width: 60px; height: 60px;" src="photos/users/<?php echo $fdata -> photo; ?>" alt="">
							<!-- old photo receive -->
							<input name="old_photo" class="form-control" style="background-color: #6C757D; height: 60px;" value="<?php echo $fdata -> photo; ?>" type="hidden">
							<!-- new photo receive -->
							<input name="new_photo" class="form-control" style="background-color: #6C757D; height: 60px;" type="file">
						</div>
					</div>
					<div class="form-group">
						<!-- <button name="upload" class="bg-dark" style="padding: 6px; color: #fff;">Upload</button> -->
						<input name="update" class="btn btn-dark text-warning btn-sm" type="submit" value="Update Data">
					</div>
			</div>
		</form>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>s


	<!-- JS LINK -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		
		$('input').click(function(){
			$(this).css('background-color','#939393FF').css('color','#000000');
		});

	</script>
</body>
</html>