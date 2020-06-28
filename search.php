<?php include_once 'apps/db.php' ?>
<?php include_once 'apps/function.php' ?>

<?php 

	// session start
	session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-secondary">
	<div class="container mt-lg-5">
		<div class="jumbotron bg-secondary shadow">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<input name="search" id='search' class="p-1" style="background-color: #6C757D; color: #fff;" type="text" placeholder="Uname/Email/Cell">
				<input name="submit" class="btn btn-dark text-light" type="submit" value="Search">
				<a class="btn btn-dark text-white btn-sm float-right" href="users.php">All Data Show</a>
			</form>
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

						if ( isset($_POST['submit']) ) {
							$search = $_POST['search'];

							$sql = "SELECT * FROM users WHERE uname='$search' || email='$search' || cell='$search' ";
							$data = $connection -> query($sql);

							$rowcount = mysqli_num_rows($data); 

							if ($rowcount <= 0) {
								echo "<span class='bg-danger text-light p-1'>No Result found !<span>";
							}else {
								if ( isset($search) ) :
								$id = 1;
								while($fdata = $data -> fetch_object()):
							
						
						

						
						
						
						
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
					<?php endwhile; endif; } } ?>
				</tbody>
			</table>
		</div>
	</div>
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

		$('input#search').click(function(){
			$(this).css('background-color','#939393FF').css('color','#070707FF');
		});

	</script>
</body>
</html>