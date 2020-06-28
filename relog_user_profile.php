
<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<?php 

	//session start
	session_start();

	if ( empty($_SESSION['id']) ) {
		header("location:login.php");
	}

	// receive data from session id
	$user_id = $_SESSION['id'];
	$sql = "SELECT * FROM users WHERE id='$user_id'"; 
	$data = $connection -> query($sql);
	$login_user = $data -> fetch_assoc();

	// get data
	if ( isset($_POST['save']) ) {
		$user_pass = $_POST['pass'];

		if ( empty($user_pass) ) {
			$mess = "<p class='alert alert-warning'>Input field empty !<button class='close' data-dismiss='alert'>&times;</button></p>";
		}else {

			// verify user password
			if (password_verify($user_pass, $login_user['password'])) {
				
				// session data
				$_SESSION['name'] = $login_user['name'];
				$_SESSION['uname'] = $login_user['uname'];
				$_SESSION['email'] = $login_user['email'];
				$_SESSION['cell'] = $login_user['cell'];
				$_SESSION['photo'] = $login_user['photo'];

				// cookie setup
				setcookie('relog', $login_user['id'], time() + (60*60*24*365*10));

				// Redirect user to profile page
				header("location:profile.php");
			}else {
				$mess = "<p class='alert alert-warning'>Wrong password, please try again !<button class='close' data-dismiss='alert'>&times;</button></p>";
			}
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $login_user['name'] ?></title>
	<!-- CSS LINK -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">
	
	

	<div class="container mt-lg-5">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"  class="myform" class="form-group">

		<div class="row">
			<div class="col">
				<div class="mx-auto">
					


			<div class="jumbotron bg-secondary shadow w-50 m-auto">
				
				<?php 

					if ( isset($mess) ) {
						
						echo $mess;

					}

				 ?>

				<h3 class="mb-3 font-weight-bold text-warning">Log In</h3>
				<hr class="border-warning">
				<div class="card-body">
						<div class="card-head">
							<h4><?php echo $login_user['name']?></h4>
						</div>
						<form  action="" method="POST" enctype="multipart/form-data">
						<div class = "form-group">
							<img style="width: 200px;height: 200px;border-radius: 50%;border: 10px solid #DA9C4AFF;margin: auto;display: block;" class="shadow" src="photos/users/<?php echo $login_user['photo'] ?>" alt="">
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text bg-secondary text-white">Password</div>
								</div>
								<input name="pass" class="form-control" style="background-color: #6C757D" type="password">
							</div>
						</div>

						<div class = "form-group">
								
							<input type="submit" class="form-control btn-dark text-light" name="save" value="Login" >
						</div>


						</form>
							
							
					</div>
					<div class="card-footer">
						<a href="login.php" class="text-warning">Not my accound</a>
					</div>
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