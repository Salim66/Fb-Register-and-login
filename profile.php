
<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<?php 

	// Session Start
	session_start();

	// Session Check after logout profile
	if ( !isset($_SESSION['id']) AND !isset($_SESSION['uname']) AND !isset($_SESSION['email']) ) {

		// Redirect user profile
		header("location:login.php");
	}


	// Logout System
	if ( isset( $_GET['logout'] ) AND $_GET['logout'] == 'user_logout' ) {

		$remember = "rem_log_in"."[".$_SESSION['id']."]";
		
		// Session destroy
		session_destroy();

		// cookie setup
		setcookie('relog', '', time() - (60*60*24*365*10));

		// remember login id
		setcookie($remember, $_SESSION['id'], time() + (60*60*24*265*10));

		// Redirect user profile
		header("location:login.php");
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['name'] ?></title>
	<!-- CSS LINK -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">
	
	

	<div class="wrap shadow">
		<div class="card bg-secondary shadow">
			<div class="card-header">
				<h2><a class="btn btn-sm btn-primary ml-auto d-table" href="users.php">All Users</a></h2>
				<h1 class="text-white"><?php echo $_SESSION['name'] ?></h1>
			</div>
			<div class="card-body">
				<img style="width: 200px;height: 200px;border-radius: 50%;border: 10px solid #DA9C4AFF;margin: auto;display: block;" class="shadow" src="photos/users/<?php echo $_SESSION['photo'] ?>" alt="">
				<br>
				<br>
				<br>
				<table class="table table-bordered">
					<tr>
						<td>Name</td>
						<td><?php echo $_SESSION['name'] ?></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><?php echo $_SESSION['uname'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['email'] ?></td>
					</tr>
					<tr>
						<td>Cell</td>
						<td><?php echo $_SESSION['cell'] ?></td>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				<a class="text-warning" href="?logout=user_logout">Logout</a>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>


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