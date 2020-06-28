
<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- CSS LINK -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">
	
	<?php 

		$mess[] = '';
		if ( isset($_POST['register']) ) {
			// Get Data
			$name = $_POST['name'];
			$uname = $_POST['uname'];
			$email = $_POST['email'];
			$cell = $_POST['cell'];

			// user name check
			$user_name_check = unique($connection, 'users', 'uname', $uname);

			// email account check
			$email_check = unique($connection, 'users', 'email', $email);

			// cell  check
			$cell_check = unique($connection, 'users', 'cell', $cell);


			// hash password
			$password = $_POST['password'];
			$hash_password = password_hash($password, PASSWORD_DEFAULT);

			// confirm password
			$cpassword = $_POST['cpassword'];

			if ( $password == $cpassword ) {
				$password_check = true;
			} else {
				$password_check = false;
			}


			
			// Value check
			if ( $user_name_check == false ) {
				$mess[] = "<p class='alert alert-warning'>Username already exists !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{
				$mess[] = '';
			}


			if ( $email_check == false ) {
				$mess[] = "<p class='alert alert-warning'>Email already exists !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{
				$mess[] = '';
			}
			
			if ( $cell_check == false ) {
				$mess[] = "<p class='alert alert-warning'>Cell already exists !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{
				$mess[] = '';
			}



			// Validate database
			if ( empty($name) || empty($uname) || empty($email) || empty($cell) || empty($password) ) {
				$mess[] = "<p class='alert alert-danger'>All fields are required !<button class='close' data-dismiss='alert'>&times;</button></p>";

			}elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
				$mess[] = "<p class='alert alert-warning'>Invalid email format !<button class='close' data-dismiss='alert'>&times;</button></p>";

			}elseif( $password_check == false ){
				$mess[] = "<p class='alert alert-warning'>Password not match !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}else {
				
				if ( $user_name_check == true AND $email_check == true AND $cell_check == true ) {
					
					// photo upload
					$data = fileUpload($_FILES['photo'], $location = 'photos/users/');
					$photo_name = $data['file_name'];


					if ( $data['status'] == 'yes' ) {

						// user registration data insert database
						$sql = "INSERT INTO users(name, uname, email, cell, password, photo) VALUES('$name','$uname','$email','$cell','$hash_password','$photo_name')";
						$data = $connection -> query($sql);

						// set cookie
						setMSG("User Registration Successful");

						header("location:register.php");

					} else {
						$mess[] = "<p class='alert alert-warning'>Invalid image format !<button class='close' data-dismiss='alert'>&times;</button></p>";
					}
				}
				
				
			} 
			
		}


	 ?>

	<div class="container mt-lg-5">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="myform" class="form-group">
			<div class="jumbotron bg-secondary shadow w-50 m-auto">
				<?php 

					if ( count($mess) > 0 ) {
						
						foreach ($mess as $key) {
							echo $key;
						}

					}
					getMSG();

				 ?>
				<h3 class="mb-3 font-weight-bold text-warning">User Registration</h3>
				<hr class="border-warning">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Name</div>
							</div>
							<input name="name" class="form-control" style="background-color: #6C757D" value="<?php echo old('name'); ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Username</div>
							</div>
							<input name="uname" class="form-control" style="background-color: #6C757D" value="<?php echo old('uname'); ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Email</div>
							</div>
							<input name="email" class="form-control" style="background-color: #6C757D" value="<?php echo old('email'); ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Cell</div>
							</div>
							<input name="cell" class="form-control" style="background-color: #6C757D" value="<?php echo old('cell'); ?>" type="text">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Password</div>
							</div>
							<input name="password" class="form-control" style="background-color: #6C757D" type="password">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Confirm Password</div>
							</div>
							<input name="cpassword" class="form-control" style="background-color: #6C757D" type="password">
						</div>
					</div>
					<div class="form-group ">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Photo</div>
							</div>
							<input name="photo" class="form-control" style="background-color: #6C757D"  type="file">
						</div>
					</div>
					<div class="form-group">
						<!-- <button name="upload" class="bg-dark" style="padding: 6px; color: #fff;">Upload</button> -->
						<input name="register" class="btn btn-dark text-light btn-sm" type="submit" value="Sign Up">
					</div>
				<div class="log-in">
					<a class="text-warning" href="login.php">Log in now</a>
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