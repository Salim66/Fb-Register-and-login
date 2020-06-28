<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<?php 

	// session start
	session_start();

	// session check
	if ( !isset($_SESSION['id']) AND !isset($_SESSION['uname']) AND !isset($_SESSION['email']) ) {
		
		// Redirect user profile
		header("location:login.php");
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
	<div class="container mt-lg-5">
		<a class="btn btn-dark text-white btn-sm" href="search.php">Search</a>
		<div class="card bg-secondary shadow">
			<div class="card-body">
				<h2 class="text-warning">All Data<a class="btn btn-sm btn-primary ml-auto d-table" href="profile.php">Your Profile</a></h2>

		<div class="jumbotron bg-secondary shadow">
			<table class="table text-light table-striped table-hover">
				<thead class="bg-dark text-primary">
					<tr>
						<th>SL</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Cell</th>
						<th>Photo</th>
						<td colspan="3" class="text-center">Action</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM users";
						$data = $connection -> query($sql);

						// fetch data
						$id = 1;
						while( $fdata = $data -> fetch_object() ):

					 ?>
					<tr>
						<td><?php echo $id; $id++; ?></td>
						<td><?php echo $fdata -> name; ?></td>
						<td><?php echo $fdata -> uname; ?></td>
						<td><?php echo $fdata -> email; ?></td>
						<td><?php echo $fdata -> cell; ?></td>
						<td><img style="width: 50px; height: 50px;" src="photos/users/<?php echo $fdata -> photo; ?>" alt=""></td>
						<td>
							<?php if( $fdata -> id == $_SESSION['id'] ): ?>
							<a class="btn btn-info btn-sm mx-auto" href="view.php?id=<?php echo $fdata -> id; ?>">View</a>
							<a class="btn btn-warning btn-sm mx-auto" href="update.php?id=<?php echo $fdata -> id; ?>">Edit</a>
							<a id="delete" class="btn btn-danger btn-sm mx-auto" href="delete.php?id=<?php echo $fdata -> id; ?>">Delete</a>
							<?php else: ?>
								<a class="btn btn-info btn-sm mx-auto" href="view.php?id=<?php echo $fdata -> id; ?>">View</a>
							<?php endif; ?>
						</td>
											
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
	</div>
	<!-- JS LINK -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		
		$('a#delete').click(function(){

			let val = confirm("Are you sure ?");

			if (val == true) {
				return true;
			} else {
				return false;
			}

		});

	</script>
</body>
</html>