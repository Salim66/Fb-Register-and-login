
<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<?php 

	// Session start
	session_start();

	// Session Check after login profile not back to logout before login page
	if ( isset($_SESSION['id']) AND isset($_SESSION['email']) AND isset($_SESSION['uname']) ) {
		
		// Redirect user profile
		header("location:profile.php");
	}

	/**
	 * Relog by cookie
	 */
	if ( isset($_COOKIE['relog']) ) {
		
		// cookie user id
		$user_id = $_COOKIE['relog'];

		// select query from database
		$sql = "SELECT * FROM users WHERE id='$user_id'";
		$data = $connection -> query($sql);
		$login_user = $data -> fetch_assoc();

		// session data
		$_SESSION['id'] = $login_user['id'];
		$_SESSION['name'] = $login_user['name'];
		$_SESSION['uname'] = $login_user['uname'];
		$_SESSION['email'] = $login_user['email'];
		$_SESSION['cell'] = $login_user['cell'];
		$_SESSION['photo'] = $login_user['photo'];

		// Redirect user profile
		header("location:profile.php");
	}

 ?>

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

		if ( isset($_POST['login']) ) {
			
			// Get data
			$eu = $_POST['eu'];
			$pass = $_POST['password'];

			// validation of data
			if ( empty($eu) || empty($pass) ) {
				$mess = "<p class='alert alert-danger'>All fields are required !<button class='close' data-dismiss='alert'>&times</button></p>";
			} else {
				// query database
				$sql = "SELECT * FROM users WHERE uname='$eu' || email='$eu'";
				$data = $connection -> query($sql);
				$login_user = $data -> fetch_assoc();

				/**
				 *  Username or email validation
				 */
				if ( $data -> num_rows == 1 ) {
					
					// Password varification
					if ( password_verify($pass, $login_user['password']) ) {
						
						// Session Data
						$_SESSION['id'] = $login_user['id'];
						$_SESSION['name'] = $login_user['name'];
						$_SESSION['uname'] = $login_user['uname'];
						$_SESSION['email'] = $login_user['email'];
						$_SESSION['cell'] = $login_user['cell'];
						$_SESSION['photo'] = $login_user['photo'];

						// Cookie setup
						setcookie('relog', $login_user['id'], time() + (60*60*24*365*10));

						// Redirect user profile
						header("location:profile.php");

					} else {
						$mess = "<p class='alert alert-danger'>Wrong password !<button class='close' data-dismiss='alert'>&times</button></p>";
					}

				} else {
					$mess = "<p class='alert alert-danger'>Wrong username | email !<button class='close' data-dismiss='alert'>&times</button></p>";
				}
			}

		}


	 ?>

	<div class="container mt-lg-5">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"  class="myform" class="form-group">

		<div class="row">
			<div class="col">
				<div class="mx-auto">
					<!-- recent login start -->

					<?php 

						if ( isset($_COOKIE['rem_log_in']) ) :
							//get data
							$remember_data = $_COOKIE['rem_log_in'];

							foreach ($remember_data as $value) :

								// data query
								$sql = "SELECT * FROM users WHERE id='$value'";
								$data = $connection -> query($sql);
								$login_user = $data -> fetch_assoc();


					 ?>

					 <div class="car shadow w-25 mx-auto" style="margin-top:3%; margin-left: 0%">
					 	<a href="?triger=<?php echo $login_user['id'];?>">
					 		<div class="card-body w-25">
					 			<img style="max-height: 100px; max-width:100px; " src="photos/users/<?php echo $login_user['photo'];?>" alt="">
					 		</div>
					 	</a>
					 						
					 	<div class="card-footer">
					 		<a href="?task=<?php echo $login_user['id'];?>">Clear</a> <?php echo $login_user['uname'];?>
					 	</div>
					 </div>

					<?php endforeach; endif; ?>
					<!-- recent login end -->
					

					<?php 
						/**
						 * recentw user relogin system
						 */

						if ( isset($_GET['triger']) ) {
							//get data url
							$relog_id = $_GET['triger'];

							// select relog data from url
							$sql = "SELECT * FROM users WHERE id='$relog_id'";
							$data = $connection -> query($sql);
							$relog_user = $data -> fetch_assoc();

							// session create by cookie id
							$_SESSION['id'] = $relog_user['id'];

							// redirect user to profile page
							header("location:relog_user_profile.php");
						}
					 ?>


					 <!-- recent login distryf -->
					 <?php 

					 	if ( isset($_GET['task']) ) {
					 		$clear_id = $_GET['task'];

					 		// remember clear id
					 		$remember = "rem_log_in"."[".$clear_id."]"; 

					 		// cookie distray
					 		setcookie($remember, '', time() - (60*60*24*365*10));

					 		// Redirect user clear account
					 		header('location:login.php');
					 	}

					  ?>
				</div>
			</div>


			<div class="jumbotron bg-secondary shadow w-50 m-auto">
				
				<?php 

					if ( isset($mess) ) {
						
						echo $mess;

					}

				 ?>

				<h3 class="mb-3 font-weight-bold text-warning">Log In</h3>
				<hr class="border-warning">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text bg-secondary text-white">Email / Username</div>
							</div>
							<input name="eu" class="form-control" style="background-color: #6C757D" type="text">
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
						<!-- <button name="upload" class="bg-dark" style="padding: 6px; color: #fff;">Upload</button> -->
						<input name="login" class="btn btn-dark text-light btn-sm" type="submit" value="Sign Up">
					</div>
				<div class="registerss">
					<a class="text-warning" href="register.php">Create an account</a>
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