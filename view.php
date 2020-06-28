<?php require_once 'apps/db.php' ?>
<?php require_once 'apps/function.php' ?>

<?php 

	// Get data url
	$id = $_GET['id'];

	// query database
	$sql = "SELECT * FROM users WHERE id='$id'";
	$data = $connection -> query($sql);

	// fetch query data
	$single_data = $data -> fetch_object();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $single_data -> name; ?></title>
	<!-- CSS LINK -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">
	
	<div class="container mt-lg-5" style="width: 450px;">
		<a class="btn btn-dark text-white btn-sm" href="users.php">Back</a>
		<div class="jumbotron bg-secondary shadow">
			<img style="width: 150px;" class="mx-auto d-block img-thumbnail" src="photos/users/<?php echo $single_data -> photo; ?>" alt=""><br>
			<!-- <hr class="bg-light"> -->
			<table class="table">
				<tbody class="text-light">
					<tr>
						<td>Name</td>
						<td><?php echo $single_data -> name; ?></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><?php echo $single_data -> uname; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $single_data -> email; ?></td>
					</tr>
					<tr>
						<td>Cell</td>
						<td><?php echo $single_data -> cell; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- JS LINK -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>